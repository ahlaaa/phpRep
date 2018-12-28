<?php

namespace App\Http\Controllers\API;

use App\Criteria\AuthCriteria;
use App\Http\Requests\API\CreateWithdrawAPIRequest;
use App\Http\Requests\API\UpdateWithdrawAPIRequest;
use App\Models\Withdraw;
use App\Repositories\WithdrawRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class WithdrawController
 * @package App\Http\Controllers\API
 */

class WithdrawAPIController extends AppBaseController
{
    /** @var  WithdrawRepository */
    private $withdrawRepository;

    public function __construct(WithdrawRepository $withdrawRepo)
    {
        $this->withdrawRepository = $withdrawRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/withdraws",
     *      summary="Get a listing of the Withdraws.",
     *      tags={"Withdraw"},
     *      description="Get all Withdraws",
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
     *                  @SWG\Items(ref="#/definitions/Withdraw")
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
        $this->withdrawRepository->pushCriteria(new RequestCriteria($request));
        $this->withdrawRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->withdrawRepository->pushCriteria(new AuthCriteria());
        $withdraws = $this->withdrawRepository->all();

        return $this->sendResponse($withdraws->toArray(), 'Withdraws retrieved successfully');
    }

    /**
     * @param CreateWithdrawAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/withdraws",
     *      summary="Store a newly created Withdraw in storage",
     *      tags={"Withdraw"},
     *      description="Store Withdraw",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Withdraw that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Withdraw")
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
     *                  ref="#/definitions/Withdraw"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWithdrawAPIRequest $request)
    {
        $input = $request->all();

        $withdraws = $this->withdrawRepository->create($input);

        return $this->sendResponse($withdraws->toArray(), 'Withdraw saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/withdraws/{id}",
     *      summary="Display the specified Withdraw",
     *      tags={"Withdraw"},
     *      description="Get Withdraw",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Withdraw",
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
     *                  ref="#/definitions/Withdraw"
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
        /** @var Withdraw $withdraw */
        $withdraw = $this->withdrawRepository->findWithoutFail($id);

        if (empty($withdraw)) {
            return $this->sendError('Withdraw not found');
        }

        return $this->sendResponse($withdraw->toArray(), 'Withdraw retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateWithdrawAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/withdraws/{id}",
     *      summary="Update the specified Withdraw in storage",
     *      tags={"Withdraw"},
     *      description="Update Withdraw",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Withdraw",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Withdraw that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Withdraw")
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
     *                  ref="#/definitions/Withdraw"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWithdrawAPIRequest $request)
    {
        $input = $request->all();

        /** @var Withdraw $withdraw */
        $withdraw = $this->withdrawRepository->findWithoutFail($id);

        if (empty($withdraw)) {
            return $this->sendError('Withdraw not found');
        }

        $withdraw = $this->withdrawRepository->update($input, $id);

        return $this->sendResponse($withdraw->toArray(), 'Withdraw updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/withdraws/{id}",
     *      summary="Remove the specified Withdraw from storage",
     *      tags={"Withdraw"},
     *      description="Delete Withdraw",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Withdraw",
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
        /** @var Withdraw $withdraw */
        $withdraw = $this->withdrawRepository->findWithoutFail($id);

        if (empty($withdraw)) {
            return $this->sendError('Withdraw not found');
        }

        $withdraw->delete();

        return $this->sendResponse($id, 'Withdraw deleted successfully');
    }
}
