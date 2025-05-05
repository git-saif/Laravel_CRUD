<?php

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

        'crud' => CrudController::class,
        'crud-2' => Crud2Controller::class,

    ]);
});
