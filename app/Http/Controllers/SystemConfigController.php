<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSystemConfigRequest;
use App\Http\Requests\UpdateSystemConfigRequest;
use App\Repositories\SystemConfigRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SystemConfigController extends AppBaseController
{
    /** @var  SystemConfigRepository */
    private $systemConfigRepository;

    public function __construct(SystemConfigRepository $systemConfigRepo)
    {
        $this->systemConfigRepository = $systemConfigRepo;
    }

    /**
     * Display a listing of the SystemConfig.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->systemConfigRepository->pushCriteria(new RequestCriteria($request));
        $systemConfigs = $this->systemConfigRepository->paginate(15);

        return view('system_configs.index')
            ->with('systemConfigs', $systemConfigs);
    }

    /**
     * Show the form for creating a new SystemConfig.
     *
     * @return Response
     */
    public function create()
    {
        return view('system_configs.create');
    }

    /**
     * Store a newly created SystemConfig in storage.
     *
     * @param CreateSystemConfigRequest $request
     *
     * @return Response
     */
    public function store(CreateSystemConfigRequest $request)
    {
        $input = $request->all();

        $systemConfig = $this->systemConfigRepository->create($input);

        Flash::success('System Config saved successfully.');

        return redirect(route('systemConfigs.index'));
    }

    /**
     * Display the specified SystemConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            Flash::error('System Config not found');

            return redirect(route('systemConfigs.index'));
        }

        return view('system_configs.show')->with('systemConfig', $systemConfig);
    }

    /**
     * Show the form for editing the specified SystemConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            Flash::error('System Config not found');

            return redirect(route('systemConfigs.edit'));
        }

        return view('system_configs.edit')->with('systemConfig', $systemConfig);
    }

    /**
     * Update the specified SystemConfig in storage.
     *
     * @param  int              $id
     * @param UpdateSystemConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSystemConfigRequest $request)
    {
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            Flash::error('System Config not found');

            return redirect(route('systemConfigs.edit', $id));
        }

        $systemConfig = $this->systemConfigRepository->update($request->all(), $id);

        Flash::success('System Config updated successfully.');

        return redirect(route('systemConfigs.edit', $id));
    }

    /**
     * Remove the specified SystemConfig from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $systemConfig = $this->systemConfigRepository->findWithoutFail($id);

        if (empty($systemConfig)) {
            Flash::error('System Config not found');

            return redirect(route('systemConfigs.index'));
        }

        $this->systemConfigRepository->delete($id);

        Flash::success('System Config deleted successfully.');

        return redirect(route('systemConfigs.index'));
    }
}
