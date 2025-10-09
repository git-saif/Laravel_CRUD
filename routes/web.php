<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CrudController;
// use App\Http\Controllers\Crud0Controller;
use App\Http\Controllers\Crud1Controller;
use App\Http\Controllers\Crud2Controller;
use App\Http\Controllers\Crud3Controller;
use App\Http\Controllers\Crud4Controller;
use App\Http\Controllers\Crud5Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('components.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Resource Routes.
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

    Route::resources([

        'crud-1' => Crud1Controller::class,
        'crud-2' => Crud2Controller::class,
        'crud-3' => Crud3Controller::class,

        // CRUD With Advance Validation -> app/Http/Requests/FolderName/RequestName.php
        'crud-4' => Crud4Controller::class,
        'crud-5' => Crud5Controller::class

    ]);
});
