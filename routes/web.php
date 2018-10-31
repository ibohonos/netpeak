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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/create/journal', 'HomeController@createJournal')->name('create.journal');
Route::post('/save/journal', 'HomeController@saveJournal')->name('save.journal');
Route::get('/create/author', 'HomeController@createAuthor')->name('create.author');
Route::post('/save/author', 'HomeController@saveAuthor')->name('save.author');
Route::post('/delete/journal', 'HomeController@deleteJournal')->name('delete.journal');
Route::get('/edit/journal/{id}', 'HomeController@editJournal')->name('edit.journal');
Route::post('/update/journal', 'HomeController@updateJournal')->name('update.journal');
