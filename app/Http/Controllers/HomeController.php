<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\ActiveUsers;
use App\Models\Ticketing;
use Illuminate\Support\Facades\Session;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    #current login user details

     $users = Auth::user()->count();
     
     $welcome   = 'Welcome';
     $msg       = ', Enjoy Adminstrating.';
     #total student
     $driver = Driver::all()->count();
     $ticket = Ticketing::all()->count();

    return view('home',compact('driver','ticket','users'));
}
}
