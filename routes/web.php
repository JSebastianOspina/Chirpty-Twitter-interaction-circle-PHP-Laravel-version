<?php

use App\Http\Controllers\TwitterController;
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
Route::get('/app', 'TwitterController@generar')->name('generar');
Route::get('/callback', 'TwitterController@callback')->name('callback');

Route::get('/user/{user}', 'TwitterController@CrearCirculo')->name('twitter');
Route::get('/', 'TwitterController@Index')->name('inicio');

Route::get('/pls', 'HomeController@comandos')->name('comandos');
Route::get('test', function () {
    return view('circulo.resultado');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
