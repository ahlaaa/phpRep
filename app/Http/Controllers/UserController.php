<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth;
use App\Criteria\UserCriteria;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Models\Log;
use App\Models\Grade;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserController extends AppBaseController
{

    use AuthenticatesUsers;
    /** @var  UserRepository */
    private $userRepository;
    private $loginUser;
    // private $logRepository;
    // private $gradeRepository;

    public function __construct(UserRepository $userRepo)//,LogRepository $logRepository)
    {
        $this->userRepository = $userRepo;
        // $this->middleware('guest')->except('logout');
      //  $this->logRepository = $logRepository;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $this->getUser();
        // $au = new AuthenticatesUsers();
        $guard = $this->guard();
        $session = 1;//$request->session();

        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $this->userRepository->pushCriteria(UserCriteria::class);
        $users = $this->userRepository->scopeQuery(function ($query) use ($request) {
            return $query->whereType($request->get('type', 1));
        })->with(['superior', 'grade'])->paginate();

        return view('users.index')->with('users', $users)->with('test',[$user,$guard,$session]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = 123456;
//        array_add($input, 'password', 123456);

        $user = $this->userRepository->create($input);

        Flash::success('User 保存成功');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $params = $request->all();
        /*
        'status',
        'type',
        'type',
        'grade_id',
        'superior_id',
        'img_head',
        'province',
        'city',
        'county',
        'point',
        'rebate',

         'txt',
        'updated_user_id',
        'updated_user_name',
        'created_user_id',
        'created_user_name'
        */
        $loginUser = $this->getUser();
        $logRepository = new Log();
        $gradeRepository = new Grade();
        $u_name = $user->name??'用户名信息错误';
        $u_id = $user->id??null;
        $data = ["txt"=>null,"updated_user_id"=>null,"updated_user_name"=>$loginUser->username??null,"created_user_id"=>$loginUser->id??null,"created_user_name"=>$u_name];
        // $this->logRepository->create($data);
        if(isset($params['status'])){
            if($user->status != $params['status']){
                $status = constants('USER_STATUS');
                $statu = $status[$params['status']]??'status错误';
                $data['txt'] = "(".$u_name.")的状态修改为:".$statu;
                $logRepository->create($data);
            }
        }
        if(isset($params['type'])){
            if($user->type != $params['type']){
                $u_type = constants('USER_TYPE');
                $u_stype = constants('GRADE_TYPE');
                $type = $params['type']??$params->type;
                $type_name = null;
                if(isset($u_type[$type])){
                    $type_name = $u_type[$type]??$u_type->$type;
                }
                if(isset($u_stype[$type])){
                    $type_name = $u_stype[$type]??$u_stype->$type;
                }
                $data['txt'] = "(".$u_name.")的type修改为:".$type_name;
                $logRepository->create($data);
             }
        }
        if(isset($params['grade_id'])){
            if($user->grade_id != $params['grade_id']){
                $grade = $gradeRepository->find($params['grade_id']);
            
                $data['txt'] = "(".$u_name.")的等级修改为:".$grade->name??null;
                $logRepository->create($data);
            }
        }
        if(isset($params['superior_id'])){
            if($user->superior_id != $params['superior_id']){
                $us = $this->userRepository->findWithoutFail($params['superior_id']);
            
                $data['txt'] = "(".$u_name.")的上级修改为:".$us->name;
                $logRepository->create($data);
            }
        }
        if(isset($params['point'])){
            if($user->point != $params['point']){
                $data['txt'] = "(".$u_name.")的献金修改为:".$user->point."->".$params['point'];
                $logRepository->create($data);
            }
        }
        if(isset($params['rebate'])){
            if($user->rebate != $params['rebate']){
                $data['txt'] = "(".$u_name.")的返利修改为:".$user->rebate."->".$params['rebate'];
                $logRepository->create($data);
            }
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User 更新成功.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function password(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'password' => 'required|between:6,20',
                're_password' => 'required|same:password',
            ]);

            $this->userRepository->update(['password' => bcrypt($request->password)], $id);

            Flash::success('用户修改密码成功');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.password')->with('user', $user);
    }

    public function tree(int $id): string
    {
        $user = $this->userRepository->findWithoutFail($id);
        // dd($user->tree);
        return view('users.tree', ['user' => $user]);
    }
}
