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

// HOMEPAGE
Route::get('/', 'StaticPageController@home')->name('homepage');

// ABOUT 
Route::get('/about-me', 'StaticPageController@about')->name('about');

// POST RESOURCE PAGES
Route::resource('posts', 'PostController');