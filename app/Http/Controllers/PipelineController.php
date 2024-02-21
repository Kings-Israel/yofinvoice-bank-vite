<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;
use App\Http\Requests\StorePipelineRequest;
use App\Http\Requests\UpdatePipelineRequest;

class PipelineController extends Controller
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
     * @param  \App\Http\Requests\StorePipelineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePipelineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Http\Response
     */
    public function show(Pipeline $pipeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Pipeline $pipeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePipelineRequest  $request
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePipelineRequest $request, Pipeline $pipeline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pipeline $pipeline)
    {
        //
    }
}
