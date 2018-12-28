<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCertRequest;
use App\Http\Requests\UpdateCertRequest;
use App\Repositories\CertRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CertController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(CertRepository $articleRepo)
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

        return view('certs.index')
            ->with('certs', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        return view('certs.create');
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateCertRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('certs 保存成功');

        return redirect(route('syscerts.index'));
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
            Flash::error('certs not found');

            return redirect(route('syscerts.index'));
        }

        return view('certs.show')->with('cert', $article);
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
            Flash::error('certs not found');

            return redirect(route('certs.index'));
        }

        return view('certs.edit')->with('cert', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCertRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('certs not found');

            return redirect(route('syscerts.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('certs 更新成功.');

        return redirect(route('syscerts.index'));
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
            Flash::error('certs not found');

            return redirect(route('syscerts.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('certs deleted successfully.');

        return redirect(route('syscerts.index'));
    }
}
