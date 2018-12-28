<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedalRequest;
use App\Http\Requests\UpdateMedalRequest;
use App\Repositories\MedalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MedalController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(MedalRepository $articleRepo)
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

        return view('medals.index')
            ->with('medals', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('medals.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateMedalRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('medal 保存成功');

        return redirect(route('medals.index'));
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
            Flash::error('medal not found');

            return redirect(route('medals.index'));
        }

        return view('medals.show')->with('medal', $article);
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
            Flash::error('medals not found');

            return redirect(route('medals.index'));
        }

        return view('medals.edit')->with('medal', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedalRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('medals not found');

            return redirect(route('medals.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('medals 更新成功.');

        return redirect(route('medals.index'));
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
            Flash::error('medals not found');

            return redirect(route('medals.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('medals deleted successfully.');

        return redirect(route('medals.index'));
    }
}
