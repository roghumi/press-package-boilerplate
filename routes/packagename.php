<?php

use Illuminate\Support\Facades\Route;

Route::middleware(config('press.crud.middleware'))
    ->prefix(config('press.crud.prefix'))
    ->group(function () {
    });
