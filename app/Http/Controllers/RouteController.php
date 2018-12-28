<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Repositories\RouteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RouteController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(RouteRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the Article.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->articleRepository->pushCriteria(new RequestCriteria($request));
        $articles = $this->articleRepository->paginate(15);

        return view('routes.index')
            ->with('routes', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('routes.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateRouteRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('routes 保存成功');

        return redirect(route('routes.index'));
    }

    /**
     * Display the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('routes not found');

            return redirect(route('routes.index'));
        }

        return view('routes.show')->with('route', $article);
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
            Flash::error('routes not found');

            return redirect(route('routes.index'));
        }

        return view('routes.edit')->with('route', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRouteRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('routes not found');

            return redirect(route('routes.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('routes 更新成功.');

        return redirect(route('routes.index'));
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('routes not found');

            return redirect(route('routes.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('routes deleted successfully.');

        return redirect(route('routes.index'));
    }
}
