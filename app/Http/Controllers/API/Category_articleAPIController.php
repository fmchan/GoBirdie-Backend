<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategory_articleAPIRequest;
use App\Http\Requests\API\UpdateCategory_articleAPIRequest;
use App\Models\Category_article;
use App\Repositories\Category_articleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Category_articleController
 * @package App\Http\Controllers\API
 */

class Category_articleAPIController extends AppBaseController
{
    /** @var  Category_articleRepository */
    private $categoryArticleRepository;

    public function __construct(Category_articleRepository $categoryArticleRepo)
    {
        $this->categoryArticleRepository = $categoryArticleRepo;
    }

    /**
     * Display a listing of the Category_article.
     * GET|HEAD /categoryArticles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rank = $request->input('rank'); // h,p
        $rank_field = ($rank != null && $rank == "h")? "rank_home": "rank_place";
        $request->request->add(['status' => 'A']);
        $categoryArticles = $this->categoryArticleRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            array('id', 'name', 'icon'),
            [$rank_field=>'desc', 'id'=>'desc']
        );
        $categoryArticles['image_path'] = url('uploads/icons');

        return $this->sendResponse($categoryArticles->toArray(), 'Category Articles retrieved successfully');
    }

    /**
     * Store a newly created Category_article in storage.
     * POST /categoryArticles
     *
     * @param CreateCategory_articleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategory_articleAPIRequest $request)
    {
        $input = $request->all();

        $categoryArticle = $this->categoryArticleRepository->create($input);

        return $this->sendResponse($categoryArticle->toArray(), 'Category Article saved successfully');
    }

    /**
     * Display the specified Category_article.
     * GET|HEAD /categoryArticles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Category_article $categoryArticle */
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            return $this->sendError('Category Article not found');
        }

        return $this->sendResponse($categoryArticle->toArray(), 'Category Article retrieved successfully');
    }

    /**
     * Update the specified Category_article in storage.
     * PUT/PATCH /categoryArticles/{id}
     *
     * @param int $id
     * @param UpdateCategory_articleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategory_articleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Category_article $categoryArticle */
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            return $this->sendError('Category Article not found');
        }

        $categoryArticle = $this->categoryArticleRepository->update($input, $id);

        return $this->sendResponse($categoryArticle->toArray(), 'Category_article updated successfully');
    }

    /**
     * Remove the specified Category_article from storage.
     * DELETE /categoryArticles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Category_article $categoryArticle */
        $categoryArticle = $this->categoryArticleRepository->find($id);

        if (empty($categoryArticle)) {
            return $this->sendError('Category Article not found');
        }

        $categoryArticle->delete();

        return $this->sendResponse($id, 'Category Article deleted successfully');
    }
}
