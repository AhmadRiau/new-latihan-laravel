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

Route::get('/test', function () {
    return 'Good bye world';
});

Route::redirect('/redirect', '/test');
Route::fallback(function () {
    return "404 nothing here";
});

Route::view('/hello', 'hello', ['name' => 'and Good bye']);
Route::view('/hello-again', 'template.world', ['name' => 'and Good bye']);