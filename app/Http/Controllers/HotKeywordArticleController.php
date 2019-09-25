<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHotKeywordArticleRequest;
use App\Http\Requests\UpdateHotKeywordArticleRequest;
use App\Repositories\HotKeywordArticleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HotKeywordArticleController extends AppBaseController
{
    /** @var  HotKeywordArticleRepository */
    private $hotKeywordArticleRepository;

    public function __construct(HotKeywordArticleRepository $hotKeywordArticleRepo)
    {
        $this->hotKeywordArticleRepository = $hotKeywordArticleRepo;
    }

    /**
     * Display a listing of the HotKeywordArticle.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $hotKeywordArticles = $this->hotKeywordArticleRepository->paginate(10);

        return view('hot_keyword_articles.index')
            ->with('hotKeywordArticles', $hotKeywordArticles);
    }

    /**
     * Show the form for creating a new HotKeywordArticle.
     *
     * @return Response
     */
    public function create()
    {
        return view('hot_keyword_articles.create');
    }

    /**
     * Store a newly created HotKeywordArticle in storage.
     *
     * @param CreateHotKeywordArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateHotKeywordArticleRequest $request)
    {
        $input = $request->all();

        $hotKeywordArticle = $this->hotKeywordArticleRepository->create($input);

        Flash::success('Hot Keyword Article saved successfully.');

        return redirect(route('hotKeywordArticles.index'));
    }

    /**
     * Display the specified HotKeywordArticle.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            Flash::error('Hot Keyword Article not found');

            return redirect(route('hotKeywordArticles.index'));
        }

        return view('hot_keyword_articles.show')->with('hotKeywordArticle', $hotKeywordArticle);
    }

    /**
     * Show the form for editing the specified HotKeywordArticle.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            Flash::error('Hot Keyword Article not found');

            return redirect(route('hotKeywordArticles.index'));
        }

        return view('hot_keyword_articles.edit')->with('hotKeywordArticle', $hotKeywordArticle);
    }

    /**
     * Update the specified HotKeywordArticle in storage.
     *
     * @param int $id
     * @param UpdateHotKeywordArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHotKeywordArticleRequest $request)
    {
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            Flash::error('Hot Keyword Article not found');

            return redirect(route('hotKeywordArticles.index'));
        }

        $hotKeywordArticle = $this->hotKeywordArticleRepository->update($request->all(), $id);

        Flash::success('Hot Keyword Article updated successfully.');

        return redirect(route('hotKeywordArticles.index'));
    }

    /**
     * Remove the specified HotKeywordArticle from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            Flash::error('Hot Keyword Article not found');

            return redirect(route('hotKeywordArticles.index'));
        }

        $this->hotKeywordArticleRepository->delete($id);

        Flash::success('Hot Keyword Article deleted successfully.');

        return redirect(route('hotKeywordArticles.index'));
    }
}
