<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedalAPIRequest;
use App\Http\Requests\API\UpdateMedalAPIRequest;
use App\Models\Medal;
use App\Models\User;
use App\Repositories\MedalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArticleController
 * @package App\Http\Controllers\API
 */
class MedalAPIController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(MedalRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/articles",
     *      summary="Get a listing of the Articles.",
     *      tags={"文章"},
     *      description="Get all Articles",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Article")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->articleRepository->pushCriteria(new RequestCriteria($request));
        $this->articleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $articles = $this->articleRepository->paginate(15);

        return $this->sendResponse($articles->toArray(), '勋章获取成功');
    }

    /**
     * @param CreateArticleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/articles",
     *      summary="Store a newly created Article in storage",
     *      tags={"文章"},
     *      description="Store 文章",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Article that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Article")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Article"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedalAPIRequest $request)
    {
        $input = $request->all();

        $articles = $this->articleRepository->create($input);

        return $this->sendResponse($articles->toArray(), '勋章保存成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/articles/{id}",
     *      summary="Display the specified Article",
     *      tags={"文章"},
     *      description="Get Article",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Article",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Article"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

//        $article->load('products');

        if (empty($article)) {
            return $this->sendError('勋章未找到');
        }

        return $this->sendResponse($article->toArray(), '勋章获取成功');
    }

    /**
     * @param int $id
     * @param UpdateArticleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/articles/{id}",
     *      summary="Update the specified Article in storage",
     *      tags={"文章"},
     *      description="Update 文章",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of 文章",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Article that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Article")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Article"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('勋章未找到');
        }

        $article = $this->articleRepository->update($input, $id);

        return $this->sendResponse($article->toArray(), '勋章更新成功');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/articles/{id}",
     *      summary="Remove the specified Article from storage",
     *      tags={"文章"},
     *      description="Delete 文章",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of 文章",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('勋章未找到');
        }

        $article->delete();

        return $this->sendResponse($id, '勋章删除成功');
    }

    public function gains(){
        $medals = Medal::get()->pluck('prob_num','id');
        $arr = array();
        for ($i = 1;$i < 101;$i++){
            $num = random_int(1,4);
            $arr1 = $arr[$num]??array();
            while (sizeof($arr1) >= $medals[$num]){
                $num = random_int(1,4);
                $arr1 = $arr[$num]??array();
            }
            array_push($arr1,$i);
            $arr[$num] = $arr1;
        }
        $rdmMID = random_int(1,100);
        $getMID = 1;
        foreach ($arr as $k=>$v){
            if (in_array($rdmMID,$v))
                $getMID = $k;
        }
        $user_id = \Auth::user()->id;
        $user = User::find($user_id);
        $user->decrement('card_times',1);
        $u_medals = \DB::table('medal_user')->where([['user_id',$user_id],['medal_id',$getMID]])->first();
        if (empty($u_medals)){
            $data = array('user_id'=>$user_id,'medal_id'=>$getMID,'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),'medal_num'=>1);
            \DB::table('medal_user')->insert($data);
        }else{
            $data = array('updated_at'=>date('Y-m-d H:i:s'),'medal_num'=>$u_medals->medal_num+1);
            \DB::table('medal_user')->where('id',$u_medals->id)->update($data);
        }
        return $this->sendResponse($getMID,'抽取勋章成功');
    }
}
