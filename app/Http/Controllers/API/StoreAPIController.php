<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStoreAPIRequest;
use App\Http\Requests\API\UpdateStoreAPIRequest;
use App\Models\Store;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StoreController
 * @package App\Http\Controllers\API
 */

class StoreAPIController extends AppBaseController
{
    /** @var  StoreRepository */
    private $storeRepository;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stores",
     *      summary="Get a listing of the Stores.",
     *      tags={"Store"},
     *      description="Get all Stores",
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
     *                  @SWG\Items(ref="#/definitions/Store")
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
        $this->storeRepository->pushCriteria(new RequestCriteria($request));
        $this->storeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stores = $this->storeRepository->status(2)->paginate();

        return $this->sendResponse($stores->toArray(), 'Stores retrieved successfully');
    }

    /**
     * @param CreateStoreAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stores",
     *      summary="Store a newly created Store in storage",
     *      tags={"Store"},
     *      description="Store Store",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Store that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Store")
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
     *                  ref="#/definitions/Store"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStoreAPIRequest $request)
    {
        $input = $request->all();

        $stores = $this->storeRepository->create($input);

        return $this->sendResponse($stores->toArray(), 'Store saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stores/{id}",
     *      summary="Display the specified Store",
     *      tags={"Store"},
     *      description="Get Store",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Store",
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
     *                  ref="#/definitions/Store"
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
        /** @var Store $store */
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            return $this->sendError('Store not found');
        }

        return $this->sendResponse($store->toArray(), 'Store retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStoreAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stores/{id}",
     *      summary="Update the specified Store in storage",
     *      tags={"Store"},
     *      description="Update Store",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Store",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Store that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Store")
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
     *                  ref="#/definitions/Store"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStoreAPIRequest $request)
    {
        $input = $request->all();

        /** @var Store $store */
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            return $this->sendError('Store not found');
        }

        $store = $this->storeRepository->update($input, $id);

        return $this->sendResponse($store->toArray(), 'Store updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stores/{id}",
     *      summary="Remove the specified Store from storage",
     *      tags={"Store"},
     *      description="Delete Store",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Store",
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
        /** @var Store $store */
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            return $this->sendError('Store not found');
        }

        $store->delete();

        return $this->sendResponse($id, 'Store deleted successfully');
    }
}
