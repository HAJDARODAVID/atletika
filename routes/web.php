<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function(){
    return "im in";
});

Route::prefix('/adm')
    ->group(function(){
        Route::controller(DashboardController::class)
            ->group(function(){
                Route::get('/','index');
            });
        
        Route::controller(CategoryController::class)
            ->group(function(){
                Route::get('/category_editor', 'categoryEditor')->name('categoryEditor');
                Route::post('/category_editor/year', 'addNewYear')->name('addNewYear');
                Route::post('/category_editor/discipline','addNewDiscipline')->name('addNewDiscipline');
            });
    });
