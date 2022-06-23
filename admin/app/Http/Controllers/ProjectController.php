<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectsModel;

class ProjectController extends Controller
{
    
    function ProjectsIndex(){
        return view('projects');
    }
    
    function getProjectsData(){
        $result = json_encode(ProjectsModel::orderBy('id','desc')->get());
            return $result;
    }
    
    function getProjectsDetails(Request $request){
        $id = $request->input('id');
        $result = json_encode(ProjectsModel::where('id','=',$id)->get());
         return $result;
    }
    
    function deleteProjects(Request $request){
        $id = $request->input('id');
       $result = ProjectsModel::where('id','=',$id)->delete();
       
       if($result==true){
         return 1 ;
       }else{
         return 0 ;
       }   
     }
     
     function ProjectsUpdate(Request $request){
        $id = $request->input('id');
        $project_name = $request->input('project_name');
        $project_des = $request->input('project_des');
        $project_link = $request->input('project_link');
        $project_img = $request->input('project_img');
        
       $result = ProjectsModel::where('id','=',$id)->update([
               'project_name'=>$project_name,
               'project_des'=>$project_des,
               'project_link'=>$project_link,
               'project_img'=>$project_img,
               ]);
       
       if($result==true){
         return 1 ;
       }else{
         return 0 ;
       }   
     } 
    
     function ProjectsAdd(Request $request){
        $project_name = $request->input('project_name');
        $project_des = $request->input('project_des');
        $project_link = $request->input('project_link');
        $project_img = $request->input('project_img');
        
       $result = ProjectsModel::insert(
       [
        'project_name'=>$project_name,
        'project_des'=>$project_des,
        'project_link'=>$project_link,
        'project_img'=>$project_img,
       ]
       );
       
       if($result==true){
         return 1 ;
       }else{
         return 0 ;
       }   
     } 
     
}
