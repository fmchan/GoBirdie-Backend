<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHighlightPlaceAPIRequest;
use App\Http\Requests\API\UpdateHighlightPlaceAPIRequest;
use App\Models\HighlightPlace;
use App\Repositories\HighlightPlaceRepository;
use App\Repositories\Category_placeRepository;
use App\Repositories\FacilityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HighlightPlaceController
 * @package App\Http\Controllers\API
 */

class HighlightPlaceAPIController extends AppBaseController
{
    /** @var  HighlightPlaceRepository */
    private $highlightPlaceRepository;

    public function __construct(HighlightPlaceRepository $highlightPlaceRepo)
    {
        $this->highlightPlaceRepository = $highlightPlaceRepo;
    }

    /**
     * Display a listing of the HighlightPlace.
     * GET|HEAD /highlightPlaces
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Category_placeRepository $categoryPlaceRepo, FacilityRepository $facilityRepo)
    {
        $request->request->add(['status' => 'A']);
        $highlightPlaces = $this->highlightPlaceRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','place_id'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        $data = array();
        foreach($highlightPlaces as $p) {
            $i['photos'] = $p->getPhotos();
            $i['categories'] = $categoryPlaceRepo->find(explode(",", $p->categories), ['id','name']);
            $i['facilities'] = $facilityRepo->find(explode(",", $p->facilities), ['id','icon']);
            $i['ref_id'] = $p->id;
            $i['id'] = $p->place_id;
            $i['title'] = $p->title;
            $i['address'] = $p->address;
            $i['telephone'] = $p->telephone;
            array_push($data, $i);
        }

        //return response(['data'=>$data, 'image_path'=>url('uploads/place_images')], 200);
        return $this->sendResponse($data, 'Highlight Places retrieved successfully');
    }

    /**
     * Store a newly created HighlightPlace in storage.
     * POST /highlightPlaces
     *
     * @param CreateHighlightPlaceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHighlightPlaceAPIRequest $request)
    {
        $input = $request->all();

        $highlightPlace = $this->highlightPlaceRepository->create($input);

        return $this->sendResponse($highlightPlace->toArray(), 'Highlight Place saved successfully');
    }

    /**
     * Display the specified HighlightPlace.
     * GET|HEAD /highlightPlaces/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HighlightPlace $highlightPlace */
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            return $this->sendError('Highlight Place not found');
        }

        return $this->sendResponse($highlightPlace->toArray(), 'Highlight Place retrieved successfully');
    }

    /**
     * Update the specified HighlightPlace in storage.
     * PUT/PATCH /highlightPlaces/{id}
     *
     * @param int $id
     * @param UpdateHighlightPlaceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHighlightPlaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var HighlightPlace $highlightPlace */
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            return $this->sendError('Highlight Place not found');
        }

        $highlightPlace = $this->highlightPlaceRepository->update($input, $id);

        return $this->sendResponse($highlightPlace->toArray(), 'HighlightPlace updated successfully');
    }

    /**
     * Remove the specified HighlightPlace from storage.
     * DELETE /highlightPlaces/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HighlightPlace $highlightPlace */
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            return $this->sendError('Highlight Place not found');
        }

        $highlightPlace->delete();

        return $this->sendResponse($id, 'Highlight Place deleted successfully');
    }
}
