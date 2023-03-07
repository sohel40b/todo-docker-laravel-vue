<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Cache Clear
Route::get("/cc", function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cache Cleared";
});

Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*');
