<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/17
 * Time: 16:42
 */

namespace App\Http\Controllers;


use App\Models\Log;
use App\Repositories\TagRepository;
use Doctrine\Common\Collections\Criteria;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Repository\Criteria\RequestCriteria;

class TagController extends AppBaseController
{
    private $tagReposity;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagReposity = $tagRepository;
    }

    public function index(Request $request){
        $this->tagReposity->pushCriteria(new RequestCriteria($request));
        $tags = $this->tagReposity->paginate(15);
        return view('tags.index')->with('tags',$tags);
    }

    public function create(){
        return view('tags.create');
    }

    public function store(Request $request){
        $this->tagReposity->create($request->all());
        Flash::success('Tag Create');
        return redirect(route('tags.index'));
    }

    public function edit(Request $request,$id){
        $tag = $this->tagReposity->findWithoutFail($id);
        if(empty($tag)){
            Flash::error('Tag Not Exit');
            return redirect(route('tags.index'));
        }
        return view('tags.edit')->with('tag',$tag);
    }

    public function update(Request $request,$id){
        $tag = $this->tagReposity->findWithoutFail($id);
        if(empty($tag)){
            Flash::error('Tag Not Exit');
            return redirect(route('tags.index'));
        }
        $this->tagReposity->update($request->all(),$id);
        Flash::success('Tag Update Success');
        return redirect(route('tags.index'));
    }

    public function destroy($id){
        $tag = $this->tagReposity->findWithoutFail($id);
        if(empty($tag)){
            Flash::error('Tag Not Exit');
            return redirect(route('tags.index'));
        }
        $this->tagReposity->delete($id);
        Flash::success('Tag Delete Success');
        return redirect(route('tags.index'));
    }
}