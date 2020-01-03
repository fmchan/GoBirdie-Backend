<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePushAPIRequest;
use App\Http\Requests\API\UpdatePushAPIRequest;
use App\Models\Push;
use App\Repositories\PushRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PushController
 * @package App\Http\Controllers\API
 */

class PushAPIController extends AppBaseController
{
    /** @var  PushRepository */
    private $pushRepository;

    public function __construct(PushRepository $pushRepo)
    {
        $this->pushRepository = $pushRepo;
    }

    /**
     * Display a listing of the Push.
     * GET|HEAD /pushes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $pushes = $this->pushRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($pushes->toArray(), 'Pushes retrieved successfully');
    }

    /**
     * Store a newly created Push in storage.
     * POST /pushes
     *
     * @param CreatePushAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePushAPIRequest $request)
    {
        $input = $request->all();

        $push = $this->pushRepository->create($input);

        return $this->sendResponse($push->toArray(), 'Push saved successfully');
    }

    /**
     * Display the specified Push.
     * GET|HEAD /pushes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Push $push */
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            return $this->sendError('Push not found');
        }

        return $this->sendResponse($push->toArray(), 'Push retrieved successfully');
    }

    /**
     * Update the specified Push in storage.
     * PUT/PATCH /pushes/{id}
     *
     * @param int $id
     * @param UpdatePushAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePushAPIRequest $request)
    {
        $input = $request->all();

        /** @var Push $push */
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            return $this->sendError('Push not found');
        }

        $push = $this->pushRepository->update($input, $id);

        return $this->sendResponse($push->toArray(), 'Push updated successfully');
    }

    /**
     * Remove the specified Push from storage.
     * DELETE /pushes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Push $push */
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            return $this->sendError('Push not found');
        }

        $push->delete();

        return $this->sendResponse($id, 'Push deleted successfully');
    }
}
