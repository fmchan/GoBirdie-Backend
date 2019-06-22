<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Organization;
use App\Models\Hour;
use App\Models\Area;
use App\Models\Category_place;

class PlaceController extends GenericController
{
    public function __construct(PlaceRepository $placeRepo)
    {
        $this->tableName = 'places';
        $this->image_dir = 'place_images';
        $this->repo = $placeRepo;
    }

    protected function pluckData() {
        $data = parent::pluckData();
        $data['organizations'] = Organization::where('status','A')->pluck('name','id')->all();
        $data['categories'] = Category_place::where('status','A')->pluck('name','id')->all();
        $data['hours'] = Hour::where('status','A')->pluck('name','id')->all();
        $data['areas'] = Area::where('status','A')->pluck('name','id')->all();
        return $data;
    }
    protected function requestToInput(Request $request, $obj = null) {
        $input = parent::requestToInput($request, $obj);
        $input['opening_hours'] = $this->arrToStr($request, 'opening_hours');
        $input['areas'] = $this->arrToStr($request, 'areas');
        return $input;
    }
    /**
     * Store a newly created Place in storage.
     *
     * @param CreatePlaceRequest $request
     *
     * @return Response
     */
    public function store(CreatePlaceRequest $request)
    {
        $place = $this->repo->create($this->requestToInput($request));

        Flash::success('Place saved successfully.');

        return redirect(route('places.index'));
    }

    /**
     * Display the specified Place.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $place = $this->repo->find($id);

        if (empty($place)) {
            Flash::error('Place not found');

            return redirect(route('places.index'));
        }

        return view('places.show')->with('place', $place);
    }

    /**
     * Show the form for editing the specified Place.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $place = $this->repo->find($id);

        if (empty($place)) {
            Flash::error('Place not found');

            return redirect(route('places.index'));
        }
        $data = $this->pluckData();
        $data['place'] = $place;
        return view('places.edit')->with($data);
    }

    /**
     * Update the specified Place in storage.
     *
     * @param int $id
     * @param UpdatePlaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlaceRequest $request)
    {
        $place = $this->repo->find($id);

        if (empty($place)) {
            Flash::error('Place not found');

            return redirect(route('places.index'));
        }

        $place = $this->repo->update($this->requestToInput($request, $place), $id);

        Flash::success('Place updated successfully.');

        return redirect(route('places.index'));
    }
}
