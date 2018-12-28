<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExchangelogAPIRequest;
use App\Http\Requests\API\UpdateExchangelogAPIRequest;
use App\Models\Exchangelog;
use App\Repositories\ExchangelogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArticleController
 * @package App\Http\Controllers\API
 */
class ExchangelogAPIController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ExchangelogRepository $articleRepo)
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
        $articles = $this->articleRepository->scopeQuery(function ($query){
            return $query->where('user_id',optional(\Auth::user())->id??null);
        })->paginate(15);

        return $this->sendResponse($articles->toArray(), '兑换记录获取成功');
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
    public function store(CreateExchangelogAPIRequest $request)
    {
        $input = $request->all();

        $articles = $this->articleRepository->create($input);

        return $this->sendResponse($articles->toArray(), '记录保存成功');
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
            return $this->sendError('对换记录未找到');
        }

        return $this->sendResponse($article->toArray(), '兑换记录获取成功');
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
    public function update($id, UpdateCardAPIRequest $request)
    {
        $input = $request->all();

        /** @var Article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('记录未找到');
        }

        $article = $this->articleRepository->update($input, $id);

        return $this->sendResponse($article->toArray(), '记录更新成功');
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
            return $this->sendError('记录未找到');
        }

        $article->delete();

        return $this->sendResponse($id, '记录删除成功');
    }
}
