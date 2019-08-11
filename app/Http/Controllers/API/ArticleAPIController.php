<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArticleAPIRequest;
use App\Http\Requests\API\UpdateArticleAPIRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ArticleController
 * @package App\Http\Controllers\API
 */

class ArticleAPIController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the Article.
     * GET|HEAD /articles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->request->add(['status' => 'A']);
        $articles = $this->articleRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','title','heart','photos','display'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        return response(['data'=>$articles->toArray(), 'image_path'=>url('uploads/article_images')], 200);
        //return $this->sendResponse($articles->toArray(), 'Articles retrieved successfully');
    }

    public function addHeart($id, Request $request) {
        $article = $this->articleRepository->find($id);
        if (empty($article)) {
            return $this->sendError('Article not found');
        }
        $input['heart'] = $article->heart + 1;
        $article = $this->articleRepository->update($input, $id);

        return $this->sendResponse($article->heart, 'heart added!');
    }

    /**
     * Store a newly created Article in storage.
     * POST /articles
     *
     * @param CreateArticleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleAPIRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        return $this->sendResponse($article->toArray(), 'Article saved successfully');
    }

    /**
     * Display the specified Article.
     * GET|HEAD /articles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Article $article */
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        return $this->sendResponse($article->toArray(), 'Article retrieved successfully');
    }

    /**
     * Update the specified Article in storage.
     * PUT/PATCH /articles/{id}
     *
     * @param int $id
     * @param UpdateArticleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Article $article */
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        $article = $this->articleRepository->update($input, $id);

        return $this->sendResponse($article->toArray(), 'Article updated successfully');
    }

    /**
     * Remove the specified Article from storage.
     * DELETE /articles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Article $article */
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        $article->delete();

        return $this->sendResponse($id, 'Article deleted successfully');
    }
}
