<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpressRequest;
use App\Http\Requests\UpdateExpressRequest;
use App\Repositories\ExpressRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ExpressController extends AppBaseController
{
    /** @var  ExpressRepository */
    private $expressRepository;

    public function __construct(ExpressRepository $expressRepo)
    {
        $this->expressRepository = $expressRepo;
    }

    /**
     * Display a listing of the Express.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->expressRepository->pushCriteria(new RequestCriteria($request));
        $expresses = $this->expressRepository->paginate(15);

        return view('expresses.index')
            ->with('expresses', $expresses);
    }

    /**
     * Show the form for creating a new Express.
     *
     * @return Response
     */
    public function create()
    {
        return view('expresses.create');
    }

    /**
     * Store a newly created Express in storage.
     *
     * @param CreateExpressRequest $request
     *
     * @return Response
     */
    public function store(CreateExpressRequest $request)
    {
        $input = $request->all();

        $express = $this->expressRepository->create($input);

        Flash::success('Express 保存成功');

        return redirect(route('expresses.index'));
    }

    /**
     * Display the specified Express.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            Flash::error('Express not found');

            return redirect(route('expresses.index'));
        }

        return view('expresses.show')->with('express', $express);
    }

    /**
     * Show the form for editing the specified Express.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            Flash::error('Express not found');

            return redirect(route('expresses.index'));
        }

        return view('expresses.edit')->with('express', $express);
    }

    /**
     * Update the specified Express in storage.
     *
     * @param  int              $id
     * @param UpdateExpressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpressRequest $request)
    {
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            Flash::error('Express not found');

            return redirect(route('expresses.index'));
        }

        $express = $this->expressRepository->update($request->all(), $id);

        Flash::success('Express 更新成功.');

        return redirect(route('expresses.index'));
    }

    /**
     * Remove the specified Express from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $express = $this->expressRepository->findWithoutFail($id);

        if (empty($express)) {
            Flash::error('Express not found');

            return redirect(route('expresses.index'));
        }

        $this->expressRepository->delete($id);

        Flash::success('Express deleted successfully.');

        return redirect(route('expresses.index'));
    }
}
