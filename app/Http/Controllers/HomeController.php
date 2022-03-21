<?php
namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\driver;
use App\Models\father;
use App\Models\child;
use App\Models\vehicle;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $admin=Auth::user()->school_id;
        return view('home')
        ->with('countdriver',  Driver::where("school_id",$admin)->count())
        ->with('countfather',  father::where("school_id",$admin)->count())
        ->with('countchild',   child::count())
        ->with('countvehicle', vehicle::where("school_id",$admin)->count());
    }
}
