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

//Route::get('/', function () {
//    return view('login');
//    $elo = new Domains\Admin\Repositories\AdminRepositoryEloquent();
//    echo '<pre>';
//    var_dump($elo->all()->toArray());
//    echo '</pre>';
//});

//Route::post('login', 'Admin@login');

Auth::routes();

Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
