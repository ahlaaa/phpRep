<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStandardRequest;
use App\Http\Requests\UpdateStandardRequest;
use App\Repositories\StandardRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StandardController extends AppBaseController
{
    /** @var  StandardRepository */
    private $standardRepository;

    public function __construct(StandardRepository $standardRepo)
    {
        $this->standardRepository = $standardRepo;
    }

    /**
     * Display a listing of the Standard.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->standardRepository->pushCriteria(new RequestCriteria($request));
        $standards = $this->standardRepository->paginate(15);

        return view('standards.index')
            ->with('standards', $standards);
    }

    /**
     * Show the form for creating a new Standard.
     *
     * @return Response
     */
    public function create()
    {
        return view('standards.create');
    }

    /**
     * Store a newly created Standard in storage.
     *
     * @param CreateStandardRequest $request
     *
     * @return Response
     */
    public function store(CreateStandardRequest $request)
    {
        $input = $request->all();
        \Log::info(json_encode($_REQUEST));
        $standard = $this->standardRepository->create($input);

        Flash::success('Standard saved successfully.');

        return redirect(route('standards.index'));
    }

    /**
     * Display the specified Standard.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            Flash::error('Standard not found');

            return redirect(route('standards.index'));
        }

        return view('standards.show')->with('standard', $standard);
    }

    /**
     * Show the form for editing the specified Standard.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            Flash::error('Standard not found');

            return redirect(route('standards.index'));
        }

        return view('standards.edit')->with('standard', $standard);
    }

    /**
     * Update the specified Standard in storage.
     *
     * @param  int              $id
     * @param UpdateStandardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStandardRequest $request)
    {
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            Flash::error('Standard not found');

            return redirect(route('standards.index'));
        }

        $standard = $this->standardRepository->update($request->all(), $id);

        Flash::success('Standard updated successfully.');

        return redirect(route('standards.index'));
    }

    /**
     * Remove the specified Standard from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $standard = $this->standardRepository->findWithoutFail($id);

        if (empty($standard)) {
            Flash::error('Standard not found');

            return redirect(route('standards.index'));
        }

        $this->standardRepository->delete($id);

        Flash::success('Standard deleted successfully.');

        return redirect(route('standards.index'));
    }
}
