<?php

use App\WebSocket\WebSocketHandler;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');
