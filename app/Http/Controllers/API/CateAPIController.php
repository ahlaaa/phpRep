<?php

namespace App\Http\Controllers\API;

//use App\Http\Requests\API\CreateStandardAPIRequest;
//use App\Http\Requests\API\UpdateStandardAPIRequest;
use App\Models\Cate;
use App\Repositories\CateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StandardController
 * @package App\Http\Controllers\API
 */

class CateAPIController extends AppBaseController
{
    /** @var  StandardRepository */
    private $standardRepository;

    public function __construct(CateRepository $standardRepo)
    {
        $this->standardRepository = $standardRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/standards",
     *      summary="Get a listing of the Standards.",
     *      tags={"Standard"},
     *      description="Get all Standards",
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
     *                  @SWG\Items(ref="#/definitions/Standard")
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
        $this->standardRepository->pushCriteria(new RequestCriteria($request));
        $this->standardRepository->pushCriteria(new LimitOffsetCriteria($request));
        $standards = $this->standardRepository->all();

        return $this->sendResponse($standards->toArray(), 'Standards retrieved successfully');
    }



    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/standards/{id}",
     *      summary="Display the specified Standard",
     *      tags={"Standard"},
     *      description="Get Standard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Standard",
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
     *                  ref="#/definitions/Standard"
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
        /** @var Standard $standard */
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            return $this->sendError('Cate not found');
        }

        return $this->sendResponse($standard->toArray(), 'Cate retrieved successfully');
    }


}
