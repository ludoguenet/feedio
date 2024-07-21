<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;

Route::get('/', [FeedController::class, 'index']);
