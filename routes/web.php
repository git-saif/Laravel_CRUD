<?php

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crud1Controller;
use App\Http\Controllers\Crud2Controller;
use App\Http\Controllers\Crud3Controller;
use App\Http\Controllers\Crud4Controller;
use App\Http\Controllers\Crud5Controller;
use App\Http\Controllers\Crud6Controller;
use App\Http\Controllers\Crud7Controller;
use App\Http\Controllers\Crud8Controller;
use App\Http\Controllers\Crud9Controller;
use App\Http\Controllers\Crud10Controller;
use App\Http\Controllers\CompanyController;

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
        'crud-5' => Crud5Controller::class,
        'crud-6' => Crud6Controller::class,

        // CRUD (Category & Subcategory & Sub-sub-category)
        'crud-7' => Crud7Controller::class,  // Category
        'crud-8' => Crud8Controller::class,  // Sub-category
        'crud-9' => Crud9Controller::class,  // Sub-Sub-Category

        // CRUD (Post)
        'crud-10' => Crud10Controller::class,  // Post

        // Company Settings
        'company' => CompanyController::class,

    ]);
    
    // Ajax endpoint to get subcategories for render subcategories in sub-sub-category create page
    Route::get('crud-9/subcategories/{category}', [Crud9Controller::class, 'getSubcategories'])->name('crud-9.subcategories');

    // Ajax endpoint to get subcategories for a category for Post create page
    Route::get('crud-10/get-subcategories/{categoryId}', [Crud10Controller::class, 'getSubcategories'])->name('crud-10.get-subcategories');

    // Ajax endpoint to get sub-sub-categories for a subcategory for Post create page
    Route::get('crud-10/get-subsubcategories/{subcategoryId}', [Crud10Controller::class, 'getSubSubcategories'])->name('crud-10.get-subsubcategories');

    // image upload for CKEditor (AJAX)
    Route::post('crud-10/upload-image', [Crud10Controller::class, 'uploadImage'])->name('crud-10.uploadImage');
});
