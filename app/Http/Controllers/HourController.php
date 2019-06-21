<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHourRequest;
use App\Http\Requests\UpdateHourRequest;
use App\Repositories\HourRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HourController extends AppBaseController
{
    /** @var  HourRepository */
    private $hourRepository;

    public function __construct(HourRepository $hourRepo)
    {
        $this->hourRepository = $hourRepo;
    }

    /**
     * Display a listing of the Hour.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $hours = $this->hourRepository->paginate(10);

        return view('hours.index')
            ->with('hours', $hours);
    }

    /**
     * Show the form for creating a new Hour.
     *
     * @return Response
     */
    public function create()
    {
        return view('hours.create');
    }

    /**
     * Store a newly created Hour in storage.
     *
     * @param CreateHourRequest $request
     *
     * @return Response
     */
    public function store(CreateHourRequest $request)
    {
        $input = $request->all();

        $hour = $this->hourRepository->create($input);

        Flash::success('Hour saved successfully.');

        return redirect(route('hours.index'));
    }

    /**
     * Display the specified Hour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            Flash::error('Hour not found');

            return redirect(route('hours.index'));
        }

        return view('hours.show')->with('hour', $hour);
    }

    /**
     * Show the form for editing the specified Hour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            Flash::error('Hour not found');

            return redirect(route('hours.index'));
        }

        return view('hours.edit')->with('hour', $hour);
    }

    /**
     * Update the specified Hour in storage.
     *
     * @param int $id
     * @param UpdateHourRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHourRequest $request)
    {
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            Flash::error('Hour not found');

            return redirect(route('hours.index'));
        }

        $hour = $this->hourRepository->update($request->all(), $id);

        Flash::success('Hour updated successfully.');

        return redirect(route('hours.index'));
    }

    /**
     * Remove the specified Hour from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            Flash::error('Hour not found');

            return redirect(route('hours.index'));
        }

        $this->hourRepository->delete($id);

        Flash::success('Hour deleted successfully.');

        return redirect(route('hours.index'));
    }
}
