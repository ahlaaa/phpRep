<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVisitorAPIRequest;
use App\Http\Requests\API\UpdateVisitorAPIRequest;
use App\Models\Visitor;
use App\Repositories\VisitorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VisitorController
 * @package App\Http\Controllers\API
 */

class VisitorAPIController extends AppBaseController
{
    /** @var  VisitorRepository */
    private $visitorRepository;

    public function __construct(VisitorRepository $visitorRepo)
    {
        $this->visitorRepository = $visitorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/visitors",
     *      summary="Get a listing of the Visitors.",
     *      tags={"Visitor"},
     *      description="Get all Visitors",
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
     *                  @SWG\Items(ref="#/definitions/Visitor")
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
        $this->visitorRepository->pushCriteria(new RequestCriteria($request));
        $this->visitorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $visitors = $this->visitorRepository->all();

        return $this->sendResponse($visitors->toArray(), 'Visitors retrieved successfully');
    }

    /**
     * @param CreateVisitorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/visitors",
     *      summary="Store a newly created Visitor in storage",
     *      tags={"Visitor"},
     *      description="Store Visitor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Visitor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visitor")
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
     *                  ref="#/definitions/Visitor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVisitorAPIRequest $request)
    {
        $input = $request->all();

        $visitors = $this->visitorRepository->create($input);

        return $this->sendResponse($visitors->toArray(), 'Visitor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/visitors/{id}",
     *      summary="Display the specified Visitor",
     *      tags={"Visitor"},
     *      description="Get Visitor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Visitor",
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
     *                  ref="#/definitions/Visitor"
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
        /** @var Visitor $visitor */
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            return $this->sendError('Visitor not found');
        }

        return $this->sendResponse($visitor->toArray(), 'Visitor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVisitorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/visitors/{id}",
     *      summary="Update the specified Visitor in storage",
     *      tags={"Visitor"},
     *      description="Update Visitor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Visitor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Visitor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visitor")
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
     *                  ref="#/definitions/Visitor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVisitorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Visitor $visitor */
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            return $this->sendError('Visitor not found');
        }

        $visitor = $this->visitorRepository->update($input, $id);

        return $this->sendResponse($visitor->toArray(), 'Visitor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/visitors/{id}",
     *      summary="Remove the specified Visitor from storage",
     *      tags={"Visitor"},
     *      description="Delete Visitor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Visitor",
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
        /** @var Visitor $visitor */
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            return $this->sendError('Visitor not found');
        }

        $visitor->delete();

        return $this->sendResponse($id, 'Visitor deleted successfully');
    }
}
