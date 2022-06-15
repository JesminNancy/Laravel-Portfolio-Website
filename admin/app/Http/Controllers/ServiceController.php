<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicesModel;

class ServiceController extends Controller
{
    function ServiceIndex(){
        return view('Services');
    }
    
    function getServicesData(){
    $result = json_encode(ServicesModel::all());
        return $result;
    }
    
    function deleteService(Request $request){
       $id = $request->input('id');
      $result = ServicesModel::where('id','=',$id)->delete();
      
      if($result==true){
        return 1 ;
      }else{
        return 0 ;
      }   
    }
}
