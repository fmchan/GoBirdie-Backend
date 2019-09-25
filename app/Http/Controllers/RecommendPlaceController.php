<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecommendPlaceRequest;
use App\Http\Requests\UpdateRecommendPlaceRequest;
use App\Repositories\RecommendPlaceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RecommendPlaceController extends AppBaseController
{
    /** @var  RecommendPlaceRepository */
    private $recommendPlaceRepository;

    public function __construct(RecommendPlaceRepository $recommendPlaceRepo)
    {
        $this->recommendPlaceRepository = $recommendPlaceRepo;
    }

    /**
     * Display a listing of the RecommendPlace.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $recommendPlaces = $this->recommendPlaceRepository->paginate(10);

        return view('recommend_places.index')
            ->with('recommendPlaces', $recommendPlaces);
    }

    /**
     * Show the form for creating a new RecommendPlace.
     *
     * @return Response
     */
    public function create()
    {
        return view('recommend_places.create');
    }

    /**
     * Store a newly created RecommendPlace in storage.
     *
     * @param CreateRecommendPlaceRequest $request
     *
     * @return Response
     */
    public function store(CreateRecommendPlaceRequest $request)
    {
        $input = $request->all();

        $recommendPlace = $this->recommendPlaceRepository->create($input);

        Flash::success('Recommend Place saved successfully.');

        return redirect(route('recommendPlaces.index'));
    }

    /**
     * Display the specified RecommendPlace.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            Flash::error('Recommend Place not found');

            return redirect(route('recommendPlaces.index'));
        }

        return view('recommend_places.show')->with('recommendPlace', $recommendPlace);
    }

    /**
     * Show the form for editing the specified RecommendPlace.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            Flash::error('Recommend Place not found');

            return redirect(route('recommendPlaces.index'));
        }

        return view('recommend_places.edit')->with('recommendPlace', $recommendPlace);
    }

    /**
     * Update the specified RecommendPlace in storage.
     *
     * @param int $id
     * @param UpdateRecommendPlaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecommendPlaceRequest $request)
    {
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            Flash::error('Recommend Place not found');

            return redirect(route('recommendPlaces.index'));
        }

        $recommendPlace = $this->recommendPlaceRepository->update($request->all(), $id);

        Flash::success('Recommend Place updated successfully.');

        return redirect(route('recommendPlaces.index'));
    }

    /**
     * Remove the specified RecommendPlace from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $recommendPlace = $this->recommendPlaceRepository->find($id);

        if (empty($recommendPlace)) {
            Flash::error('Recommend Place not found');

            return redirect(route('recommendPlaces.index'));
        }

        $this->recommendPlaceRepository->delete($id);

        Flash::success('Recommend Place deleted successfully.');

        return redirect(route('recommendPlaces.index'));
    }
}
