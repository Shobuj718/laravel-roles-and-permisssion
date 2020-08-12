<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LawyerController extends Controller
{
    public function createCase(){

    	if(\Auth::user()->type == 'lawyer'){
            return view('lawyer.create');
        } else {
            return redirect()->back();
        }		
	}
}
