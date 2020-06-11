<?php

//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'feed-post', 'namespace' => 'Post', 'middleware'=>['auth.model']], function() {

        Route::get('/', 'ModelPostController@index')->name('model.post.index');
        Route::post('/save', 'ModelPostController@store')->name('model.post.store');

});
