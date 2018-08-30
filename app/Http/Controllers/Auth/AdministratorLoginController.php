<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdministratorLoginController extends Controller
{



    public function __construct()
    {
        $this->middleware('guest:admin', ['except'=>['logout']]);

    }

    public function showLoginForm(){


    return view('auth.adminlogin');

   }


    public function login(Request $request){
         // validarea datelor
        $this->validate($request, [
            'email' => 'required|email',
            'password'=> 'required|min:6'

        ]);
        //incerarea userului de a se loga
        if( Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //daca e succesful sa ne redirectioneze catre calea pe care o vrem
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));



        //daca e unsuccesful sa ne redirectioneze la forma de login

    }
    //functia de logout pentru admin
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
