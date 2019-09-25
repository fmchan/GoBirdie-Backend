<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHighlightArticleAPIRequest;
use App\Http\Requests\API\UpdateHighlightArticleAPIRequest;
use App\Models\HighlightArticle;
use App\Repositories\HighlightArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HighlightArticleController
 * @package App\Http\Controllers\API
 */

class HighlightArticleAPIController extends AppBaseController
{
    /** @var  HighlightArticleRepository */
    private $highlightArticleRepository;

    public function __construct(HighlightArticleRepository $highlightArticleRepo)
    {
        $this->highlightArticleRepository = $highlightArticleRepo;
    }

    /**
     * Display a listing of the HighlightArticle.
     * GET|HEAD /highlightArticles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $highlightArticles = $this->highlightArticleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($highlightArticles->toArray(), 'Highlight Articles retrieved successfully');
    }

    /**
     * Store a newly created HighlightArticle in storage.
     * POST /highlightArticles
     *
     * @param CreateHighlightArticleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHighlightArticleAPIRequest $request)
    {
        $input = $request->all();

        $highlightArticle = $this->highlightArticleRepository->create($input);

        return $this->sendResponse($highlightArticle->toArray(), 'Highlight Article saved successfully');
    }

    /**
     * Display the specified HighlightArticle.
     * GET|HEAD /highlightArticles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HighlightArticle $highlightArticle */
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            return $this->sendError('Highlight Article not found');
        }

        return $this->sendResponse($highlightArticle->toArray(), 'Highlight Article retrieved successfully');
    }

    /**
     * Update the specified HighlightArticle in storage.
     * PUT/PATCH /highlightArticles/{id}
     *
     * @param int $id
     * @param UpdateHighlightArticleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHighlightArticleAPIRequest $request)
    {
        $input = $request->all();

        /** @var HighlightArticle $highlightArticle */
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            return $this->sendError('Highlight Article not found');
        }

        $highlightArticle = $this->highlightArticleRepository->update($input, $id);

        return $this->sendResponse($highlightArticle->toArray(), 'HighlightArticle updated successfully');
    }

    /**
     * Remove the specified HighlightArticle from storage.
     * DELETE /highlightArticles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HighlightArticle $highlightArticle */
        $highlightArticle = $this->highlightArticleRepository->find($id);

        if (empty($highlightArticle)) {
            return $this->sendError('Highlight Article not found');
        }

        $highlightArticle->delete();

        return $this->sendResponse($id, 'Highlight Article deleted successfully');
    }
}
