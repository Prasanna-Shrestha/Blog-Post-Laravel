<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostExportController;

Route::apiResource('posts', PostExportController::class)
    ->only('index');