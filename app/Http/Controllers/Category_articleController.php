<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategory_articleRequest;
use App\Http\Requests\UpdateCategory_articleRequest;
use App\Repositories\Category_articleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Category_articleController extends AppBaseController
{
    /** @var  Category_articleRepository */
    private $categoryArticleRepository;

    public function __construct(Category_articleRepository $categoryArticleRepo)
    {
        $this->categoryArticleRepository = $categoryArticleRepo;
    }

    /**
     * Display a listing of the Category_article.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categoryArticles = $this->categoryArticleRepository->paginate(10);

        return view('category_articles.index')
            ->with('categoryArticles', $categoryArticles);
    }

    /**
     * Show the form for creating a new Category_article.
     *
     * @return Response
     */
    public function create()
    {
        return view('category_articles.create');
    }

    /**
     * Store a newly created Category_article in storage.
     *
     * @param CreateCategory_articleRequest $request
     *
     * @return Response
     */
    public function store(CreateCategory_articleRequest $request)
    {
        //$input = $request->all();
        $categoryArticle = $this->categoryArticleRepository->create($request->all());

        Flash::success('Category Article saved successfully.');

        return redirect(route('categoryArticles.index'));
    }

    /**
     * Display the specified Category_article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            Flash::error('Category Article not found');

            return redirect(route('categoryArticles.index'));
        }

        return view('category_articles.show')->with('categoryArticle', $categoryArticle);
    }

    /**
     * Show the form for editing the specified Category_article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            Flash::error('Category Article not found');

            return redirect(route('categoryArticles.index'));
        }

        return view('category_articles.edit')->with('categoryArticle', $categoryArticle);
    }

    /**
     * Update the specified Category_article in storage.
     *
     * @param int $id
     * @param UpdateCategory_articleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategory_articleRequest $request)
    {
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            Flash::error('Category Article not found');

            return redirect(route('categoryArticles.index'));
        }

        $categoryArticle = $this->categoryArticleRepository->update($request->all(), $id);

        Flash::success('Category Article updated successfully.');

        return redirect(route('categoryArticles.index'));
    }

    /**
     * Remove the specified Category_article from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            Flash::error('Category Article not found');

            return redirect(route('categoryArticles.index'));
        }

        $this->categoryArticleRepository->delete($id);

        Flash::success('Category Article deleted successfully.');

        return redirect(route('categoryArticles.index'));
    }
}
