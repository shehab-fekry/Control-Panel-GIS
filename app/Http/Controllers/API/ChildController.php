<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;

class ChildController extends BaseController
{

    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store()
    {
        Child::create([
            'name'=>'ebrahim',
            'father_id'=>1,
            'status'=>true



        ]);
    }


    public function show(Child $child)
    {
        //
    }





    public function update(Request $request, Child $child)
    {
        //
    }


    public function destroy(Child $child)
    {
        //
    }
}
