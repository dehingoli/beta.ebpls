<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');


// Pages routes...



//Announcement
Route::get('/', 'HomeController@showHome');
Route::post('/getAnnouncement', 'HomeController@getAnnouncement');

//Business Permit
Route::get('/Permits/Business-Permits/{id}', 'BusinessPermitController@showBusinessApplicationList'); //views
Route::get('/Permits/Business-Permits/{id}/{ids}', 'BusinessPermitController@getDataByID'); // getDataByID   
Route::post('/Permits/Business-Permits/{id}', 'BusinessPermitController@addData'); // inserting of data in Business Permit
Route::post('/Permits/{id}/Update', 'BusinessPermitController@updateDataByID'); 
Route::post('/Permits/{id}/Delete', 'BusinessPermitController@deleteDataByID'); // deleteDataByID 
//online register
Route::post('/Permits/Online-Register/', 'BusinessPermitController@onlineRegisterData');



//References
Route::get('/References/{id}', 'ReferencesController@showReference'); // views
Route::get('/References/Business-Permit/Business-Nature/{id}/{ids}', 'ReferencesController@manageDataByID'); // views , managing data in sub sub page
Route::get('/References/Business-Permit/{id}', 'ReferencesController@showReference'); //views
Route::get('/References/{id}/{ids}', 'ReferencesController@getDataByID'); // getDataByID   


Route::post('/References/{id}', 'ReferencesController@addData'); // inserting of data in References
Route::post('/References/{id}/Update', 'ReferencesController@updateDataByID'); // updating of data in References
Route::post('/References/{id}/Delete', 'ReferencesController@deleteDataByID'); // deleteDataByID 



