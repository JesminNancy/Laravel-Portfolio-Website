<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;

class VisitorController extends Controller
{
    function VisitorIndex(){
        //$visitorData = json_decode(VisitorModel::orderBy('id','desc')->take(3)->get());
       $visitorData = json_decode(VisitorModel::all());
        return view('Visitor',['visitordata'=>$visitorData]);
    }
}
