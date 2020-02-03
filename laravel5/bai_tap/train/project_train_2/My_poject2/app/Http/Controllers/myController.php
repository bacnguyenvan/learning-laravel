<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
class myController extends Controller
{
    //
    public function getlist(){
    	$data=Record::table('records')->get()->toArray();
    	return view('tableUser',compact('data'));
    }

    public function postAdd(Request $request){
    	
    }
}
