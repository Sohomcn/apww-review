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

Route::group(['prefix' => 'reviews', 'namespace' => 'Review', 'middleware'=>['auth']], function() {

    //Fan
    Route::get('/', 'FanReviewController@index')->name('fan.review.index');
    Route::get('/write/{model_id}', 'FanReviewController@create')->name('fan.review.create');
    Route::post('/submit', 'FanReviewController@store')->name('fan.review.store');
    Route::get('/models/{model_id}', 'FanReviewController@models_review')->name('fan.review.models');
    Route::get('/my-review', 'FanReviewController@my_review')->name('fan.own.review');

    //admin
    Route::get('/all', 'AdminReviewController@index')->name('admin.review.index');
    Route::get('/show/{review_id}', 'AdminReviewController@show')->name('admin.review.show');
    Route::get('/delete/{review_id}', 'AdminReviewController@destroy')->name('admin.review.delete');
    Route::post('/update-status', 'AdminReviewController@updateStatus')->name('admin.review.updateStatus');
});
