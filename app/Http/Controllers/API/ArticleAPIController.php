<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArticleAPIRequest;
use App\Http\Requests\API\UpdateArticleAPIRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\FacilityRepository;
use App\Repositories\TagRepository;
use App\Repositories\Category_placeRepository;
use App\Repositories\PlaceRepository;
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
        foreach($articles as $a) {
            $a->date = $a->display->format('Y-m-d');
            $a->photo = $a->getPhoto(0);
            unset($a->display);
            unset($a->photos);
        }
        //return response(['data'=>$articles->toArray(), 'image_path'=>url('uploads/article_images')], 200)->header('Content-Type', 'text/plain; charset=utf-8');
        return $this->sendResponse($articles->toArray(), 'Articles retrieved successfully');
    }

    public function operateHeart($id, Request $request) {
        if(!$request->has('add')) return $this->sendError('Invalid request for heart');
        $article = $this->articleRepository->find($id);
        if (empty($article)) {
            return $this->sendError('Article not found');
        }
        $input['heart'] = $request->input('add') ? $article->heart + 1 : $article->heart - 1;
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
    public function show($id, PlaceRepository $placeRepo, FacilityRepository $facilityRepo, TagRepository $tagRepo, Category_placeRepository $categoryPlaceRepo)
    {
        /** @var Article $article */
        $article = $this->articleRepository->find($id, ['id','title','heart','display','address','book','content','email','fee','gps','opening','telephone','transport_long','transport_short','website','photos','tags_public','facilities','related_articles','related_places']);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        $article->short = $article->getShortContent();
        $article->content = $article->getContent();
        $article->date = $article->display->format('Y-m-d');
        $article->slides = $article->getPhotos();
        $article->icons = $facilityRepo->find(explode(",", $article->facilities), ['id','name','icon']);
        $article->tags = $tagRepo->find(explode(",", $article->tags_public), ['id','name']);

        $article->articles = $this->articleRepository->find(explode(",", $article->related_articles), ['id','title','heart','photos','display']);

        $article->tmp_places = $placeRepo->find(explode(",", $article->related_places), ['id','title','categories','photos']);

        foreach($article->articles as $a) {
            $a->date = $a->display->format('Y-m-d');
            $a->photo = $a->getPhoto(0);
            unset($a->display);
            unset($a->photos);
        }

        $places = array();
        foreach($article->tmp_places as $p) {
            //$i['photos'] = $p->getPhotos();
            $i['photo'] = $p->getPhoto(0);
            $i['categories'] = $categoryPlaceRepo->find(explode(",", $p->categories), ['id','name']);
            //$i['facilities'] = $facilityRepo->find(explode(",", $p->facilities), ['id','icon']);
            $i['id'] = $p->id;
            $i['title'] = $p->title;
            //$i['address'] = $p->address;
            //$i['telephone'] = $p->telephone;
            array_push($places, $i);
        }
        $article->image_path = url('uploads/article_images/').'/';
        $article->facility_path = url('uploads/facilities/').'/';
        $article->places = $places;

        unset($article->display);
        unset($article->tmp_places);
        unset($article->photos);
        unset($article->facilities);
        unset($article->tags_public);
        unset($article->related_places);
        unset($article->related_articles);

        /*return response()->json(['data'=>$article->toArray(), 'image_path'=>url('uploads/article_images')], 200,
        ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);*/
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
