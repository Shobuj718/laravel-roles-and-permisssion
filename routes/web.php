<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/roles', 'PermissionController@Permission');












/*Route::middleware(['lawyer'])->group(function() {
	Route::get('/lawyer/create-case', 'LawyerController@createCase');
});*/

Route::get('/role-show/{slug}', 'PermissionController@roleShow');

Route::group(['middleware' => 'role:admin'], function() {

	Route::get('/admin/create-case', 'PermissionController@createCase');
	Route::get('/client/create-case', 'ClientController@createCase');

   Route::get('/admin', function() {

      return 'Welcome Admin';
      
   });

});

Route::group(['middleware' => 'role:client'], function() {

	Route::get('/client/create-case', 'ClientController@createCase');

   Route::get('/client', function() {

      return 'Welcome Client';
      
   });

});

Route::group(['middleware' => 'role:lawyer'], function() {

	Route::get('/lawyer/create-case', 'LawyerController@createCase');

   Route::get('/lawyer', function() {

      return 'Welcome Lawyer';
      
   });

});





//Route::get('/store', 'PermissionController@store');
//Route::get('/destroy/{id}', 'PermissionController@destroy');

//Route::group(['middleware' => 'role:developer'], function() {

   /*Route::get('/admin', function() {

      return 'Welcome Admin';
      
   });*/
   //Route::get('/admin', 'PermissionController@checkPages');

//});


//Route::get('/check-roles', 'PermissionController@checkRoles');
//Route::get('/check-page', 'PermissionController@checkPages');







