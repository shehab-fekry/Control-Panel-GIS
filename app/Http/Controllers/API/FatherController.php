<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Father;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;

class FatherController extends BaseController
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
