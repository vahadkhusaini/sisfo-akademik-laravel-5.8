<?php

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

Route::get('/','AuthController@login')->name('login');
Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin']], function(){
    Route::get('/siswa','SiswaController@index');
    Route::post('/siswa/create','SiswaController@create');
    Route::get('/siswa/{siswa}/edit','SiswaController@edit');
    Route::post('/siswa/{siswa}/update','SiswaController@update');
    Route::get('/siswa/{siswa}/delete','SiswaController@delete');
    Route::get('/siswa/{siswa}/profil','SiswaController@profil');
    Route::post('/siswa/{siswa}/add_nilai','SiswaController@add_nilai');
    Route::get('/siswa/export','SiswaController@export');
    Route::post('/siswa/import','SiswaController@import_excel'); 
    Route::get('/siswa/export_pdf','SiswaController@export_pdf');
    Route::get('/guru/{id}/profil','GuruController@profil');
});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function(){
    Route::get('/dashboard','DashboardController@index');
});

Route::group(['middleware' => ['auth','checkRole:siswa']], function(){
    Route::get('/my_profile','SiswaController@my_profile');
});

Route::get('getdatasiswa',[
    'uses' => 'SiswaController@getdatasiswa',
    'as' => 'ajax.get.data.siswa',
]);

