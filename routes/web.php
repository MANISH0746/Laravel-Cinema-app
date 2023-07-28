<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'indexPage'])->name('indexpage');
    Route::get('{id}/singlemovie', [HomeController::class, 'singlemovie'])->name('singlemovie');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// home for dashboards
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
//sadmin access page only//
Route::get('/addmovie', [HomeController::class, 'addmovie'])->middleware(['auth','admin'])->name('addmovie');
Route::get('/movieslist', [HomeController::class, 'movieslist'])->middleware(['auth','admin'])->name('movieslist');
Route::post('/movieslist',[HomeController::class,'createmovie']);
Route::get('{id}/editmovie', [HomeController::class, 'editmovie'])->middleware(['auth','admin'])->name('editmovie');
Route::post('{id}/updatemovie', [HomeController::class, 'updatemovie'])->middleware(['auth','admin']);
Route::get('{id}/deletemovie', [HomeController::class, 'destroy'])->middleware(['auth','admin'])->name('deletemovie');

Route::resource('/categorylist', CategoryController::class);
//admin access page only//


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
