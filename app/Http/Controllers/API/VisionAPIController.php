<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVisionAPIRequest;
use App\Models\Vision;
use App\Repositories\VisionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class visionController
 * @package App\Http\Controllers\API
 */

class VisionAPIController extends AppBaseController
{
    /** @var  VisionRepository */
    private $visionRepository;

    public function __construct(VisionRepository $visionRepo)
    {
        $this->visionRepository = $visionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/visions",
     *      summary="Get a listing of the visions.",
     *      tags={"文章"},
     *      description="Get all visions",
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
     *                  @SWG\Items(ref="#/definitions/vision")
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
        $this->visionRepository->pushCriteria(new RequestCriteria($request));
        $this->visionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $visions = $this->visionRepository->with(['user'])->paginate();

        return $this->sendResponse($visions->toArray(), '测试记录获取成功');
    }

    /**
     * @param CreatevisionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/visions",
     *      summary="Store a newly created vision in storage",
     *      tags={"文章"},
     *      description="Store 文章",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="vision that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/vision")
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
     *                  ref="#/definitions/vision"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatevisionAPIRequest $request)
    {
        $input = $request->all();

        $visions = $this->visionRepository->create($input);

        return $this->sendResponse($visions->toArray(), '测试记录保存成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/visions/{id}",
     *      summary="Display the specified vision",
     *      tags={"文章"},
     *      description="Get vision",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of vision",
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
     *                  ref="#/definitions/vision"
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
        /** @var vision $vision */
        $vision = $this->visionRepository->findWithoutFail($id);

        $vision->load('user');

        if (empty($vision)) {
            return $this->sendError('测试记录未找到');
        }

        return $this->sendResponse($vision->toArray(), '测试记录获取成功');
    }

    /**
     * @param int $id
     * @param UpdatevisionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/visions/{id}",
     *      summary="Update the specified vision in storage",
     *      tags={"文章"},
     *      description="Update 文章",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of 文章",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="vision that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/vision")
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
     *                  ref="#/definitions/vision"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatevisionAPIRequest $request)
    {
        $input = $request->all();

        /** @var vision $vision */
        $vision = $this->visionRepository->findWithoutFail($id);

        if (empty($vision)) {
            return $this->sendError('测试记录未找到');
        }

        $vision = $this->visionRepository->update($input, $id);

        return $this->sendResponse($vision->toArray(), '测试记录更新成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/visions/{id}",
     *      summary="Remove the specified vision from storage",
     *      tags={"文章"},
     *      description="Delete 文章",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of 文章",
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
        /** @var vision $vision */
        $vision = $this->visionRepository->findWithoutFail($id);

        if (empty($vision)) {
            return $this->sendError('测试记录未找到');
        }

        $vision->delete();

        return $this->sendResponse($id, '测试记录删除成功');
    }
}
