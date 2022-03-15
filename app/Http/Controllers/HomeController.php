<?php
namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\driver;
use App\Models\father;
use App\Models\child;
use App\Models\vehicle;

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
        return view('home')
        ->with('countdriver',  Driver::count())
        ->with('countfather',  father::count())
        ->with('countchild',   child::count())
        ->with('countvehicle', vehicle::count());
    }
}
