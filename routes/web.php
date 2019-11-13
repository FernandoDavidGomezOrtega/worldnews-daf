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

Route::get('/', function () {

    return view('welcome');


});

// RUTAS GENERALES
Auth::routes();
Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@home')->name('home');

// USUARIO
Route::get('/configuracion', 'userController@config')->name('config');
Route::post('/user/update', 'userController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'userController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'userController@profile')->name('profile');
Route::get('/gente/{search?}', 'userController@index')->name('user.index');

// PUBLISHED_ARTICLE
Route::get('/subir-articulo', 'ArticleController@create')->name('article.create');
Route::post('/article/save', 'ArticleController@save')->name('article.save');
Route::get('/article/file/{filename}', 'ArticleController@getComponent')->name('article.file');
Route::get('/article/{id}', 'ArticleController@detail')->name('article.detail');
Route::get('/article/delete/{id}', 'ArticleController@delete')->name('article.delete');
Route::get('/article/editar/{id}', 'ArticleController@edit')->name('article.edit');
Route::post('/article/update', 'ArticleController@update')->name('article.update');




