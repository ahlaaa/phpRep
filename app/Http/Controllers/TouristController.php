<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use App\Models\Tourist;
use App\Models\UserOrder;
use App\Repositories\TouristRepository;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArticleController
 * @package App\Http\Controllers\API
 */
class TouristController extends AppBaseController
{
    /** @var  UserRepository */
    private $articleRepository;

    public function __construct(TouristRepository $userRepo)
    {
        $this->articleRepository = $userRepo;
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

        return view('tourists.index')
            ->with('tourists', $articles);
    }

    public function create(){
        return view('tourists.create');
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
     * 增加旅游用戶
     */
    public function store(CreateTouristRequest $request)
    {
        $input = $request->all();

        $articles = $this->articleRepository->create($input);

        return redirect(route('tourists.index'));
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
     * 显示个人单个旅游详情
     */
    public function show($id)
    {
        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

//        $article->load('products');

        if (empty($article)) {
            return $this->sendError('旅游信息未找到');
        }

        return $this->sendResponse($article->toArray(), '旅游信息获取成功');
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('旅游信息 not found');

            return redirect(route('tourists.index'));
        }

        return view('tourists.edit')->with('tourist', $article);
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
     * 修改状态旅游用戶
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('旅游信息 not found');
            return redirect(route('tourists.index'));
        }

        $article = $this->articleRepository->update($input, $id);
        Flash::success('旅游信息 更新成功.');

        return redirect(route('tourists.index'));
    }


    public function out($id,Request $request){

        $uo = UserOrder::find($id);
        if (empty($uo)){
            Flash::error("为找到");
            return redirect(route("tourists.index"));
        }
        $uo->status = 2;
        $uo->save();
        Flash::success("用户退出成功");
        return redirect(route("tourists.edit",[$uo->first_oid]));
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
     * 退出
     */
    public function destroy($id)
    {
        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('旅游信息未找到');
        }

        $article->delete(true);

        return $this->sendResponse($id, '旅游信息退出成功');
    }
}
