<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/v1/apiKey', [\App\Http\Controllers\ApiKeyController::class, 'generate']);
Route::get('/v1/words', [\App\Http\Controllers\WordController::class, 'search'])->middleware('apiKey');


