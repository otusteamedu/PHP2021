<?php

namespace App\Http\Controllers;

use App\Models\ParsingDictionary;
use App\Http\Requests\StoreParsingDictionaryRequest;
use App\Http\Requests\UpdateParsingDictionaryRequest;

class ParsingDictionaryController extends Controller
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
     * @param  \App\Http\Requests\StoreParsingDictionaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParsingDictionaryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParsingDictionary  $parsingDictionary
     * @return \Illuminate\Http\Response
     */
    public function show(ParsingDictionary $parsingDictionary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParsingDictionary  $parsingDictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(ParsingDictionary $parsingDictionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParsingDictionaryRequest  $request
     * @param  \App\Models\ParsingDictionary  $parsingDictionary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParsingDictionaryRequest $request, ParsingDictionary $parsingDictionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParsingDictionary  $parsingDictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParsingDictionary $parsingDictionary)
    {
        //
    }
}
