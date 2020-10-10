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

# Frontend

Route::get('/', 'App\Http\Controllers\FrontendController@index')->name('frontend.index');
Route::get('lien-he', 'App\Http\Controllers\FrontendController@contact')->name('frontend.contact');
Route::get('tag/{value}', 'App\Http\Controllers\FrontendController@tag')->name('frontend.tag');
Route::get('search', 'App\Http\Controllers\FrontendController@search')->name('frontend.search');
Route::get('video/{value?}', 'App\Http\Controllers\FrontendController@video')->name('frontend.video');
Route::post('saveContact', 'App\Http\Controllers\FrontendController@saveContact')->name('frontend.save_contact');
Route::get('sitemap.xml', 'App\Http\Controllers\FrontendController@sitemap')->name('frontend.sitemap');
Route::get('site_maps_posts', 'App\Http\Controllers\FrontendController@siteMapsPosts')->name('frontend.site_maps_posts');
Route::get('site_maps_categories', 'App\Http\Controllers\FrontendController@siteMapsCategories')->name('frontend.site_maps_categories');
Route::get('{value}', 'App\Http\Controllers\FrontendController@main')->name('frontend.main');
