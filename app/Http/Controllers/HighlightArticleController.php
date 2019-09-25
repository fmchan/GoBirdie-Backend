<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHighlightArticleRequest;
use App\Http\Requests\UpdateHighlightArticleRequest;
use App\Repositories\HighlightArticleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HighlightArticleController extends AppBaseController
{
    /** @var  HighlightArticleRepository */
    private $highlightArticleRepository;

    public function __construct(HighlightArticleRepository $highlightArticleRepo)
    {
        $this->highlightArticleRepository = $highlightArticleRepo;
    }

    /**
     * Display a listing of the HighlightArticle.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $highlightArticles = $this->highlightArticleRepository->paginate(10);

        return view('highlight_articles.index')
            ->with('highlightArticles', $highlightArticles);
    }

    /**
     * Show the form for creating a new HighlightArticle.
     *
     * @return Response
     */
    public function create()
    {
        return view('highlight_articles.create');
    }

    /**
     * Store a newly created HighlightArticle in storage.
     *
     * @param CreateHighlightArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateHighlightArticleRequest $request)
    {
        $input = $request->all();

        $highlightArticle = $this->highlightArticleRepository->create($input);

        Flash::success('Highlight Article saved successfully.');

        return redirect(route('highlightArticles.index'));
    }

    /**
     * Display the specified HighlightArticle.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            Flash::error('Highlight Article not found');

            return redirect(route('highlightArticles.index'));
        }

        return view('highlight_articles.show')->with('highlightArticle', $highlightArticle);
    }

    /**
     * Show the form for editing the specified HighlightArticle.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            Flash::error('Highlight Article not found');

            return redirect(route('highlightArticles.index'));
        }

        return view('highlight_articles.edit')->with('highlightArticle', $highlightArticle);
    }

    /**
     * Update the specified HighlightArticle in storage.
     *
     * @param int $id
     * @param UpdateHighlightArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHighlightArticleRequest $request)
    {
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            Flash::error('Highlight Article not found');

            return redirect(route('highlightArticles.index'));
        }

        $highlightArticle = $this->highlightArticleRepository->update($request->all(), $id);

        Flash::success('Highlight Article updated successfully.');

        return redirect(route('highlightArticles.index'));
    }

    /**
     * Remove the specified HighlightArticle from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            Flash::error('Highlight Article not found');

            return redirect(route('highlightArticles.index'));
        }

        $this->highlightArticleRepository->delete($id);

        Flash::success('Highlight Article deleted successfully.');

        return redirect(route('highlightArticles.index'));
    }
}
