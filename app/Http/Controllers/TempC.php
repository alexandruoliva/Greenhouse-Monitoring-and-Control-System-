<?php

namespace App\Http\Controllers;

use App\Temp;
use Illuminate\Http\Request;

class TempC extends Controller
{


    public function displaygraphtemp(){
        return view('grafice_user/grafictemperatura');
    }

    public function displaygraphhum(){
        return view('grafice_user/graficumiditate');
    }



    //function for getting all the light values
    //get all the dates in an ascending
    //$light=Light::all();

    //get all the dates descending

    public function index(){


        $temp= Temp::orderBy('id', 'DESC')->get();
        return view('temp.temp',['temp'=>$temp]);

    }

    public function index_user(){

        //get all the dates in an ascending
        //$light=Light::all();

        //get all the dates descending
        $temp= Temp::orderBy('id', 'DESC')->get();
        return view('tempuser',['temp'=>$temp]);

    }
    //create requeste with ajax calls and jsons bodies
    public function newTemp(Request $request){
        if($request->ajax()){

            $temp=Temp::create($request->all());
            return Response($temp);
        }
    }

    public function getUpdate(Request $request){
        if($request->ajax())
        {
            $temp=Temp::find($request->id);
            return Response($temp);
        }
    }

    public function newUpdate(Request $request){
        if($request->ajax())
        {
            $temp=Temp::find($request->id);
            $temp->time=$request->time;
            $temp->temperature=$request->temperature;
            $temp->humidity=$request->humidity;
            $temp->save();
            return Response($temp);
        }
    }

    public function deleteTemp(Request $request){
        if($request->ajax()){
            Temp::destroy($request->id);
            return Response()->json(['sms'=>'Delete  successfully']);
        }

    }
}
