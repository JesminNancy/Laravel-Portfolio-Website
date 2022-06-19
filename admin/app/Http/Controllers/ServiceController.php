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
    
    function getServicesDetails(Request $request){
      $id = $request->input('id');
      $result = json_encode(ServicesModel::where('id','=',$id)->get());
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
    
    function serviceUpdate(Request $request){
      $id = $request->input('id');
      $name = $request->input('name');
      $des = $request->input('des');
      $img = $request->input('img');
     $result = ServicesModel::where('id','=',$id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
     
     if($result==true){
       return 1 ;
     }else{
       return 0 ;
     }   
   }
}
