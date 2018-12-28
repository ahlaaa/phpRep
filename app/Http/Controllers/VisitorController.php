<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Repositories\VisitorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class VisitorController extends AppBaseController
{
    /** @var  VisitorRepository */
    private $visitorRepository;

    public function __construct(VisitorRepository $visitorRepo)
    {
        $this->visitorRepository = $visitorRepo;
    }

    /**
     * Display a listing of the Visitor.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->visitorRepository->pushCriteria(new RequestCriteria($request));
        $visitors = $this->visitorRepository->paginate(15);

        return view('visitors.index')
            ->with('visitors', $visitors);
    }

    /**
     * Show the form for creating a new Visitor.
     *
     * @return Response
     */
    public function create()
    {
        return view('visitors.create');
    }

    /**
     * Store a newly created Visitor in storage.
     *
     * @param CreateVisitorRequest $request
     *
     * @return Response
     */
    public function store(CreateVisitorRequest $request)
    {
        $input = $request->all();

        $visitor = $this->visitorRepository->create($input);

        Flash::success('Visitor saved successfully.');

        return redirect(route('visitors.index'));
    }

    /**
     * Display the specified Visitor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        return view('visitors.show')->with('visitor', $visitor);
    }

    /**
     * Show the form for editing the specified Visitor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        return view('visitors.edit')->with('visitor', $visitor);
    }

    /**
     * Update the specified Visitor in storage.
     *
     * @param  int              $id
     * @param UpdateVisitorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVisitorRequest $request)
    {
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        $visitor = $this->visitorRepository->update($request->all(), $id);

        Flash::success('Visitor updated successfully.');

        return redirect(route('visitors.index'));
    }

    /**
     * Remove the specified Visitor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $visitor = $this->visitorRepository->findWithoutFail($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        $this->visitorRepository->delete($id);

        Flash::success('Visitor deleted successfully.');

        return redirect(route('visitors.index'));
    }
}
