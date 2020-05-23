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

// Auth::routes();

Auth::routes(['register' => false]); //disable register

Route::get('/home', 'HomeController@index')->name('home');
// name method = named routes -> allow the convenient generation of URLs or redirects for specific routes
// generating urls: $url = route('home'); //return url of home
// generating redirects: redirect()->route('home')

// Pages
// Method 1
Route::get('/articles', 'ArticleController@articles')->name('articles');
// Method 2
// Route::get('/articles', function(){
// 	return view('pages.articles')->with('title', 'Articles');
// });
// Method 3
// Route::view('/articles', 'pages/articles', ['title' => 'Articles']);

Route::get('/articles/all', 'ArticleController@allArticles')->name('all-articles');
