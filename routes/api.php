<?php

use App\Http\Controllers\API\NewsSearchController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/news-search', 
    [
        NewsSearchController::class,
        'index',
    ]
);
