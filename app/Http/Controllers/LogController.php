<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWithdrawRequest;
use App\Http\Requests\UpdateWithdrawRequest;
use App\Repositories\LogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LogController extends AppBaseController
{
    /** @var  WithdrawRepository */
    private $logRepository;

    public function __construct(LogRepository $withdrawRepo)
    {
        $this->logRepository = $withdrawRepo;
    }

    /**
     * Display a listing of the Withdraw.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // return 1111;
        $this->logRepository->pushCriteria(new RequestCriteria($request));
        $logs = $this->logRepository->paginate(15);
        // return json_encode($withdraws);
        return view('withdraws.logs')
            ->with('logs', $logs);
    }
    
}
