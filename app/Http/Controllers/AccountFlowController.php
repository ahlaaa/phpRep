<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountFlowRequest;
use App\Http\Requests\UpdateAccountFlowRequest;
use App\Repositories\AccountFlowRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AccountFlowController extends AppBaseController
{
    /** @var  AccountFlowRepository */
    private $accountFlowRepository;

    public function __construct(AccountFlowRepository $accountFlowRepo)
    {
        $this->accountFlowRepository = $accountFlowRepo;
    }

    /**
     * Display a listing of the AccountFlow.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountFlowRepository->pushCriteria(new RequestCriteria($request));
        $accountFlows = $this->accountFlowRepository
            ->with(['user'])
            ->paginate(15);

        return view('account_flows.index')
            ->with('accountFlows', $accountFlows);
    }

    /**
     * Show the form for creating a new AccountFlow.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_flows.create');
    }

    /**
     * Store a newly created AccountFlow in storage.
     *
     * @param CreateAccountFlowRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountFlowRequest $request)
    {
        $input = $request->all();

        $accountFlow = $this->accountFlowRepository->create($input);

        Flash::success('Account Flow saved successfully.');

        return redirect(route('accountFlows.index'));
    }

    /**
     * Display the specified AccountFlow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            Flash::error('Account Flow not found');

            return redirect(route('accountFlows.index'));
        }

        return view('account_flows.show')->with('accountFlow', $accountFlow);
    }

    /**
     * Show the form for editing the specified AccountFlow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            Flash::error('Account Flow not found');

            return redirect(route('accountFlows.index'));
        }

        return view('account_flows.edit')->with('accountFlow', $accountFlow);
    }

    /**
     * Update the specified AccountFlow in storage.
     *
     * @param  int              $id
     * @param UpdateAccountFlowRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountFlowRequest $request)
    {
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            Flash::error('Account Flow not found');

            return redirect(route('accountFlows.index'));
        }

        $accountFlow = $this->accountFlowRepository->update($request->all(), $id);

        Flash::success('Account Flow updated successfully.');

        return redirect(route('accountFlows.index'));
    }

    /**
     * Remove the specified AccountFlow from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountFlow = $this->accountFlowRepository->findWithoutFail($id);

        if (empty($accountFlow)) {
            Flash::error('Account Flow not found');

            return redirect(route('accountFlows.index'));
        }

        $this->accountFlowRepository->delete($id);

        Flash::success('Account Flow deleted successfully.');

        return redirect(route('accountFlows.index'));
    }
}
