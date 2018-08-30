<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Light;
use Illuminate\Support\Facades\DB;

class LightC extends Controller


{

        public function display(){
            return view('light');
        }

        public function displaygraph(){
            return view('grafice_user/graficlumina');
        }



    //function for getting all the light values
    public function index(){

        //get all the dates in an ascending
        //$light=Light::all();

        //get all the dates descending
        $light= Light::orderBy('id', 'DESC')->get();
        return view('light.light',['light'=>$light]);

    }

    public function index_user(){

        //get all the dates in an ascending
        //$light=Light::all();

        //get all the dates descending
        $light= Light::orderBy('id', 'DESC')->get();
        return view('lightuser',['light'=>$light]);

    }
    //create requeste with ajax calls and jsons bodies
    public function newLight(Request $request){
        if($request->ajax()){

        $light=Light::create($request->all());
        return Response($light);
        }
    }

    public function getUpdate(Request $request){
        if($request->ajax())
        {
            $light=Light::find($request->id);
            return Response($light);
        }
    }

    public function newUpdate(Request $request){
        if($request->ajax())
        {
            $light=Light::find($request->id);
            $light->time=$request->time;
            $light->light=$request->light;
            $light->save();
            return Response($light);
        }
    }

    public function deleteLight(Request $request){
        if($request->ajax()){
            Light::destroy($request->id);
            return Response()->json(['sms'=>'Delete  successfully']);
        }

    }
}
