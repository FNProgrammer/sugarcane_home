<?php

use Illuminate\Support\Facades\Route;

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



Route::prefix('admin')->group(function (){
//admin route
    Route::get('/',[\App\Http\Controllers\Admin\PanelController::class,'index']);

//Create position
    Route::get('/',[\App\Http\Controllers\Admin\PanelController::class,'index'])->name('admin.dashboard');
    Route::resource('/positions',\App\Http\Controllers\Admin\PositionController::class);
    Route::get('/search_positions',[\App\Http\Controllers\Admin\PositionController::class,'searchPosition'])->name('search.positions');
    Route::resource('/home_kinds',\App\Http\Controllers\Admin\HomeKindController::class);
    Route::get('/search_home_kinds',[\App\Http\Controllers\Admin\HomeKindController::class,'searchHomeKind'])->name('search.home_kinds');

    Route::resource('/companies',\App\Http\Controllers\Admin\CompanyController::Class);

    Route::get('/search_companies',[\App\Http\Controllers\Admin\CompanyController::class,'searchCompany'])->name('search.companies');
    Route::resource('/home_prices',\App\Http\Controllers\Admin\HomePriceController::Class);

    Route::get('/search_home_prices',[\App\Http\Controllers\Admin\HomePriceController::class,'searchHomePrice'])->name('search.home_prices');

    Route::resource('/homes',\App\Http\Controllers\Admin\HomeController::Class);
    Route::get('/search_homes',[\App\Http\Controllers\Admin\HomeController::class,'searchHome'])->name('search.homes');
    Route::resource('/employees',\App\Http\Controllers\Admin\EmployeeController::Class);
    Route::get('/search_employees',[\App\Http\Controllers\Admin\EmployeeController::class,'searchEmployee'])->name('search.employees');
    Route::resource('/contracts',\App\Http\Controllers\Admin\ContractController::Class);
    Route::get('/search_contracts',[\App\Http\Controllers\Admin\ContractController::class,'searchContract'])->name('search.contracts');
    Route::get('/contract-exel',[\App\Http\Controllers\Admin\ContractController::class,'exportExel'])->name('contract.exel');
});



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
