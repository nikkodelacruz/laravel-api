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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List Article
Route::get('articles', 'ArticleController@index');
// http://laravelapi.local/api/articles

// Single Article
Route::get('article/{id}', 'ArticleController@show');
// http://laravelapi.local/api/article/1

// Create new article
Route::post('article', 'ArticleController@store');

// Update article
Route::put('article', 'ArticleController@store');

// Delete article
Route::delete('article/{id}', 'ArticleController@destroy');

// Branch API
Route::get('branches', 'BranchesController@index');
// Route::get('branch/{id}', 'BranchesController@show');
Route::post('branch', 'BranchesController@store');
// Route::put('branch', 'BranchesController@store');
// Route::delete('branch/{id}', 'BranchchesController@destroy');

// Doctor API
Route::get('doctors', 'DoctorsController@index');

// Procedure API
Route::get('procedures', 'ProceduresController@index');

// Doctor Schedule API
Route::get('schedules', 'DoctorSchedulesController@index');
Route::post('schedule', 'DoctorSchedulesController@store');
// Route::put('schedule/{id}', 'DoctorSchedulesController@update');
