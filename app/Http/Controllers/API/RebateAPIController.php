<?php

namespace App\Http\Controllers\API;

use App\Criteria\AuthCriteria;
use App\Http\Requests\API\CreateRebateAPIRequest;
use App\Http\Requests\API\UpdateRebateAPIRequest;
use App\Models\Rebate;
use App\Repositories\RebateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RebateController
 * @package App\Http\Controllers\API
 */

class RebateAPIController extends AppBaseController
{
    /** @var  RebateRepository */
    private $rebateRepository;

    public function __construct(RebateRepository $rebateRepo)
    {
        $this->rebateRepository = $rebateRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/rebates",
     *      summary="Get a listing of the Rebates.",
     *      tags={"返利"},
     *      description="Get all Rebates",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Rebate")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->rebateRepository->pushCriteria(new RequestCriteria($request));
        $this->rebateRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->rebateRepository->pushCriteria(AuthCriteria::class);

        $rebates = $this->rebateRepository->scopeQuery(function ($query){
            return $query->where('user_id',\Auth::user()->id);
        })->paginate();

        return $this->sendResponse($rebates->toArray(), 'Rebates retrieved successfully');
    }

    public function statistics(Request $request)
    {
        $this->rebateRepository->pushCriteria(new RequestCriteria($request));
        $this->rebateRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->rebateRepository->pushCriteria(AuthCriteria::class);

        $rebates = $this->rebateRepository->all();

        $rebates = $rebates->groupBy('type')->map(function ($item) {
            return [
                'type_str'=> $item->first()->type_str,
                'type'=> $item->first()->type,
                'sum'=> $item->sum('amount'),
            ];
        });

        return $this->sendResponse($rebates->values(), '获取统计成功');
    }

    /**
     * @param CreateRebateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/rebates",
     *      summary="Store a newly created Rebate in storage",
     *      tags={"返利"},
     *      description="Store Rebate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Rebate that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Rebate")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Rebate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRebateAPIRequest $request)
    {
        $input = $request->all();

        $rebates = $this->rebateRepository->create($input);

        return $this->sendResponse($rebates->toArray(), 'Rebate saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/rebates/{id}",
     *      summary="Display the specified Rebate",
     *      tags={"返利"},
     *      description="Get Rebate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rebate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Rebate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Rebate $rebate */
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            return $this->sendError('Rebate not found');
        }

        return $this->sendResponse($rebate->toArray(), 'Rebate retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRebateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/rebates/{id}",
     *      summary="Update the specified Rebate in storage",
     *      tags={"返利"},
     *      description="Update Rebate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rebate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Rebate that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Rebate")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Rebate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRebateAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rebate $rebate */
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            return $this->sendError('Rebate not found');
        }

        $rebate = $this->rebateRepository->update($input, $id);

        return $this->sendResponse($rebate->toArray(), 'Rebate updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/rebates/{id}",
     *      summary="Remove the specified Rebate from storage",
     *      tags={"返利"},
     *      description="Delete Rebate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rebate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Rebate $rebate */
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            return $this->sendError('Rebate not found');
        }

        $rebate->delete();

        return $this->sendResponse($id, 'Rebate deleted successfully');
    }

    public function district(Request $request)
    {
//        $province = $request->get('province');
//        $city = $request->get('city');

        $rebates = $this->rebateRepository->with(['user'=> function($query) {
            return $query->select('id', 'username', 'status', 'province', 'city', 'county');
        }])->scopeQuery(function ($query) use ($request) {
            $query->when($request->get('province'), function ($query) use ($request) {
                return $query->whereHas('user', function ($query) use ($request) {
                    return $query->where('province', $request->get('province'));
                });
            })->orderBy('type', 'DESC')->selectRaw('type,SUM(amount) as sum, user_id')->groupBy('type')->groupBy('user_id');
            return $query;
        })->all();

//        $data = [];
//
//        foreach ($rebates as $rebate) {
//
////            if ($rebate->type === 2) {
////                $data[$rebate->province][$rebate->city][$rebate->county] += $rebate->amount;
////            }
////            if ($rebate->type === 3) {
////                $data[$rebate->province][$rebate->city] += $rebate->amount;
////            }
////            if ($rebate->type === 4) {
////
////                isset($data[$rebate->province]) ? += $rebate->amount;
////            }
//        }

        return $this->sendResponse($rebates, '成功');
    }
}
