<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFactoryAPIRequest;
use App\Http\Requests\API\UpdateFactoryAPIRequest;
use App\Models\Factory;
use App\Repositories\FactoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FactoryController
 * @package App\Http\Controllers\API
 */

class FactoryAPIController extends AppBaseController
{
    /** @var  FactoryRepository */
    private $factoryRepository;

    public function __construct(FactoryRepository $factoryRepo)
    {
        $this->factoryRepository = $factoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/factories",
     *      summary="Get a listing of the Factories.",
     *      tags={"厂家"},
     *      description="Get all Factories",
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
     *                  @SWG\Items(ref="#/definitions/Factory")
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
        $this->factoryRepository->pushCriteria(new RequestCriteria($request));
        $this->factoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $factories = $this->factoryRepository->all();

        return $this->sendResponse($factories->toArray(), 'Factories获取成功');
    }

    /**
     * @param CreateFactoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/factories",
     *      summary="Store a newly created Factory in storage",
     *      tags={"厂家"},
     *      description="Store Factory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Factory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Factory")
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
     *                  ref="#/definitions/Factory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFactoryAPIRequest $request)
    {
        $input = $request->all();

        $factories = $this->factoryRepository->create($input);

        return $this->sendResponse($factories->toArray(), '工厂保存成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/factories/{id}",
     *      summary="Display the specified Factory",
     *      tags={"厂家"},
     *      description="Get Factory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Factory",
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
     *                  ref="#/definitions/Factory"
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
        /** @var Factory $factory */
        $factory = $this->factoryRepository->findWithoutFail($id);

        if (empty($factory)) {
            return $this->sendError('工厂未找到');
        }

        return $this->sendResponse($factory->toArray(), '工厂获取成功');
    }

    /**
     * @param int $id
     * @param UpdateFactoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/factories/{id}",
     *      summary="Update the specified Factory in storage",
     *      tags={"厂家"},
     *      description="Update Factory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Factory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Factory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Factory")
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
     *                  ref="#/definitions/Factory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFactoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Factory $factory */
        $factory = $this->factoryRepository->findWithoutFail($id);

        if (empty($factory)) {
            return $this->sendError('工厂未找到');
        }

        $factory = $this->factoryRepository->update($input, $id);

        return $this->sendResponse($factory->toArray(), '工厂更新成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/factories/{id}",
     *      summary="Remove the specified Factory from storage",
     *      tags={"厂家"},
     *      description="Delete Factory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Factory",
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
        /** @var Factory $factory */
        $factory = $this->factoryRepository->findWithoutFail($id);

        if (empty($factory)) {
            return $this->sendError('工厂未找到');
        }

        $factory->delete();

        return $this->sendResponse($id, '工厂删除成功');
    }
}
