<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soil;
class SoilC extends Controller

{


    public function displaygraph(){
        return view('grafice_user/umiditatesol');
    }


    //function for getting all the soil values
    public function index(){

        //get all the dates in an ascending
        //$light=Light::all();

        //get all the dates descending
        $soil= Soil::orderBy('id', 'DESC')->get();
        return view('soil.soil',['soil'=>$soil]);

    }


    public function index_user(){

        //get all the dates in an ascending
        //$light=Light::all();

        //get all the dates descending
        $soil= Soil::orderBy('id', 'DESC')->get();
        return view('soiluser',['soil'=>$soil]);

    }
    //create requeste with ajax calls and jsons bodies
    public function newSoil(Request $request){
        if($request->ajax()){

            $soil=Soil::create($request->all());
            return Response($soil);
        }
    }

    public function getUpdate(Request $request){
        if($request->ajax())
        {
            $soil=Soil::find($request->id);
            return Response($soil);
        }
    }

    public function newUpdate(Request $request){
        if($request->ajax())
        {
            $soil=Soil::find($request->id);
            $soil->time=$request->time;
            $soil->moist=$request->moist;
            $soil->save();
            return Response($soil);
        }
    }

    public function deleteSoil(Request $request){
        if($request->ajax()){
            Soil::destroy($request->id);
            return Response()->json(['sms'=>'Delete  successfully']);
        }

    }
}