<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get("/", function () {
    return view('numeraion');
});


Route::get('/database/simple', [Controller::class, 'simple']);
Route::get('/database/complex', [Controller::class, 'complex']);
Route::get(
    '/mail',
    [Controller::class, 'view']
);
