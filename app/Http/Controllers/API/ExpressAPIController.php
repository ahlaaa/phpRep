<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExpressAPIRequest;
use App\Http\Requests\API\UpdateExpressAPIRequest;
use App\Models\Express;
use App\Repositories\ExpressRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ExpressController
 * @package App\Http\Controllers\API
 */

class ExpressAPIController extends AppBaseController
{
    /** @var  ExpressRepository */
    private $expressRepository;

    public function __construct(ExpressRepository $expressRepo)
    {
        $this->expressRepository = $expressRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/expresses",
     *      summary="Get a listing of the Expresses.",
     *      tags={"物流公司"},
     *      description="Get all Expresses",
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
     *                  @SWG\Items(ref="#/definitions/Express")
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
        $this->expressRepository->pushCriteria(new RequestCriteria($request));
        $this->expressRepository->pushCriteria(new LimitOffsetCriteria($request));
        $expresses = $this->expressRepository->all();

        return $this->sendResponse($expresses->toArray(), 'Expresses获取成功');
    }

    /**
     * @param CreateExpressAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/expresses",
     *      summary="Store a newly created Express in storage",
     *      tags={"物流公司"},
     *      description="Store Express",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Express that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Express")
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
     *                  ref="#/definitions/Express"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateExpressAPIRequest $request)
    {
        $input = $request->all();

        $expresses = $this->expressRepository->create($input);

        return $this->sendResponse($expresses->toArray(), '物流公司保存成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/expresses/{id}",
     *      summary="Display the specified Express",
     *      tags={"物流公司"},
     *      description="Get Express",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Express",
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
     *                  ref="#/definitions/Express"
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
        /** @var Express $express */
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            return $this->sendError('物流公司未找到');
        }

        return $this->sendResponse($express->toArray(), '物流公司获取成功');
    }

    /**
     * @param int $id
     * @param UpdateExpressAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/expresses/{id}",
     *      summary="Update the specified Express in storage",
     *      tags={"物流公司"},
     *      description="Update Express",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Express",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Express that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Express")
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
     *                  ref="#/definitions/Express"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateExpressAPIRequest $request)
    {
        $input = $request->all();

        /** @var Express $express */
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            return $this->sendError('物流公司未找到');
        }

        $express = $this->expressRepository->update($input, $id);

        return $this->sendResponse($express->toArray(), '物流公司更新成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/expresses/{id}",
     *      summary="Remove the specified Express from storage",
     *      tags={"物流公司"},
     *      description="Delete Express",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Express",
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
        /** @var Express $express */
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            return $this->sendError('物流公司未找到');
        }

        $express->delete();

        return $this->sendResponse($id, '物流公司删除成功');
    }
}
