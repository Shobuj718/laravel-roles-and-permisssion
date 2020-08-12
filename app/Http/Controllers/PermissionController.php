<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PermissionController extends Controller
{   


    /*public function __construct()
	{
	   $this->middleware('auth'); 
	}*/

    public function Permission()
    {   
    	$admin_permissin = Permission::where('slug','create-tasks')->first();
		$client_permission = Permission::where('slug', 'edit-users')->first();
		$lawyer_permission = Permission::where('slug', 'delete-users')->first();

		//RoleTableSeeder.php
		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Admin';
		$admin_role->save();
		$admin_role->permissions()->attach($admin_permissin);

		$client_role = new Role();
		$client_role->slug = 'client';
		$client_role->name = 'Client';
		$client_role->save();
		$client_role->permissions()->attach($client_permission);

		$lawyer_role = new Role();
		$lawyer_role->slug = 'lawyer';
		$lawyer_role->name = 'Lawyer';
		$lawyer_role->save();
		$lawyer_role->permissions()->attach($lawyer_permission);

		$admin_role = Role::where('slug','admin')->first();
		$client_role = Role::where('slug', 'client')->first();
		$lawyer_role = Role::where('slug', 'lawyer')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($admin_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($client_role);

		$deleteUser = new Permission();
		$deleteUser->slug = 'delete-users';
		$deleteUser->name = 'Delete Users';
		$deleteUser->save();
		$deleteUser->roles()->attach($lawyer_role);

		$admin_role = Role::where('slug','admin')->first();
		$client_role = Role::where('slug', 'client')->first();
		$lawyer_role = Role::where('slug', 'lawyer')->first();

		$admin_per = Permission::where('slug','create-tasks')->first();
		$client_perm = Permission::where('slug','edit-users')->first();
		$lawyer_perm = Permission::where('slug','edit-users')->first();

		$developer = new User();
		$developer->name = 'TLA Admin';
		$developer->email = 'admin@gmail.com';
		$developer->type = 'admin';
		$developer->password = bcrypt('12345678');
		$developer->save();
		$developer->roles()->attach($admin_role);
		$developer->permissions()->attach($admin_per);

		$client = new User();
		$client->name = 'TLA client';
		$client->email = 'client@gmail.com';
		$client->type = 'client';
		$client->password = bcrypt('12345678');
		$client->save();
		$client->roles()->attach($client_role);
		$client->permissions()->attach($client_perm);

		$lawyer = new User();
		$lawyer->name = 'TLA Lawyer';
		$lawyer->email = 'lawyer@gmail.com';
		$lawyer->type = 'lawyer';
		$lawyer->password = bcrypt('12345678');
		$lawyer->save();
		$lawyer->roles()->attach($lawyer_role);
		$lawyer->permissions()->attach($lawyer_perm);

		

		
		return redirect()->back();
    }

    public function checkPages(Request $request){

    	if ($request->user()->can('create-tasks')) {
	        return view('check');
	    }else{
	    	dd('this user can not ');
	    }

    	
    }

    public function checkRoles(Request $request){
    	$user = $request->user();
		//dd($user->hasRole('developer')); //will return true, if user has role
		//dd($user->givePermissionsTo('create-tasks'));// will return permission, if not null
		dd($user->can('create-tasks')); // will return true, if user has permission
    }


	public function store(Request $request)
	{
	    if ($request->user()->can('create-tasks')) {
	        dd('this user can created task');
	    }else{
	    	dd('this user can not created task');
	    }
	}

	public function destroy(Request $request, $id)
	{   
	    if ($request->user()->can('delete-tasks')) {
	      dd('this user can deleted task');
	    }else{
	    	dd('this user can not deleted task');
	    }

	}

	public function createCase(){
		//$user_type = Auth::user()->type;

		return view('admin.create');
	}


	public function roleShow(Request $request, $slug){
		$user = $request->user();
		dd($user->hasRole($slug)); //will return true, if user has role
		dd($user->givePermissionsTo('create-tasks'));// will return permission, if not null
		dd($user->can('create-tasks')); // will return true, if user has permission
	}


}

