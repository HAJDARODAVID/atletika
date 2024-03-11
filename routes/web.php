<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompetitionController;

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
    return view('application');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function(){
    return "USPEL SI ŽBRGLJO";
})->name('saveTeamApplication');

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
        Route::controller(CompetitionController::class)
            ->group(function(){
                Route::get('/competitions', 'competitions')->name('competitions');
                Route::get('/competition/{id}', 'competition')->name('competition');
            });
    });

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";

});
    




