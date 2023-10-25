<?php

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

Route::get('/', function () {
    return view('layouts.login');
});

Route::get('/dashboard', function () {
    return view('content.dashboard');
});

Route::get('/checkpoint', function () {
    return view('content.checkpoint');
});

Route::get('/scan-office1', function () {
    return view('content.scan-office1');
});

Route::get('/scan-office2', function () {
    return view('content.scan-office2');
});

Route::get('/scan-dmc1', function () {
    return view('content.scan-dmc1');
});

Route::get('/scan-dmc2', function () {
    return view('content.scan-dmc2');
});

Route::get('/scan-outdoor', function () {
    return view('content.scan-outdoor');
});

Route::get('/scan-history', function () {
    return view('content.scan-history');
});