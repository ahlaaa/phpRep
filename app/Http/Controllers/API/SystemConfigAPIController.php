<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSystemConfigAPIRequest;
use App\Http\Requests\API\UpdateSystemConfigAPIRequest;
use App\Models\SystemConfig;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SystemConfigController
 * @package App\Http\Controllers\API
 */

class SystemConfigAPIController extends AppBaseController
{
    /** @var  SystemConfigRepository */
    private $systemConfigRepository;

    public function __construct(SystemConfigRepository $systemConfigRepo)
    {
        $this->systemConfigRepository = $systemConfigRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/systemConfigs",
     *      summary="Get a listing of the SystemConfigs.",
     *      tags={"系统设置"},
     *      description="Get all SystemConfigs",
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
     *                  @SWG\Items(ref="#/definitions/SystemConfig")
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
        // $this->systemConfigRepository->pushCriteria(new RequestCriteria($request));
        // $this->systemConfigRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $systemConfigs = $this->systemConfigRepository->all();
        $systemConfig = $this->systemConfigRepository->findWithoutFail(1);
        return $this->sendResponse($systemConfig->toArray(), 'System Configs retrieved successfully');
    }

    /**
     * @param CreateSystemConfigAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/systemConfigs",
     *      summary="Store a newly created SystemConfig in storage",
     *      tags={"系统设置"},
     *      description="Store SystemConfig",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SystemConfig that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SystemConfig")
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
     *                  ref="#/definitions/SystemConfig"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSystemConfigAPIRequest $request)
    {
        $input = $request->all();

        $systemConfigs = $this->systemConfigRepository->create($input);

        return $this->sendResponse($systemConfigs->toArray(), 'System Config saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/systemConfigs/{id}",
     *      summary="Display the specified SystemConfig",
     *      tags={"系统设置"},
     *      description="Get SystemConfig",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SystemConfig",
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
     *                  ref="#/definitions/SystemConfig"
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
        /** @var SystemConfig $systemConfig */
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            return $this->sendError('System Config not found');
        }

        return $this->sendResponse($systemConfig->toArray(), 'System Config retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSystemConfigAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/systemConfigs/{id}",
     *      summary="Update the specified SystemConfig in storage",
     *      tags={"系统设置"},
     *      description="Update SystemConfig",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SystemConfig",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SystemConfig that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SystemConfig")
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
     *                  ref="#/definitions/SystemConfig"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSystemConfigAPIRequest $request)
    {
        $input = $request->all();

        /** @var SystemConfig $systemConfig */
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            return $this->sendError('System Config not found');
        }

        $systemConfig = $this->systemConfigRepository->update($input, $id);

        return $this->sendResponse($systemConfig->toArray(), 'SystemConfig updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/systemConfigs/{id}",
     *      summary="Remove the specified SystemConfig from storage",
     *      tags={"系统设置"},
     *      description="Delete SystemConfig",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SystemConfig",
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
        /** @var SystemConfig $systemConfig */
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            return $this->sendError('System Config not found');
        }

        $systemConfig->delete();

        return $this->sendResponse($id, 'System Config deleted successfully');
    }
}
