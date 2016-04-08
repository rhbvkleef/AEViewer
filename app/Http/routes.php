<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'https'], function() {
    Route::group(['middleware' => 'web'], function () {
        Route::auth();

        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/help', function() {
            return view('ae.doc');
        })->name('ae.doc');

        //View AE system contents
        Route::get('/AESystem/{user}/view', 'AEInformationController@getViewAESystem')->name('ae.view');

    //Find an AE system
    Route::post('AESystem/search', 'AEInformationController@postSearch')->name('ae.search');
    Route::get('AESystem/all', 'AEInformationController@postSearch')->name('ae.all');

    //Settings
    Route::get('settings', 'UserController@getSettings')->name('user.settings')->middleware('auth');
});

//API for updating AE system contents
Route::post('/updateAESystem', 'APIController@postUpdateAESystem')->name('ae.api.update');

//API for search completion
Route::post('/AESystem/search/suggest', 'APIController@postSearchUsers')->name('ae.api.search.suggest');
