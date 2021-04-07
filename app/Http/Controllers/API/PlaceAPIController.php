<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlaceAPIRequest;
use App\Http\Requests\API\UpdatePlaceAPIRequest;
use App\Models\Place;
use App\Repositories\PlaceRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use App\Repositories\Category_placeRepository;
use App\Repositories\FacilityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlaceController
 * @package App\Http\Controllers\API
 */

class PlaceAPIController extends AppBaseController
{
    /** @var  PlaceRepository */
    private $placeRepository;

    public function __construct(PlaceRepository $placeRepo)
    {
        $this->placeRepository = $placeRepo;
    }

    public function operateHeart($id, Request $request) {
        if(!$request->has('add')) return $this->sendError('Invalid request for heart');
        $place = $this->placeRepository->find($id);
        if (empty($place)) {
            return $this->sendError('Place not found');
        }
        $input['heart'] = $request->input('add') ? $place->heart + 1 : $place->heart - 1;
        $place = $this->placeRepository->update($input, $id);

        return $this->sendResponse($place->heart, 'heart added!');
    }

    /**
     * Display a listing of the Place.
     * GET|HEAD /places
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Category_placeRepository $categoryPlaceRepo, FacilityRepository $facilityRepo)
    {
        /*
            range: age,fee_number
            match: organization,district
            array: areas,opening_hours,facilities
            boolean: book
        */
        $request->request->add(['status' => 'A']);
        $places = $this->placeRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','title','categories','photos','facilities','address','telephone'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        //$articles['image_path'] = url('uploads/place_images');

        $data = array();
        foreach($places as $p) {
            $i['photos'] = $p->getPhotos();
            $i['categories'] = $categoryPlaceRepo->find(explode(",", $p->categories), ['id','name']);
            $i['facilities'] = $facilityRepo->find(explode(",", $p->facilities), ['id','icon']);
            $i['id'] = $p->id;
            $i['title'] = $p->title;
            $i['address'] = $p->address;
            $i['telephone'] = $p->telephone;
            array_push($data, $i);
        }

        return $this->sendResponse($data, 'Places retrieved successfully');
    }

    /**
     * Store a newly created Place in storage.
     * POST /places
     *
     * @param CreatePlaceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlaceAPIRequest $request)
    {
        $input = $request->all();

        $place = $this->placeRepository->create($input);

        return $this->sendResponse($place->toArray(), 'Place saved successfully');
    }

    /**
     * Display the specified Place.
     * GET|HEAD /places/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, ArticleRepository $articleRepo, FacilityRepository $facilityRepo, TagRepository $tagRepo, Category_placeRepository $categoryPlaceRepo)
    {
        $place = $this->placeRepository->find($id, ['id','title','heart','address','book','content','email','fee','gps','opening','telephone','transport_long','transport_short','website','photos','tags_public','facilities','related_articles','related_places']);

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $article->short = $article->getShortContent();
        $article->content = $article->getContent();
        $place->slides = $place->getPhotos();
        $place->icons = $facilityRepo->find(explode(",", $place->facilities), ['id','name','icon']);
        $place->tags = $tagRepo->find(explode(",", $place->tags_public), ['id','name']);

        $place->articles = $articleRepo->find(explode(",", $place->related_articles), ['id','title','heart','photos','display']);

        $place->tmp_places = $this->placeRepository->find(explode(",", $place->related_places), ['id','title','categories','photos']);

        foreach($place->articles as $a) {
            $a->date = $a->display->format('Y-m-d');
            $a->photo = $a->getPhoto(0);
            unset($a->display);
            unset($a->photos);
        }

        $places = array();
        foreach($place->tmp_places as $p) {
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
        $place->image_path = url('uploads/place_images/').'/';
        $place->places = $places;

        unset($place->tmp_places);
        unset($place->photos);
        unset($place->facilities);
        unset($place->tags_public);
        unset($place->related_places);
        unset($place->related_articles);

        return $this->sendResponse($place->toArray(), 'Place retrieved successfully');
    }

    /**
     * Update the specified Place in storage.
     * PUT/PATCH /places/{id}
     *
     * @param int $id
     * @param UpdatePlaceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Place $place */
        $place = $this->placeRepository->find($id);

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $place = $this->placeRepository->update($input, $id);

        return $this->sendResponse($place->toArray(), 'Place updated successfully');
    }

    /**
     * Remove the specified Place from storage.
     * DELETE /places/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Place $place */
        $place = $this->placeRepository->find($id);

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $place->delete();

        return $this->sendResponse($id, 'Place deleted successfully');
    }
}
