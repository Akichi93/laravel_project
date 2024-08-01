<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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
    return view('welcome');
});


Route::get('/test-redis', function () {
    Cache::put('test-key', 'test-value', 10);

    if (Cache::has('test-key')) {
        $value = Cache::get('test-key');
        return "Redis is working! Cached value: " . $value;
    }

    return "Redis is not working!";
});