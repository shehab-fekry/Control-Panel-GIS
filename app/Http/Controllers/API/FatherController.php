<?php

namespace App\Http\Controllers;

use App\Models\Father;
use Illuminate\Http\Request;

class FatherController extends Controller
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


    public function create()
    {
        //
    }

    public function store()
    {
        Father::create([
            'name'=>'osama',
            'trip_id'=>1,
            'long'=>15.326,
            'lit'=>16.369

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function show(Father $father)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function edit(Father $father)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Father $father)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function destroy(Father $father)
    {
        //
    }
}
