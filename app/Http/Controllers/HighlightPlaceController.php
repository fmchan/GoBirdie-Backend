<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHighlightPlaceRequest;
use App\Http\Requests\UpdateHighlightPlaceRequest;
use App\Repositories\HighlightPlaceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HighlightPlaceController extends AppBaseController
{
    /** @var  HighlightPlaceRepository */
    private $highlightPlaceRepository;

    public function __construct(HighlightPlaceRepository $highlightPlaceRepo)
    {
        $this->highlightPlaceRepository = $highlightPlaceRepo;
    }

    /**
     * Display a listing of the HighlightPlace.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $highlightPlaces = $this->highlightPlaceRepository->paginate(10);

        return view('highlight_places.index')
            ->with('highlightPlaces', $highlightPlaces);
    }

    /**
     * Show the form for creating a new HighlightPlace.
     *
     * @return Response
     */
    public function create()
    {
        return view('highlight_places.create');
    }

    /**
     * Store a newly created HighlightPlace in storage.
     *
     * @param CreateHighlightPlaceRequest $request
     *
     * @return Response
     */
    public function store(CreateHighlightPlaceRequest $request)
    {
        $input = $request->all();

        $highlightPlace = $this->highlightPlaceRepository->create($input);

        Flash::success('Highlight Place saved successfully.');

        return redirect(route('highlightPlaces.index'));
    }

    /**
     * Display the specified HighlightPlace.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            Flash::error('Highlight Place not found');

            return redirect(route('highlightPlaces.index'));
        }

        return view('highlight_places.show')->with('highlightPlace', $highlightPlace);
    }

    /**
     * Show the form for editing the specified HighlightPlace.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            Flash::error('Highlight Place not found');

            return redirect(route('highlightPlaces.index'));
        }

        return view('highlight_places.edit')->with('highlightPlace', $highlightPlace);
    }

    /**
     * Update the specified HighlightPlace in storage.
     *
     * @param int $id
     * @param UpdateHighlightPlaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHighlightPlaceRequest $request)
    {
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            Flash::error('Highlight Place not found');

            return redirect(route('highlightPlaces.index'));
        }

        $highlightPlace = $this->highlightPlaceRepository->update($request->all(), $id);

        Flash::success('Highlight Place updated successfully.');

        return redirect(route('highlightPlaces.index'));
    }

    /**
     * Remove the specified HighlightPlace from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $highlightPlace = $this->highlightPlaceRepository->find($id);

        if (empty($highlightPlace)) {
            Flash::error('Highlight Place not found');

            return redirect(route('highlightPlaces.index'));
        }

        $this->highlightPlaceRepository->delete($id);

        Flash::success('Highlight Place deleted successfully.');

        return redirect(route('highlightPlaces.index'));
    }
}
