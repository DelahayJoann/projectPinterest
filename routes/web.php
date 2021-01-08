<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profils/create',[ProfilController::class,'create']);//->middleware(['auth']);

Route::post('/profils/create',[ProfilController::class,'store']);//->middleware(['auth']);

Route::get('/profils/show/{id}',[ProfilController::class,'show']);//->middleware(['auth']);

Route::get('/profils/edit/{id}',[ProfilController::class,'edit']);//->middleware(['auth']);

Route::patch('/profils/edit/{id}', [ProfilController::class,'update']);//->middleware(['auth']);

Route::get('/profils/destroy/{id}', [ProfilController::class,'destroy']);//->middleware(['auth']);

Route::get('/profils', [ProfilController::class,'index']);//->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//affiche le formulaire
Route::get('/post/create',[PostController::class,'create']);
//récupère les infos du post et les envoie dans la BDD
Route::post('/post/create',[PostController::class,'store']);

//affiche un post à la fois par l'id
Route::get('/post/show/{id}', [PostController::class,'show']);

//affiche le formulaire pour modifier un post
Route::get('/post/edit/{id}', [PostController::class,'edit']);
//envoie le post modifié dans la db
Route::patch('/post/edit/{id}', [PostController::class,'update']);

//supprimer le post
Route::delete('/post/delete/{id}', [PostController::class,'destroy']);
