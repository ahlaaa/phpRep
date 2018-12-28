<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 15:08
 */

namespace App\Http\Controllers\API;


use App\Http\Requests\CreateMaintainRequest;
use App\Http\Requests\UpdateMaintainRequest;
use App\Repositories\MaintainRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Auth;

class MaintainAPIController extends AppBaseController
{
    private $maintainReposity;

    public function __construct(MaintainRepository $maintainRepository)
    {
        $this->maintainReposity = $maintainRepository;
    }

    public function index(Request $request){
        $this->maintainReposity->pushCriteria(new RequestCriteria($request));
        $maintains = $this->maintainReposity->scopeQuery(function($query){
            return $query->where('user_id',Auth::id());
        })->with('order')->paginate(15);
        return $this->sendResponse($maintains->toArray(),'维权订单获取成功');
    }

//    public function edit(Request $request,$id){
//        $maintain = $this->maintainReposity->findWithoutFail($id);
//        if(empty($maintain)){
//            Flash::error('Maintain Not Exist');
//            return redirect(route('maintains.index'));
//        }
//        return view('maintains.edit')->with('maintain',$maintain);
//    }

    public function update(UpdateMaintainRequest $request,$id){
        $maintain = $this->maintainReposity->scopeQuery(function($query){
            return $query->where('user_id',Auth::id());
        })->with('order')->findWithoutFail($id);
        if(empty($maintain)){
            return $this->sendError('维权信息未找到',404);
        }
        $input = $request->all();
        $maintain = $this->maintainReposity->update($input,$id);
        return $this->sendResponse($maintain->toArray(),'维权订单更新成功');
    }

    public function show(Request $request,$id){
        $maintain = $this->maintainReposity->scopeQuery(function($query){
            return $query->where('user_id',Auth::id());
        })->with('order')->findWithoutFail($id);
        return $this->sendResponse($maintain->toArray(),'维权订单获取成功');
    }

//    public function create(Request $request){
//        return view('maintains.create');
//    }

    public function store(CreateMaintainRequest $request){
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $maintain = $this->maintainReposity->create($input);
        return $this->sendResponse($maintain->toArray(),'维权申请成功');
    }

    public function destroy(Request $request,$id){
        $maintain = $this->maintainReposity->delete($id);
        return $this->sendResponse($maintain->toArray(),'维权删除成功');
    }
}