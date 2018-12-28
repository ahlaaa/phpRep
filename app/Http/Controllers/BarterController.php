<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarterRequest;
use App\Http\Requests\UpdateBarterRequest;
use App\Repositories\BarterRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ExpressRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BarterController extends AppBaseController
{
    /** @var  BarterRepository */
    private $barterRepository;

    public function __construct(BarterRepository $barterRepo)
    {
        $this->barterRepository = $barterRepo;
    }

    /**
     * Display a listing of the Barter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->barterRepository->pushCriteria(new RequestCriteria($request));
        $barters = $this->barterRepository->with('user')->paginate(15);

        return view('barters.index')
            ->with('barters', $barters);
    }

    /**
     * Show the form for creating a new Barter.
     *
     * @return Response
     */
    public function create(ExpressRepository $expressRepository)
    {
        return view('barters.create')
            ->with('customer', app(UserRepository::class)->customers())
            ->with('expresses', $expressRepository->pluck('name', 'name'));

    }

    /**
     * Store a newly created Barter in storage.
     *
     * @param CreateBarterRequest $request
     *
     * @return Response
     */
    public function store(CreateBarterRequest $request)
    {
        $input = $request->all();

        $barter = $this->barterRepository->create($input);

        Flash::success('Barter saved successfully.');

        return redirect(route('barters.index'));
    }

    /**
     * Display the specified Barter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            Flash::error('Barter not found');

            return redirect(route('barters.index'));
        }

        return view('barters.show')->with('barter', $barter);
    }

    /**
     * Show the form for editing the specified Barter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(ExpressRepository $expressRepository, $id)
    {
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            Flash::error('Barter not found');

            return redirect(route('barters.index'));
        }

        return view('barters.edit')->with('barter', $barter)
            ->with('customer', app(UserRepository::class)->customers())
            ->with('expresses', $expressRepository->pluck('name', 'name'));
    }

    /**
     * Update the specified Barter in storage.
     *
     * @param  int              $id
     * @param UpdateBarterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBarterRequest $request)
    {
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            Flash::error('Barter not found');

            return redirect(route('barters.index'));
        }

        $barter = $this->barterRepository->update($request->all(), $id);

        Flash::success('Barter updated successfully.');

        return redirect(route('barters.index'));
    }

    /**
     * Remove the specified Barter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $barter = $this->barterRepository->findWithoutFail($id);

        if (empty($barter)) {
            Flash::error('Barter not found');

            return redirect(route('barters.index'));
        }

        $this->barterRepository->delete($id);

        Flash::success('Barter deleted successfully.');

        return redirect(route('barters.index'));
    }
}
