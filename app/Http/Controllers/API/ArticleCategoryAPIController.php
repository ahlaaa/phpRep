<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArticleCategoryAPIRequest;
use App\Http\Requests\API\UpdateArticleCategoryAPIRequest;
use App\Models\ArticleCategory;
use App\Repositories\ArticleCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArticleCategoryController
 * @package App\Http\Controllers\API
 */

class ArticleCategoryAPIController extends AppBaseController
{
    /** @var  ArticleCategoryRepository */
    private $articleCategoryRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepo)
    {
        $this->articleCategoryRepository = $articleCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/articleCategories",
     *      summary="Get a listing of the ArticleCategories.",
     *      tags={"ArticleCategory"},
     *      description="Get all ArticleCategories",
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
     *                  @SWG\Items(ref="#/definitions/ArticleCategory")
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
        $this->articleCategoryRepository->pushCriteria(new RequestCriteria($request));
        $this->articleCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $articleCategories = $this->articleCategoryRepository->all();

        return $this->sendResponse($articleCategories->toArray(), 'Article Categories retrieved successfully');
    }

    /**
     * @param CreateArticleCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/articleCategories",
     *      summary="Store a newly created ArticleCategory in storage",
     *      tags={"ArticleCategory"},
     *      description="Store ArticleCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ArticleCategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleCategory")
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
     *                  ref="#/definitions/ArticleCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArticleCategoryAPIRequest $request)
    {
        $input = $request->all();

        $articleCategories = $this->articleCategoryRepository->create($input);

        return $this->sendResponse($articleCategories->toArray(), 'Article Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/articleCategories/{id}",
     *      summary="Display the specified ArticleCategory",
     *      tags={"ArticleCategory"},
     *      description="Get ArticleCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleCategory",
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
     *                  ref="#/definitions/ArticleCategory"
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
        /** @var ArticleCategory $articleCategory */
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            return $this->sendError('Article Category not found');
        }

        return $this->sendResponse($articleCategory->toArray(), 'Article Category retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateArticleCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/articleCategories/{id}",
     *      summary="Update the specified ArticleCategory in storage",
     *      tags={"ArticleCategory"},
     *      description="Update ArticleCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ArticleCategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleCategory")
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
     *                  ref="#/definitions/ArticleCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArticleCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var ArticleCategory $articleCategory */
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            return $this->sendError('Article Category not found');
        }

        $articleCategory = $this->articleCategoryRepository->update($input, $id);

        return $this->sendResponse($articleCategory->toArray(), 'ArticleCategory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/articleCategories/{id}",
     *      summary="Remove the specified ArticleCategory from storage",
     *      tags={"ArticleCategory"},
     *      description="Delete ArticleCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleCategory",
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
        /** @var ArticleCategory $articleCategory */
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            return $this->sendError('Article Category not found');
        }

        $articleCategory->delete();

        return $this->sendResponse($id, 'Article Category deleted successfully');
    }
}
