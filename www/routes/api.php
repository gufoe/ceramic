<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('signup', 'UserController@signup');
Route::post('login', 'UserController@login');

Route::middleware('auth:api')->group(function() {
  Route::get('self', 'UserController@self');
  Route::post('logout', 'UserController@logout');

  Route::get('projects', 'ProjectController@list');
  Route::post('projects', 'ProjectController@create');
  Route::delete('projects/{id}', 'ProjectController@delete');
  Route::get('projects/{id}', 'ProjectController@list');
  Route::post('projects/{id}/build', 'ProjectController@build');
});
