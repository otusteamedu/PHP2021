<?php

namespace App\Http\Controllers;

use App\Models\ProcessingStatus;
use App\Http\Requests\StoreProcessingStatusRequest;
use App\Http\Requests\UpdateProcessingStatusRequest;

class ProcessingStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcessingStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessingStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessingStatus  $processingStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessingStatus $processingStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessingStatus  $processingStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessingStatus $processingStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessingStatusRequest  $request
     * @param  \App\Models\ProcessingStatus  $processingStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessingStatusRequest $request, ProcessingStatus $processingStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessingStatus  $processingStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessingStatus $processingStatus)
    {
        //
    }
}
