<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Light;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function RedirectIfAuthenticated(){

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin');
    }



    public function lightgraph(){
        return view('grafice/lightgraph');
    }

    public function tempgraph(){
        return view('grafice/tempgraph');
    }

    public function humgraph(){
        return view('grafice/humgraph');
    }

    public function moistgraph(){
        return view('grafice/moistgraph');
    }

    public function controlor(){
        return view('control/controlare');
    }




}
