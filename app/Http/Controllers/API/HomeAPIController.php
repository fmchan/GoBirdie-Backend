<?php

namespace App\Http\Controllers\API;

use App\Repositories\BannerRepository;
use App\Repositories\Category_placeRepository;
use App\Repositories\HighlightArticleRepository;
use App\Repositories\HighlightPlaceRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Response;
use Carbon\Carbon;

class HomeAPIController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannerRepository;
    private $categoryPlaceRepository;
    private $highlightArticleRepository;
    private $highlightPlaceRepository;

    public function __construct(
        BannerRepository $bannerRepo,
        Category_placeRepository $categoryPlaceRepo,
        HighlightArticleRepository $highlightArticleRepo,
        HighlightPlaceRepository $highlightPlaceRepo
    ) {
        $this->bannerRepository = $bannerRepo;
        $this->categoryPlaceRepository = $categoryPlaceRepo;
        $this->highlightArticleRepository = $highlightArticleRepo;
        $this->highlightPlaceRepository = $highlightPlaceRepo;
    }

    public function index() {
        // banner
        $request = new Request();
        $request->request->add(['status' => 'A', 'dateInRange' => Carbon::now()]);
        $banners = $this->bannerRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','title','photo','type','link'],
            ['rank'=>'desc', 'id'=>'desc']
        );

        // categoryPlace
        $request = new Request();
        $request->request->add(['status' => 'A']);
        $categoryPlaces = $this->categoryPlaceRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            array('id', 'name', 'icon'),
            ['rank_home'=>'desc', 'id'=>'desc']
        );

        // highlightArticle
        $request = new Request();
        $request->request->add(['status' => 'A']);
        $highlightArticles = $this->highlightArticleRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','article_id'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        $highlightArticlesArr = array();
        foreach($highlightArticles as $a) {
            $i['id'] = $a->id;
            $i['article_id'] = $a->article_id;
            $i['title'] = $a->article->title;
            $i['heart'] = $a->article->heart;
            $i['photo'] = $a->article->getPhoto(0);
            $i['date'] = $a->article->display->format('Y-m-d');
            array_push($highlightArticlesArr, $i);
        }

        // highlightPlace
        $request = new Request();
        $request->request->add(['status' => 'A']);
        $highlightPlaces = $this->highlightPlaceRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','place_id'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        $highlightPlacesArr = array();
        foreach($highlightPlaces as $a) {
            $i['id'] = $a->id;
            $i['place_id'] = $a->place_id;
            $i['title'] = $a->place->title;
            $i['categories'] = $a->place->categories;
            $i['photos'] = $a->place->photos;
            $i['facilities'] = $a->place->facilities;
            $i['address'] = $a->place->address;
            $i['telephone'] = $a->place->telephone;
            array_push($highlightPlacesArr, $i);
        }

        return $this->sendResponse([
            'banners'=>$banners->toArray(), 
            'category_places'=>$categoryPlaces->toArray(), 
            'highlight_articles'=>$highlightArticlesArr, 
            'highlight_places'=>$highlightPlacesArr, 
            'paths'=>[
                'banners'=>url('uploads/banners'),
                'category_places'=>url('uploads/icons'),
                'highlight_articles'=>url('uploads/article_images'),
                'highlight_places'=>url('uploads/place_images'),
            ]
        ], 'Home retrieved successfully');
    }
}
