<?php

namespace App\Http\Controllers\API;

use App\Repositories\BannerRepository;
use App\Repositories\Category_placeRepository;
use App\Repositories\HighlightArticleRepository;
use App\Repositories\HighlightPlaceRepository;
use App\Repositories\FacilityRepository;

use App\Repositories\DistrictRepository;
use App\Repositories\HourRepository;
use App\Repositories\AreaRepository;
use App\Repositories\OrganizationRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Notification;
use ExponentPhpSDK\Expo;

use Response;
use Carbon\Carbon;

class HomeAPIController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannerRepository;
    private $categoryPlaceRepository;
    private $highlightArticleRepository;
    private $highlightPlaceRepository;
    private $facilityRepository;
    private $districtRepository;
    private $hourRepository;
    private $areaRepository;
    private $organizationRepository;

    public function __construct(
        BannerRepository $bannerRepo,
        Category_placeRepository $categoryPlaceRepo,
        HighlightArticleRepository $highlightArticleRepo,
        HighlightPlaceRepository $highlightPlaceRepo,
        FacilityRepository $facilityRepo,
        DistrictRepository $districtRepo,
        HourRepository $hourRepo,
        AreaRepository $areaRepo,
        OrganizationRepository $organizationRepo
    ) {
        $this->bannerRepository = $bannerRepo;
        $this->categoryPlaceRepository = $categoryPlaceRepo;
        $this->highlightArticleRepository = $highlightArticleRepo;
        $this->highlightPlaceRepository = $highlightPlaceRepo;
        $this->facilityRepository = $facilityRepo;
        $this->districtRepository = $districtRepo;
        $this->hourRepository = $hourRepo;
        $this->areaRepository = $areaRepo;
        $this->organizationRepo = $organizationRepo;
    }

    public function index() {

        $request = new Request();
        $request->request->add(['status' => 'A']);
        $facilities = $this->facilityRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','icon','name'],
            ['rank'=>'desc', 'id'=>'desc']
        );

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
        $request->request->add(['status' => 'A', 'limit' => 4]);
        $highlightArticles = $this->highlightArticleRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','article_id'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        $highlightArticlesArr = array();
        foreach($highlightArticles as $a) {
            $i['ref_id'] = $a->id;
            $i['id'] = $a->article_id;
            $i['title'] = $a->article->title;
            $i['heart'] = $a->article->heart;
            $i['photo'] = $a->article->getPhoto(0);
            $i['date'] = $a->article->display->format('Y-m-d');
            array_push($highlightArticlesArr, $i);
        }

        // highlightPlace
        $request = new Request();
        $request->request->add(['status' => 'A', 'limit' => 5]);
        $highlightPlaces = $this->highlightPlaceRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','place_id'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        $highlightPlacesArr = array();
        foreach($highlightPlaces as $a) {
            $p['ref_id'] = $a->id;
            $p['id'] = $a->place_id;
            $p['title'] = $a->place->title;
            $p['address'] = $a->place->address;
            $p['telephone'] = $a->place->telephone;
            $p['photos'] = $a->place->getPhotos();
            $p['categories'] = $this->categoryPlaceRepository->find(explode(",", $a->place->categories), ['id','name']);
            $p['facilities'] = $this->facilityRepository->find(explode(",", $a->place->facilities), ['id','icon']);
            array_push($highlightPlacesArr, $p);
        }

        return $this->sendResponse([
            'facilities'=>$facilities->toArray(), 
            'banners'=>$banners->toArray(), 
            'category_places'=>$categoryPlaces->toArray(), 
            'highlight_articles'=>$highlightArticlesArr, 
            'highlight_places'=>$highlightPlacesArr, 
            'paths'=>[
                'banners'=>url('uploads/banners').'/',
                'category_places'=>url('uploads/icons/').'/',
                'articles'=>url('uploads/article_images/').'/',
                'places'=>url('uploads/place_images/').'/',
                'facilities'=>url('uploads/facilities/').'/',
            ]
        ], 'Home retrieved successfully');
    }

    public function advanceSearchFilter() {
        $request = new Request();
        $request->request->add(['status' => 'A']);
        $areas = $this->areaRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','name'],
            ['rank'=>'desc', 'id'=>'desc']
        );

        $request = new Request();
        $request->request->add(['status' => 'A']);
        $districts = $this->districtRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','name'],
            ['rank'=>'desc', 'id'=>'desc']
        );

        $request = new Request();
        $request->request->add(['status' => 'A']);
        $hours = $this->hourRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','name'],
            ['rank'=>'desc', 'id'=>'desc']
        );

        $request = new Request();
        $request->request->add(['status' => 'A']);
        $organizations = $this->organizationRepo->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','name'],
            ['rank'=>'desc', 'id'=>'desc']
        );

        return $this->sendResponse([
            'areas'=>$areas->toArray(), 
            'districts'=>$districts->toArray(), 
            'hours'=>$hours->toArray(),
            'organizations'=>$organizations->toArray(),
        ], 'Advance search filters retrieved successfully');
    }

    public function subscribe(Request $request, Expo $expo) {
        $rules = [
            'token' => ['required'],
        ];
        $request->validate($rules);
        $channelName = (empty($request->get('channel')))? 'defualt': 'unuse';
        $token = $request->token;
        return $this->sendResponse($expo->subscribe($channelName, $token), 'Token subscribed!');
    }

    public function test(Expo $expo) {
        $channelName = 'group_4815';
        $recipient1 = 'ExponentPushToken[AjubmJPUKtBYWtx_8yzODi]';
        $details = ['body' => 'Hello World!', 'data'=> json_encode(array('someData' => 'goes here'))];
        //$expo->subscribe($channelName, $recipient1);
        $expo->notify($channelName, $details, true);
        //Expo::subscribe($channelName, $recipient1);
        //new MyFirstNotification();
        //Notification::send($recipient1, new MyFirstNotification());
        //Notification::send(new MyFirstNotification());
    }
}
