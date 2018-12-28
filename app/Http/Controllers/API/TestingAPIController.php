<?php

namespace App\Http\Controllers\API;

use App\Criteria\AuthCriteria;
use App\Http\Requests\API\CreateTestingAPIRequest;
use App\Http\Requests\API\UpdateTestingAPIRequest;
use App\Models\Testing;
use App\Repositories\TestingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TestingController
 * @package App\Http\Controllers\API
 */

class TestingAPIController extends AppBaseController
{
    /** @var  TestingRepository */
    private $testingRepository;

    public function __construct(TestingRepository $testingRepo)
    {
        $this->testingRepository = $testingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/testings",
     *      summary="Get a listing of the Testings.",
     *      tags={"Testing"},
     *      description="Get all Testings",
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
     *                  @SWG\Items(ref="#/definitions/Testing")
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
        $this->testingRepository->pushCriteria(new RequestCriteria($request));
        $this->testingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $this->testingRepository->pushCriteria(new AuthCriteria());
        $testings = $this->testingRepository->paginate();

        return $this->sendResponse($testings->toArray(), 'Testings retrieved successfully');
    }

    /**
     * @param CreateTestingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/testings",
     *      summary="Store a newly created Testing in storage",
     *      tags={"Testing"},
     *      description="Store Testing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testing that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testing")
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
     *                  ref="#/definitions/Testing"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestingAPIRequest $request)
    {
        $input = $request->all();

        $input['user_id'] = \Auth::id();

        $testings = $this->testingRepository->create($input);

        return $this->sendResponse($testings->toArray(), 'Testing saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/testings/{id}",
     *      summary="Display the specified Testing",
     *      tags={"Testing"},
     *      description="Get Testing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testing",
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
     *                  ref="#/definitions/Testing"
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
        /** @var Testing $testing */
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            return $this->sendError('Testing not found');
        }

        return $this->sendResponse($testing->toArray(), 'Testing retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTestingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/testings/{id}",
     *      summary="Update the specified Testing in storage",
     *      tags={"Testing"},
     *      description="Update Testing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testing",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testing that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testing")
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
     *                  ref="#/definitions/Testing"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Testing $testing */
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            return $this->sendError('Testing not found');
        }

        $testing = $this->testingRepository->update($input, $id);

        return $this->sendResponse($testing->toArray(), 'Testing updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/testings/{id}",
     *      summary="Remove the specified Testing from storage",
     *      tags={"Testing"},
     *      description="Delete Testing",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testing",
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
        /** @var Testing $testing */
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            return $this->sendError('Testing not found');
        }

        $testing->delete();

        return $this->sendResponse($id, 'Testing deleted successfully');
    }
}
