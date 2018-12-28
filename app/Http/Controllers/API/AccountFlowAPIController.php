<?php

namespace App\Http\Controllers\API;

use App\Criteria\AuthCriteria;
use App\Http\Requests\API\CreateAccountFlowAPIRequest;
use App\Http\Requests\API\UpdateAccountFlowAPIRequest;
use App\Models\AccountFlow;
use App\Repositories\AccountFlowRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AccountFlowController
 * @package App\Http\Controllers\API
 */

class AccountFlowAPIController extends AppBaseController
{
    /** @var  AccountFlowRepository */
    private $accountFlowRepository;

    public function __construct(AccountFlowRepository $accountFlowRepo)
    {
        $this->accountFlowRepository = $accountFlowRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/accountFlows",
     *      summary="Get a listing of the AccountFlows.",
     *      tags={"帐户流水"},
     *      description="Get all AccountFlows",
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
     *                  @SWG\Items(ref="#/definitions/AccountFlow")
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
        $this->accountFlowRepository->pushCriteria(new RequestCriteria($request));
        $this->accountFlowRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->accountFlowRepository->pushCriteria(new AuthCriteria());
        $accountFlows = $this->accountFlowRepository->paginate($request->pageSize);

        return $this->sendResponse($accountFlows->toArray(), '帐户流水获取成功');
    }

    /**
     * @param CreateAccountFlowAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/accountFlows",
     *      summary="Store a newly created AccountFlow in storage",
     *      tags={"帐户流水"},
     *      description="Store AccountFlow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AccountFlow that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AccountFlow")
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
     *                  ref="#/definitions/AccountFlow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAccountFlowAPIRequest $request)
    {
        $input = $request->all();

        $accountFlows = $this->accountFlowRepository->create($input);

        return $this->sendResponse($accountFlows->toArray(), 'Account Flow saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/accountFlows/{id}",
     *      summary="Display the specified AccountFlow",
     *      tags={"帐户流水"},
     *      description="Get AccountFlow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AccountFlow",
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
     *                  ref="#/definitions/AccountFlow"
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
        /** @var AccountFlow $accountFlow */
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            return $this->sendError('Account Flow not found');
        }

        return $this->sendResponse($accountFlow->toArray(), 'Account Flow retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAccountFlowAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/accountFlows/{id}",
     *      summary="Update the specified AccountFlow in storage",
     *      tags={"帐户流水"},
     *      description="Update AccountFlow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AccountFlow",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AccountFlow that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AccountFlow")
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
     *                  ref="#/definitions/AccountFlow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAccountFlowAPIRequest $request)
    {
        $input = $request->all();

        /** @var AccountFlow $accountFlow */
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            return $this->sendError('Account Flow not found');
        }

        $accountFlow = $this->accountFlowRepository->update($input, $id);

        return $this->sendResponse($accountFlow->toArray(), 'AccountFlow updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/accountFlows/{id}",
     *      summary="Remove the specified AccountFlow from storage",
     *      tags={"帐户流水"},
     *      description="Delete AccountFlow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AccountFlow",
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
        /** @var AccountFlow $accountFlow */
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            return $this->sendError('Account Flow not found');
        }

        $accountFlow->delete();

        return $this->sendResponse($id, 'Account Flow deleted successfully');
    }
}
