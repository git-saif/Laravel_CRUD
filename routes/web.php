<?php

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
});

// Route::get('/', function () {
//     return view('components.CRUD.index');
    
// });

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

    Route::resources([

        'crud' => CrudController::class,

    ]);
});
