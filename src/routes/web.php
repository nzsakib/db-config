<?php

namespace Nzsakib\DbConfig\Http\Controller;

use Illuminate\Support\Facades\Route;

Route::get('/test', [ConfigController::class, 'index']);
