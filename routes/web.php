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

/* WELCOME */
/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', 'AppController@index');

/* AUTHENTICATION */
Auth::routes();

/* HOME */
Route::get('/home', 'HomeController@index')->name('home');

/* APPS */
Route::resource('/me/apps', 'AppController');
Route::get('apps/', ['as' =>  'apps.index', 'uses' => 'AppController@index']);
Route::get('/me/myAppsDev', ['as' =>  'apps.myAppsDev', 'uses' => 'AppController@myAppsDev']);
Route::get('/me/myAppsUser', ['as' =>  'apps.myAppsUser', 'uses' => 'AppController@myAppsUser']);
Route::get('apps/me/restore/{id}', ['as' =>  'apps.restore', 'uses' => 'AppController@restore']);
Route::post('apps/api/buy/{id}', ['as' =>  'apps.buy', 'uses' => 'AppController@buy']);