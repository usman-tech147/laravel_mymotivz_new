<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    //        dd('here');
           if(auth()->user()->is_admin==1 ){

            return view('admin.pages.dashboard');
        }

    }
    public function admin()

    {

        return view('admin');

           
    }
}
