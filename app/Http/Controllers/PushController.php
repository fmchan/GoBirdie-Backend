<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePushRequest;
use App\Http\Requests\UpdatePushRequest;
use App\Repositories\PushRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use ExponentPhpSDK\Expo;

class PushController extends AppBaseController
{
    /** @var  PushRepository */
    private $pushRepository;

    public function __construct(PushRepository $pushRepo)
    {
        $this->pushRepository = $pushRepo;
    }

    /**
     * Display a listing of the Push.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pushes = $this->pushRepository->paginate(10);

        return view('pushes.index')
            ->with('pushes', $pushes);
    }

    /**
     * Show the form for creating a new Push.
     *
     * @return Response
     */
    public function create()
    {
        return view('pushes.create');
    }

    /**
     * Store a newly created Push in storage.
     *
     * @param CreatePushRequest $request
     *
     * @return Response
     */
    public function store(CreatePushRequest $request, Expo $expo)
    {
        $input = $request->all();
        $input['channel'] = 'defualt';

        $push = $this->pushRepository->create($input);

        //{ “message”: “This is a test message.” }
        $details = [
            'title' => $input['title'], 
            'body' => $input['body'],
            'data' => json_encode(['type' => $input['type'], 'link' => $input['link']]) 
        ];
        $result = $expo->notify($input['channel'], $details, true);

        $message = '';
        foreach($result as $i) {
            $message .= 'status: ' . $i['status'] . ((isset($i['id'])? ' (' . $i['id'] . ')': '').'<br>';
        }
        Flash::success($message);

        return redirect(route('pushes.index'));
    }

    /**
     * Display the specified Push.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            Flash::error('Push not found');

            return redirect(route('pushes.index'));
        }

        return view('pushes.show')->with('push', $push);
    }

    /**
     * Show the form for editing the specified Push.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            Flash::error('Push not found');

            return redirect(route('pushes.index'));
        }

        return view('pushes.edit')->with('push', $push);
    }

    /**
     * Update the specified Push in storage.
     *
     * @param int $id
     * @param UpdatePushRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePushRequest $request)
    {
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            Flash::error('Push not found');

            return redirect(route('pushes.index'));
        }

        $push = $this->pushRepository->update($request->all(), $id);

        Flash::success('Push updated successfully.');

        return redirect(route('pushes.index'));
    }

    /**
     * Remove the specified Push from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $push = $this->pushRepository->find($id);

        if (empty($push)) {
            Flash::error('Push not found');

            return redirect(route('pushes.index'));
        }

        $this->pushRepository->delete($id);

        Flash::success('Push deleted successfully.');

        return redirect(route('pushes.index'));
    }
}
