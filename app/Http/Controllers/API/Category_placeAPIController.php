<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategory_placeAPIRequest;
use App\Http\Requests\API\UpdateCategory_placeAPIRequest;
use App\Models\Category_place;
use App\Repositories\Category_placeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Category_placeController
 * @package App\Http\Controllers\API
 */

class Category_placeAPIController extends AppBaseController
{
    /** @var  Category_placeRepository */
    private $categoryPlaceRepository;

    public function __construct(Category_placeRepository $categoryPlaceRepo)
    {
        $this->categoryPlaceRepository = $categoryPlaceRepo;
    }

    /**
     * Display a listing of the Category_place.
     * GET|HEAD /categoryPlaces
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categoryPlaces = $this->categoryPlaceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categoryPlaces->toArray(), 'Category Places retrieved successfully');
    }

    /**
     * Store a newly created Category_place in storage.
     * POST /categoryPlaces
     *
     * @param CreateCategory_placeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategory_placeAPIRequest $request)
    {
        $input = $request->all();

        $categoryPlace = $this->categoryPlaceRepository->create($input);

        return $this->sendResponse($categoryPlace->toArray(), 'Category Place saved successfully');
    }

    /**
     * Display the specified Category_place.
     * GET|HEAD /categoryPlaces/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Category_place $categoryPlace */
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            return $this->sendError('Category Place not found');
        }

        return $this->sendResponse($categoryPlace->toArray(), 'Category Place retrieved successfully');
    }

    /**
     * Update the specified Category_place in storage.
     * PUT/PATCH /categoryPlaces/{id}
     *
     * @param int $id
     * @param UpdateCategory_placeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategory_placeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Category_place $categoryPlace */
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            return $this->sendError('Category Place not found');
        }

        $categoryPlace = $this->categoryPlaceRepository->update($input, $id);

        return $this->sendResponse($categoryPlace->toArray(), 'Category_place updated successfully');
    }

    /**
     * Remove the specified Category_place from storage.
     * DELETE /categoryPlaces/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Category_place $categoryPlace */
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            return $this->sendError('Category Place not found');
        }

        $categoryPlace->delete();

        return $this->sendResponse($id, 'Category Place deleted successfully');
    }
}