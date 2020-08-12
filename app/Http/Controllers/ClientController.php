<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function createCase(Request $request){

	    return view('client.create');

	    /*$user = \Auth::user();

	    if($user->hasRole('admin') || $user->type == 'client'){
	    	return view('client.create');
	    }*/


		/*if($user->type == 'admin' || $user->type == 'client'){
			return view('client.create');
		}*/

		
	}
}
