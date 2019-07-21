<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Category_article;

class ArticleController extends GenericController
{
    public function __construct(ArticleRepository $articleRepo)
    {
        $this->tableName = 'articles';
        $this->image_dir = 'article_images';
        $this->repo = $articleRepo;
    }

    protected function pluckData() {
        $data = parent::pluckData();
        $data['categories'] = Category_article::where('status','A')->pluck('name','id')->all();
        return $data;
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
        $article = $this->repo->create($this->requestToInput($request));

        Flash::success('Article saved successfully.');

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->repo->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->repo->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $data = $this->pluckData();
        $data['article'] = $article;

        return view('articles.edit')->with($data);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->repo->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }
        $article = $this->repo->update($this->requestToInput($request, $article), $id);

        Flash::success('Article updated successfully.');

        return redirect(route('articles.index'));
    }
}