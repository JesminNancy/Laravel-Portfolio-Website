<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoursesModel;

class CourseController extends Controller
{
   function coursePage(){
      $CoursesData = json_decode(CoursesModel::orderBy('id','desc')->get());
    return view('Courses',['CoursesData'=>$CoursesData]);
   }
}
