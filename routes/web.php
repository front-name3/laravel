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

/* Route::get('/', function () {
    return view('welcome');
}); */


/* Route::resource('/index', 'CompaniesController'); */
Auth::routes();

Route::get('/', 'HomeController@index')->name('crud.index'); /* 一覧表示 */

Route::get('/show/{id}/', 'HomeController@show')->name('crud.show'); /* 詳細情報 */

Route::get('/edit/{id}/', 'HomeController@edit')->name('crud.edit'); /* 編集 */

Route::get('/create', 'HomeController@create')->name('crud.create'); /* 新規登録 */

Route::post('/store', 'HomeController@store')->name('crud.store'); /* 保存 */

Route::get('/update/{id}', 'HomeController@update')->name('crud.update'); /* 更新 */
Route::post('/update/{id}', 'HomeController@update')->name('crud.update'); /* 更新 */

Route::post('/destroy/{id}', 'HomeController@destroy'); /* レコード削除 */