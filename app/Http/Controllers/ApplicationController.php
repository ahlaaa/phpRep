<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Repositories\ApplicationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ApplicationController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ApplicationRepository $articleRepo)
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

        return view('applications.index')
            ->with('applications', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicationRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('applications 保存成功');

        return redirect(route('applications.index'));
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
            Flash::error('applications not found');

            return redirect(route('applications.index'));
        }

        return view('applications.show')->with('application', $article);
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
            Flash::error('applications not found');

            return redirect(route('applications.index'));
        }

        return view('applications.edit')->with('application', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicationRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('applications not found');

            return redirect(route('applications.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('applications 更新成功.');

        return redirect(route('applications.index'));
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
            Flash::error('applications not found');

            return redirect(route('applications.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('applications deleted successfully.');

        return redirect(route('applications.index'));
    }
}
