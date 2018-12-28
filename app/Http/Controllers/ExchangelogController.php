<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExchangelogRequest;
use App\Http\Requests\UpdateExchangelogRequest;
use App\Repositories\ExchangelogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ExchangelogController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ExchangelogRepository $articleRepo)
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

        return view('exchangelogs.index')
            ->with('exchangelogs', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('exchangelogs.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateExchangelogRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('exchangelogs 保存成功');

        return redirect(route('exchangelogs.index'));
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
            Flash::error('exchangelogs not found');

            return redirect(route('exchangelogs.index'));
        }

        return view('exchangelogs.show')->with('exchangelog', $article);
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
            Flash::error('exchangelogs not found');

            return redirect(route('exchangelogs.index'));
        }

        return view('exchangelogs.edit')->with('exchangelog', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExchangelogRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('exchangelogs not found');

            return redirect(route('exchangelogs.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('exchangelogs 更新成功.');

        return redirect(route('exchangelogs.index'));
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
            Flash::error('exchangelogs not found');

            return redirect(route('exchangelogs.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('exchangelogs deleted successfully.');

        return redirect(route('exchangelogs.index'));
    }
}
