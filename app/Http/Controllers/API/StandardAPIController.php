<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStandardAPIRequest;
use App\Http\Requests\API\UpdateStandardAPIRequest;
use App\Models\Standard;
use App\Repositories\StandardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StandardController
 * @package App\Http\Controllers\API
 */

class StandardAPIController extends AppBaseController
{
    /** @var  StandardRepository */
    private $standardRepository;

    public function __construct(StandardRepository $standardRepo)
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
     * @param CreateStandardAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/standards",
     *      summary="Store a newly created Standard in storage",
     *      tags={"Standard"},
     *      description="Store Standard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Standard that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Standard")
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
    public function store(CreateStandardAPIRequest $request)
    {
        $input = $request->all();

        $standards = $this->standardRepository->create($input);

        return $this->sendResponse($standards->toArray(), 'Standard saved successfully');
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
            return $this->sendError('Standard not found');
        }

        return $this->sendResponse($standard->toArray(), 'Standard retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStandardAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/standards/{id}",
     *      summary="Update the specified Standard in storage",
     *      tags={"Standard"},
     *      description="Update Standard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Standard",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Standard that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Standard")
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
    public function update($id, UpdateStandardAPIRequest $request)
    {
        $input = $request->all();

        /** @var Standard $standard */
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            return $this->sendError('Standard not found');
        }

        $standard = $this->standardRepository->update($input, $id);

        return $this->sendResponse($standard->toArray(), 'Standard updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/standards/{id}",
     *      summary="Remove the specified Standard from storage",
     *      tags={"Standard"},
     *      description="Delete Standard",
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
        /** @var Standard $standard */
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            return $this->sendError('Standard not found');
        }

        $standard->delete();

        return $this->sendResponse($id, 'Standard deleted successfully');
    }
}
