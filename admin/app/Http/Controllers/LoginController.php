<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminModel;

class LoginController extends Controller
{
    function LoginIndex(){
    
        return view('Login');
    }
    
    function OnLogin(Request $request){
     $user =  $request->input('user');
     $pass =  $request->input('pass');
    $result= AdminModel::where('username','=',$user)->where('password','=',$pass)->count();
    
    if($result==true){
       $request->session()->put('user', $user);
        return 1;
    }else{
        return 0;
    }
    }
    
    function OnLogOut(Request $request){
        $request->session()->flush();
        return redirect('/Login');
    }    
}
