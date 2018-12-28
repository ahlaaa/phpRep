<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 15:08
 */

namespace App\Http\Controllers;


use App\Http\Requests\CreateMaintainRequest;
use App\Http\Requests\UpdateMaintainRequest;
use App\Repositories\MaintainRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Repository\Criteria\RequestCriteria;

class MaintainController extends AppBaseController
{
    private $maintainReposity;

    public function __construct(MaintainRepository $maintainRepository)
    {
        $this->maintainReposity = $maintainRepository;
    }

    public function index(Request $request){
        $this->maintainReposity->pushCriteria(new RequestCriteria($request));
        \DB::enableQueryLog();
        $maintains = $this->maintainReposity->paginate(15);
        \Log::info(json_encode(\DB::getQueryLog()));
        \Log::info(json_encode(\Auth::id()));
        return view('maintains.index')->with('maintains',$maintains);
    }

    public function edit(Request $request,$id){
        $maintain = $this->maintainReposity->findWithoutFail($id);
        if(empty($maintain)){
            Flash::error('Maintain Not Exist');
            return redirect(route('maintains.index'));
        }
        return view('maintains.edit')->with('maintain',$maintain);
    }

    public function update(UpdateMaintainRequest $request,$id){
        $maintain = $this->maintainReposity->findWithoutFail($id);
        if(empty($maintain)){
            Flash::error('Maintain Not Exist');
            return redirect(route('maintains.index'));
        }
        $input = $request->all();
        $this->maintainReposity->update($input,$id);
        Flash::success('Update Maintain Success');
        return redirect(route('maintains.index'));
    }

    public function show(Request $request,$id){
        $maintain = $this->maintainReposity->findWithoutFail($id);
        if(empty($maintain)){
            Flash::error('Maintain Not Exist');
            return redirect(route('maintains.index'));
        }
        return view('maintains.show')->with('maintain',$maintain);
    }

    public function create(Request $request){
        return view('maintains.create');
    }

    public function store(CreateMaintainRequest $request){
        $input = $request->all();
        $this->maintainReposity->create($input);
        Flash::success('Update Maintain Success');
        return redirect(route('maintains.index'));
    }

    public function destroy(Request $request,$id){
        $this->maintainReposity->delete($id);
        Flash::success('Delete Maintain Success');
        return redirect(route('maintains.index'));
    }
}