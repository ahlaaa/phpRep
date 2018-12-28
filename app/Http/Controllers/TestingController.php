<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestingRequest;
use App\Http\Requests\UpdateTestingRequest;
use App\Repositories\TestingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TestingController extends AppBaseController
{
    /** @var  TestingRepository */
    private $testingRepository;

    public function __construct(TestingRepository $testingRepo)
    {
        $this->testingRepository = $testingRepo;
    }

    /**
     * Display a listing of the Testing.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->testingRepository->pushCriteria(new RequestCriteria($request));
        $testings = $this->testingRepository->all();

        return view('testings.index')
            ->with('testings', $testings);
    }

    /**
     * Show the form for creating a new Testing.
     *
     * @return Response
     */
    public function create()
    {
        return view('testings.create');
    }

    /**
     * Store a newly created Testing in storage.
     *
     * @param CreateTestingRequest $request
     *
     * @return Response
     */
    public function store(CreateTestingRequest $request)
    {
        $input = $request->all();

        $testing = $this->testingRepository->create($input);

        Flash::success('Testing saved successfully.');

        return redirect(route('testings.index'));
    }

    /**
     * Display the specified Testing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            Flash::error('Testing not found');

            return redirect(route('testings.index'));
        }

        return view('testings.show')->with('testing', $testing);
    }

    /**
     * Show the form for editing the specified Testing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            Flash::error('Testing not found');

            return redirect(route('testings.index'));
        }

        return view('testings.edit')->with('testing', $testing);
    }

    /**
     * Update the specified Testing in storage.
     *
     * @param  int              $id
     * @param UpdateTestingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestingRequest $request)
    {
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            Flash::error('Testing not found');

            return redirect(route('testings.index'));
        }

        $testing = $this->testingRepository->update($request->all(), $id);

        Flash::success('Testing updated successfully.');

        return redirect(route('testings.index'));
    }

    /**
     * Remove the specified Testing from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $testing = $this->testingRepository->findWithoutFail($id);

        if (empty($testing)) {
            Flash::error('Testing not found');

            return redirect(route('testings.index'));
        }

        $this->testingRepository->delete($id);

        Flash::success('Testing deleted successfully.');

        return redirect(route('testings.index'));
    }
}
