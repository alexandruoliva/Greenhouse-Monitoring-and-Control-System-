<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserC extends Controller


{





    //function for getting all the light values
    public function index(){

        //get all the dates in an ascending
        //$light=Light::all();

        //get all the dates descending
        $user= User::orderBy('id', 'DESC')->get();
        return view('user.user',['user'=>$user]);

    }
    //create requeste with ajax calls and jsons bodies
    public function newUser(Request $request){
        if($request->ajax()){

            $user=User::create($request->all());
            return Response($user);
        }
    }

    /*
     * public function newUser(Request $request){
        if($request->ajax()){

            $user=User::create($request->all());
            return Response($user);
        }
    }
     */

    public function getUpdate(Request $request){
        if($request->ajax())
        {
            $user=User::find($request->id);
            return Response($user);
        }
    }

    public function newUpdate(Request $request){
        if($request->ajax())
        {
            $user=User::find($request->id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->save();
            return Response($user);
        }
    }

    public function deleteUser(Request $request){
        if($request->ajax()){
            User::destroy($request->id);
            return Response()->json(['sms'=>'Delete  successfully']);
        }

    }
}
