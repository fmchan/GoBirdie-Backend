<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHotKeywordPlaceRequest;
use App\Http\Requests\UpdateHotKeywordPlaceRequest;
use App\Repositories\HotKeywordPlaceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HotKeywordPlaceController extends AppBaseController
{
    /** @var  HotKeywordPlaceRepository */
    private $hotKeywordPlaceRepository;

    public function __construct(HotKeywordPlaceRepository $hotKeywordPlaceRepo)
    {
        $this->hotKeywordPlaceRepository = $hotKeywordPlaceRepo;
    }

    /**
     * Display a listing of the HotKeywordPlace.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $hotKeywordPlaces = $this->hotKeywordPlaceRepository->paginate(10);

        return view('hot_keyword_places.index')
            ->with('hotKeywordPlaces', $hotKeywordPlaces);
    }

    /**
     * Show the form for creating a new HotKeywordPlace.
     *
     * @return Response
     */
    public function create()
    {
        return view('hot_keyword_places.create');
    }

    /**
     * Store a newly created HotKeywordPlace in storage.
     *
     * @param CreateHotKeywordPlaceRequest $request
     *
     * @return Response
     */
    public function store(CreateHotKeywordPlaceRequest $request)
    {
        $input = $request->all();

        $hotKeywordPlace = $this->hotKeywordPlaceRepository->create($input);

        Flash::success('Hot Keyword Place saved successfully.');

        return redirect(route('hotKeywordPlaces.index'));
    }

    /**
     * Display the specified HotKeywordPlace.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            Flash::error('Hot Keyword Place not found');

            return redirect(route('hotKeywordPlaces.index'));
        }

        return view('hot_keyword_places.show')->with('hotKeywordPlace', $hotKeywordPlace);
    }

    /**
     * Show the form for editing the specified HotKeywordPlace.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            Flash::error('Hot Keyword Place not found');

            return redirect(route('hotKeywordPlaces.index'));
        }

        return view('hot_keyword_places.edit')->with('hotKeywordPlace', $hotKeywordPlace);
    }

    /**
     * Update the specified HotKeywordPlace in storage.
     *
     * @param int $id
     * @param UpdateHotKeywordPlaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHotKeywordPlaceRequest $request)
    {
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            Flash::error('Hot Keyword Place not found');

            return redirect(route('hotKeywordPlaces.index'));
        }

        $hotKeywordPlace = $this->hotKeywordPlaceRepository->update($request->all(), $id);

        Flash::success('Hot Keyword Place updated successfully.');

        return redirect(route('hotKeywordPlaces.index'));
    }

    /**
     * Remove the specified HotKeywordPlace from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hotKeywordPlace = $this->hotKeywordPlaceRepository->find($id);

        if (empty($hotKeywordPlace)) {
            Flash::error('Hot Keyword Place not found');

            return redirect(route('hotKeywordPlaces.index'));
        }

        $this->hotKeywordPlaceRepository->delete($id);

        Flash::success('Hot Keyword Place deleted successfully.');

        return redirect(route('hotKeywordPlaces.index'));
    }
}
