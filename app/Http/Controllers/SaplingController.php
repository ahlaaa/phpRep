<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Sapling;
use App\Repositories\SaplingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SaplingController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(SaplingRepository $articleRepo)
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
        $articles = $this->articleRepository->with(['user', 'product','order'])->paginate(15);

        return view('saplings.index')
            ->with('saplings', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('saplings.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('saplings 保存成功');

        return redirect(route('saplings.index'));
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
            Flash::error('saplings not found');

            return redirect(route('saplings.index'));
        }

        return view('saplings.show')->with('saplings', $article);
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
            Flash::error('saplings not found');

            return redirect(route('saplings.index'));
        }

        return view('saplings.edit')->with('sapling', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('saplings not found');

            return redirect(route('saplings.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('saplings 更新成功.');

        return redirect(route('saplings.index'));
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
            Flash::error('saplings not found');

            return redirect(route('saplings.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('saplings deleted successfully.');

        return redirect(route('saplings.index'));
    }
}
