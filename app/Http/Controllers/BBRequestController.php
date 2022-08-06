<?php

namespace App\Http\Controllers;

use App\Models\BBRequest;
use Illuminate\Http\Request;

class BBRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('b-request.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BBRequest  $bBRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BBRequest $bBRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BBRequest  $bBRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BBRequest $bBRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BBRequest  $bBRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BBRequest $bBRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BBRequest  $bBRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BBRequest $bBRequest)
    {
        //
    }
}
