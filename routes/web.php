<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SaveProject;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function() {
    Route::get('/generate-invoice', function() {
        return view('invoice');
    })->name('invoice');

    Route::get('/projects', function() {
        return view('projects');
    })->name('projects');

    Route::get('/projects/add', SaveProject::class)->name('projects.add');
    Route::get('/projects/edit/{id}', SaveProject::class)->name('projects.edit');

    Route::get('/products', function() {
        return view('products');
    })->name('products');
});

require __DIR__.'/auth.php';
