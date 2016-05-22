<?php

namespace App\Http\Controllers;

use App\Repositories\DreamRepository;
use App\Http\Requests\DreamRequest;

class DreamController extends Controller {

    /**
     * Repository instance.
     *
     */
    protected $dreamRepository;

    /**
     * Create a new DreamController controller instance.
     *
     * @param  App\Repositories\DreamRepository $dreamRepository
     * @return void
     */
    public function __construct(DreamRepository $dreamRepository)
    {
        $this->dreamRepository = $dreamRepository;

        $this->middleware('auth', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json($this->dreamRepository->getDreamsWithUserPaginate(4));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DreamRequest $request
     * @return Response
     */
    public function store(DreamRequest $request)
    {
        $this->dreamRepository->store($request->all(), auth()->id());

        return response()->json($this->dreamRepository->getDreamsWithUserPaginate(4));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\DreamRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(DreamRequest $request, $id)
    {
        if ($this->dreamRepository->update($request->all(), $id)) {
            return response()->json(['result' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->dreamRepository->destroy($id)) {
            return response()->json(['result' => 'success']);
        }
    }

}
