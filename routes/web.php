<?php

use App\Http\Controllers\Crud0Controller;
use App\Http\Controllers\Crud2Controller;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

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

        'crud-0' => Crud0Controller::class,
        'crud' => CrudController::class,
        'crud-2' => Crud2Controller::class,
        'crud-3' => Crud2Controller::class,

        // CRUD With Advance Validation -> app/Http/Requests/FolderName/RequestName.php
        

    ]);
});
