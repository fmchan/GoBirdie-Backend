<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRecommendPlaceAPIRequest;
use App\Http\Requests\API\UpdateRecommendPlaceAPIRequest;
use App\Models\RecommendPlace;
use App\Repositories\RecommendPlaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RecommendPlaceController
 * @package App\Http\Controllers\API
 */

class RecommendPlaceAPIController extends AppBaseController
{
    /** @var  RecommendPlaceRepository */
    private $recommendPlaceRepository;

    public function __construct(RecommendPlaceRepository $recommendPlaceRepo)
    {
        $this->recommendPlaceRepository = $recommendPlaceRepo;
    }

    /**
     * Display a listing of the RecommendPlace.
     * GET|HEAD /recommendPlaces
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->request->add(['status' => 'A']);
        $recommendPlaces = $this->recommendPlaceRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','place_id'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        $data = array();
        foreach($recommendPlaces as $a) {
            $i['id'] = $a->id;
            $i['place_id'] = $a->place_id;
            $i['title'] = $a->place->title;
            $i['categories'] = $a->place->categories;
            $i['photos'] = $a->place->photos;
            array_push($data, $i);
        }

        //return response(['data'=>$data, 'image_path'=>url('uploads/place_images')], 200);
        return $this->sendResponse($recommendPlaces->toArray(), 'Recommend Places retrieved successfully');
    }

    /**
     * Store a newly created RecommendPlace in storage.
     * POST /recommendPlaces
     *
     * @param CreateRecommendPlaceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRecommendPlaceAPIRequest $request)
    {
        $input = $request->all();

        $recommendPlace = $this->recommendPlaceRepository->create($input);

        return $this->sendResponse($recommendPlace->toArray(), 'Recommend Place saved successfully');
    }

    /**
     * Display the specified RecommendPlace.
     * GET|HEAD /recommendPlaces/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RecommendPlace $recommendPlace */
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            return $this->sendError('Recommend Place not found');
        }

        return $this->sendResponse($recommendPlace->toArray(), 'Recommend Place retrieved successfully');
    }

    /**
     * Update the specified RecommendPlace in storage.
     * PUT/PATCH /recommendPlaces/{id}
     *
     * @param int $id
     * @param UpdateRecommendPlaceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecommendPlaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var RecommendPlace $recommendPlace */
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            return $this->sendError('Recommend Place not found');
        }

        $recommendPlace = $this->recommendPlaceRepository->update($input, $id);

        return $this->sendResponse($recommendPlace->toArray(), 'RecommendPlace updated successfully');
    }

    /**
     * Remove the specified RecommendPlace from storage.
     * DELETE /recommendPlaces/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RecommendPlace $recommendPlace */
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            return $this->sendError('Recommend Place not found');
        }

        $recommendPlace->delete();

        return $this->sendResponse($id, 'Recommend Place deleted successfully');
    }
}
