<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHotKeywordPlaceAPIRequest;
use App\Http\Requests\API\UpdateHotKeywordPlaceAPIRequest;
use App\Models\HotKeywordPlace;
use App\Repositories\HotKeywordPlaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HotKeywordPlaceController
 * @package App\Http\Controllers\API
 */

class HotKeywordPlaceAPIController extends AppBaseController
{
    /** @var  HotKeywordPlaceRepository */
    private $hotKeywordPlaceRepository;

    public function __construct(HotKeywordPlaceRepository $hotKeywordPlaceRepo)
    {
        $this->hotKeywordPlaceRepository = $hotKeywordPlaceRepo;
    }

    /**
     * Display a listing of the HotKeywordPlace.
     * GET|HEAD /hotKeywordPlaces
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->request->add(['status' => 'A']);
        $hotKeywordPlaces = $this->hotKeywordPlaceRepository->all2(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            ['id','keyword'],
            ['rank'=>'desc', 'id'=>'desc']
        );
        return $this->sendResponse($hotKeywordPlaces->toArray(), 'Hot Keyword Places retrieved successfully');
    }

    /**
     * Store a newly created HotKeywordPlace in storage.
     * POST /hotKeywordPlaces
     *
     * @param CreateHotKeywordPlaceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHotKeywordPlaceAPIRequest $request)
    {
        $input = $request->all();

        $hotKeywordPlace = $this->hotKeywordPlaceRepository->create($input);

        return $this->sendResponse($hotKeywordPlace->toArray(), 'Hot Keyword Place saved successfully');
    }

    /**
     * Display the specified HotKeywordPlace.
     * GET|HEAD /hotKeywordPlaces/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HotKeywordPlace $hotKeywordPlace */
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            return $this->sendError('Hot Keyword Place not found');
        }

        return $this->sendResponse($hotKeywordPlace->toArray(), 'Hot Keyword Place retrieved successfully');
    }

    /**
     * Update the specified HotKeywordPlace in storage.
     * PUT/PATCH /hotKeywordPlaces/{id}
     *
     * @param int $id
     * @param UpdateHotKeywordPlaceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHotKeywordPlaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var HotKeywordPlace $hotKeywordPlace */
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            return $this->sendError('Hot Keyword Place not found');
        }

        $hotKeywordPlace = $this->hotKeywordPlaceRepository->update($input, $id);

        return $this->sendResponse($hotKeywordPlace->toArray(), 'HotKeywordPlace updated successfully');
    }

    /**
     * Remove the specified HotKeywordPlace from storage.
     * DELETE /hotKeywordPlaces/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HotKeywordPlace $hotKeywordPlace */
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            return $this->sendError('Hot Keyword Place not found');
        }

        $hotKeywordPlace->delete();

        return $this->sendResponse($id, 'Hot Keyword Place deleted successfully');
    }
}
