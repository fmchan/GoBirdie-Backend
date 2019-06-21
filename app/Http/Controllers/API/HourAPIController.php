<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHourAPIRequest;
use App\Http\Requests\API\UpdateHourAPIRequest;
use App\Models\Hour;
use App\Repositories\HourRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HourController
 * @package App\Http\Controllers\API
 */

class HourAPIController extends AppBaseController
{
    /** @var  HourRepository */
    private $hourRepository;

    public function __construct(HourRepository $hourRepo)
    {
        $this->hourRepository = $hourRepo;
    }

    /**
     * Display a listing of the Hour.
     * GET|HEAD /hours
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $hours = $this->hourRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($hours->toArray(), 'Hours retrieved successfully');
    }

    /**
     * Store a newly created Hour in storage.
     * POST /hours
     *
     * @param CreateHourAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHourAPIRequest $request)
    {
        $input = $request->all();

        $hour = $this->hourRepository->create($input);

        return $this->sendResponse($hour->toArray(), 'Hour saved successfully');
    }

    /**
     * Display the specified Hour.
     * GET|HEAD /hours/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Hour $hour */
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            return $this->sendError('Hour not found');
        }

        return $this->sendResponse($hour->toArray(), 'Hour retrieved successfully');
    }

    /**
     * Update the specified Hour in storage.
     * PUT/PATCH /hours/{id}
     *
     * @param int $id
     * @param UpdateHourAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHourAPIRequest $request)
    {
        $input = $request->all();

        /** @var Hour $hour */
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            return $this->sendError('Hour not found');
        }

        $hour = $this->hourRepository->update($input, $id);

        return $this->sendResponse($hour->toArray(), 'Hour updated successfully');
    }

    /**
     * Remove the specified Hour from storage.
     * DELETE /hours/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Hour $hour */
        $hour = $this->hourRepository->find($id);

        if (empty($hour)) {
            return $this->sendError('Hour not found');
        }

        $hour->delete();

        return $this->sendResponse($id, 'Hour deleted successfully');
    }
}
