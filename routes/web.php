<?php

use App\Models\Competition;
use App\Models\ApplicationForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ApplicationFormController;

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

Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('myHome');

Route::controller(ApplicationFormController::class)
    ->middleware('auth')
    ->group(function(){
        Route::get('/application/{competition}', 'application')->name('application');
        //Route::get('/show_application/{app}', 'myApplication')->name('myApplication');
    });



Route::prefix('/adm')
    ->middleware('auth')
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
        Route::controller(ApplicationFormController::class)
            ->group(function(){
                Route::get('/application/{id}', 'showApplication')->name('showApplicationAdm');
            });

        Route::controller(TicketsController::class)
            ->group(function(){
                Route::get('/tickets', 'tickets')->name('tickets');
                Route::post('/tickets', 'newTickets')->name('newTickets');
            });
    });

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function () {
    $comp = Competition::where('id', 4)->first();
    return dd([
        'from' => $comp->from,
        'to' => $comp->to,
        'compare' => date('Y-m-d') >=  $comp->from && date('Y-m-d') <=  $comp->to
    ]);
});
    




