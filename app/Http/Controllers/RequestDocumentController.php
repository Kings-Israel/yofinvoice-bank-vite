<?php

namespace App\Http\Controllers;

use App\Models\RequestDocument;
use App\Http\Requests\StoreRequestDocumentRequest;
use App\Http\Requests\UpdateRequestDocumentRequest;

class RequestDocumentController extends Controller
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
     * @param  \App\Http\Requests\StoreRequestDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestDocument  $requestDocument
     * @return \Illuminate\Http\Response
     */
    public function show(RequestDocument $requestDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestDocument  $requestDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestDocument $requestDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestDocumentRequest  $request
     * @param  \App\Models\RequestDocument  $requestDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestDocumentRequest $request, RequestDocument $requestDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestDocument  $requestDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestDocument $requestDocument)
    {
        //
    }
}
