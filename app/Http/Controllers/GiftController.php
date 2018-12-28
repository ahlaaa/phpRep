<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGiftRequest;
use App\Http\Requests\UpdateGiftRequest;
use App\Repositories\GiftRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GiftController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(GiftRepository $articleRepo)
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

        return view('cards.index')
            ->with('gifts', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('gifts.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateGiftRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('gifts 保存成功');

        return redirect(route('gifts.index'));
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
            Flash::error('gifts not found');

            return redirect(route('gifts.index'));
        }

        return view('gifts.show')->with('gift', $article);
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
            Flash::error('gifts not found');

            return redirect(route('gifts.index'));
        }

        return view('gifts.edit')->with('gift', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGiftRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('gifts not found');

            return redirect(route('gifts.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('gifts 更新成功.');

        return redirect(route('gifts.index'));
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
            Flash::error('gifts not found');

            return redirect(route('gifts.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('gifts deleted successfully.');

        return redirect(route('gifts.index'));
    }
}
