<?php

use App\Livewire\TaskManager;
use Illuminate\Support\Facades\Route;

Route::get('/', TaskManager::class)->name('tasks.index');
