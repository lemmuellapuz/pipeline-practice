<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/user', UserController::class);
