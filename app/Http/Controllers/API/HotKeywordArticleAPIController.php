<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHotKeywordArticleAPIRequest;
use App\Http\Requests\API\UpdateHotKeywordArticleAPIRequest;
use App\Models\HotKeywordArticle;
use App\Repositories\HotKeywordArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Carbon\Carbon;

/**
 * Class HotKeywordArticleController
 * @package App\Http\Controllers\API
 */

class HotKeywordArticleAPIController extends AppBaseController
{
    /** @var  HotKeywordArticleRepository */
    private $hotKeywordArticleRepository;

    public function __construct(HotKeywordArticleRepository $hotKeywordArticleRepo)
    {
        $this->hotKeywordArticleRepository = $hotKeywordArticleRepo;
    }

    /**
     * Display a listing of the HotKeywordArticle.
     * GET|HEAD /hotKeywordArticles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->request->add(['status' => 'A', 'dateInRange' => Carbon::now()]);
        $hotKeywordArticles = $this->hotKeywordArticleRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','keyword'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        return $this->sendResponse($hotKeywordArticles->toArray(), 'Hot Keyword Articles retrieved successfully');
    }

    /**
     * Store a newly created HotKeywordArticle in storage.
     * POST /hotKeywordArticles
     *
     * @param CreateHotKeywordArticleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHotKeywordArticleAPIRequest $request)
    {
        $input = $request->all();

        $hotKeywordArticle = $this->hotKeywordArticleRepository->create($input);

        return $this->sendResponse($hotKeywordArticle->toArray(), 'Hot Keyword Article saved successfully');
    }

    /**
     * Display the specified HotKeywordArticle.
     * GET|HEAD /hotKeywordArticles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HotKeywordArticle $hotKeywordArticle */
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            return $this->sendError('Hot Keyword Article not found');
        }

        return $this->sendResponse($hotKeywordArticle->toArray(), 'Hot Keyword Article retrieved successfully');
    }

    /**
     * Update the specified HotKeywordArticle in storage.
     * PUT/PATCH /hotKeywordArticles/{id}
     *
     * @param int $id
     * @param UpdateHotKeywordArticleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHotKeywordArticleAPIRequest $request)
    {
        $input = $request->all();

        /** @var HotKeywordArticle $hotKeywordArticle */
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            return $this->sendError('Hot Keyword Article not found');
        }

        $hotKeywordArticle = $this->hotKeywordArticleRepository->update($input, $id);

        return $this->sendResponse($hotKeywordArticle->toArray(), 'HotKeywordArticle updated successfully');
    }

    /**
     * Remove the specified HotKeywordArticle from storage.
     * DELETE /hotKeywordArticles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HotKeywordArticle $hotKeywordArticle */
        $hotKeywordArticle = $this->hotKeywordArticleRepository->find($id);

        if (empty($hotKeywordArticle)) {
            return $this->sendError('Hot Keyword Article not found');
        }

        $hotKeywordArticle->delete();

        return $this->sendResponse($id, 'Hot Keyword Article deleted successfully');
    }
}
