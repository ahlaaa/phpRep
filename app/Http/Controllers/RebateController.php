<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRebateRequest;
use App\Http\Requests\UpdateRebateRequest;
use App\Repositories\RebateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RebateController extends AppBaseController
{
    /** @var  RebateRepository */
    private $rebateRepository;

    public function __construct(RebateRepository $rebateRepo)
    {
        $this->rebateRepository = $rebateRepo;
    }

    /**
     * Display a listing of the Rebate.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rebateRepository->pushCriteria(new RequestCriteria($request));
        $rebates = $this->rebateRepository->with('user')->paginate();

        return view('rebates.index')
            ->with('rebates', $rebates);
    }

    /**
     * Show the form for creating a new Rebate.
     *
     * @return Response
     */
    public function create()
    {
        return view('rebates.create');
    }

    /**
     * Store a newly created Rebate in storage.
     *
     * @param CreateRebateRequest $request
     *
     * @return Response
     */
    public function store(CreateRebateRequest $request)
    {
        $input = $request->all();

        $rebate = $this->rebateRepository->create($input);

        Flash::success('Rebate saved successfully.');

        return redirect(route('rebates.index'));
    }

    /**
     * Display the specified Rebate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            Flash::error('Rebate not found');

            return redirect(route('rebates.index'));
        }

        return view('rebates.show')->with('rebate', $rebate);
    }

    /**
     * Show the form for editing the specified Rebate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            Flash::error('Rebate not found');

            return redirect(route('rebates.index'));
        }

        return view('rebates.edit')->with('rebate', $rebate);
    }

    /**
     * Update the specified Rebate in storage.
     *
     * @param  int              $id
     * @param UpdateRebateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRebateRequest $request)
    {
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            Flash::error('Rebate not found');

            return redirect(route('rebates.index'));
        }

        $rebate = $this->rebateRepository->update($request->all(), $id);

        Flash::success('Rebate updated successfully.');

        return redirect(route('rebates.index'));
    }

    /**
     * Remove the specified Rebate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rebate = $this->rebateRepository->findWithoutFail($id);

        if (empty($rebate)) {
            Flash::error('Rebate not found');

            return redirect(route('rebates.index'));
        }

        $this->rebateRepository->delete($id);

        Flash::success('Rebate deleted successfully.');

        return redirect(route('rebates.index'));
    }
}
