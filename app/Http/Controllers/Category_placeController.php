<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategory_placeRequest;
use App\Http\Requests\UpdateCategory_placeRequest;
use App\Repositories\Category_placeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Category_placeController extends AppBaseController
{
    /** @var  Category_placeRepository */
    private $categoryPlaceRepository;

    public function __construct(Category_placeRepository $categoryPlaceRepo)
    {
        $this->categoryPlaceRepository = $categoryPlaceRepo;
    }

    private function uploadImage(Request $request) {
        $input = $request->all();
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = md5(uniqid() . time()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/icons');
            $image->move($destinationPath, $name);
            $input['icon'] = $name;
            //$cat->save();
        }
        return $input;
    }

    /**
     * Display a listing of the Category_place.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categoryPlaces = $this->categoryPlaceRepository->paginate(10);

        return view('category_places.index')
            ->with('categoryPlaces', $categoryPlaces);
    }

    /**
     * Show the form for creating a new Category_place.
     *
     * @return Response
     */
    public function create()
    {
        return view('category_places.create');
    }

    /**
     * Store a newly created Category_place in storage.
     *
     * @param CreateCategory_placeRequest $request
     *
     * @return Response
     */
    public function store(CreateCategory_placeRequest $request)
    {
        $categoryPlace = $this->categoryPlaceRepository->create($this->uploadImage($request));

        Flash::success('Category Place saved successfully.');

        return redirect(route('categoryPlaces.index'));
    }

    /**
     * Display the specified Category_place.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            Flash::error('Category Place not found');

            return redirect(route('categoryPlaces.index'));
        }

        return view('category_places.show')->with('categoryPlace', $categoryPlace);
    }

    /**
     * Show the form for editing the specified Category_place.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            Flash::error('Category Place not found');

            return redirect(route('categoryPlaces.index'));
        }

        return view('category_places.edit')->with('categoryPlace', $categoryPlace);
    }

    /**
     * Update the specified Category_place in storage.
     *
     * @param int $id
     * @param UpdateCategory_placeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategory_placeRequest $request)
    {
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            Flash::error('Category Place not found');

            return redirect(route('categoryPlaces.index'));
        }

        $categoryPlace = $this->categoryPlaceRepository->update($this->uploadImage($request), $id);

        Flash::success('Category Place updated successfully.');

        return redirect(route('categoryPlaces.index'));
    }

    /**
     * Remove the specified Category_place from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryPlace = $this->categoryPlaceRepository->find($id);

        if (empty($categoryPlace)) {
            Flash::error('Category Place not found');

            return redirect(route('categoryPlaces.index'));
        }

        $this->categoryPlaceRepository->delete($id);

        Flash::success('Category Place deleted successfully.');

        return redirect(route('categoryPlaces.index'));
    }
}
