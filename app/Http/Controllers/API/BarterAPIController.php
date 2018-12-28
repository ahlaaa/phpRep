<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBarterAPIRequest;
use App\Http\Requests\API\UpdateBarterAPIRequest;
use App\Models\Barter;
use App\Repositories\BarterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BarterController
 * @package App\Http\Controllers\API
 */

class BarterAPIController extends AppBaseController
{
    /** @var  BarterRepository */
    private $barterRepository;

    public function __construct(BarterRepository $barterRepo)
    {
        $this->barterRepository = $barterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/barters",
     *      summary="Get a listing of the Barters.",
     *      tags={"Barter"},
     *      description="Get all Barters",
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
     *                  @SWG\Items(ref="#/definitions/Barter")
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
        $this->barterRepository->pushCriteria(new RequestCriteria($request));
        $this->barterRepository->pushCriteria(new LimitOffsetCriteria($request));
        $barters = $this->barterRepository->all();

        return $this->sendResponse($barters->toArray(), 'Barters retrieved successfully');
    }

    /**
     * @param CreateBarterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/barters",
     *      summary="Store a newly created Barter in storage",
     *      tags={"Barter"},
     *      description="Store Barter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Barter that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Barter")
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
     *                  ref="#/definitions/Barter"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBarterAPIRequest $request)
    {
        $input = $request->all();

        $barters = $this->barterRepository->create($input);

        return $this->sendResponse($barters->toArray(), 'Barter saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/barters/{id}",
     *      summary="Display the specified Barter",
     *      tags={"Barter"},
     *      description="Get Barter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Barter",
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
     *                  ref="#/definitions/Barter"
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
        /** @var Barter $barter */
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            return $this->sendError('Barter not found');
        }

        return $this->sendResponse($barter->toArray(), 'Barter retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBarterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/barters/{id}",
     *      summary="Update the specified Barter in storage",
     *      tags={"Barter"},
     *      description="Update Barter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Barter",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Barter that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Barter")
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
     *                  ref="#/definitions/Barter"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBarterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Barter $barter */
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            return $this->sendError('Barter not found');
        }

        $barter = $this->barterRepository->update($input, $id);

        return $this->sendResponse($barter->toArray(), 'Barter updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/barters/{id}",
     *      summary="Remove the specified Barter from storage",
     *      tags={"Barter"},
     *      description="Delete Barter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Barter",
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
        /** @var Barter $barter */
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            return $this->sendError('Barter not found');
        }

        $barter->delete();

        return $this->sendResponse($id, 'Barter deleted successfully');
    }
}
