<?php

use Illuminate\Support\Facades\Route;
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

//affiche le formulaire
Route::get('/post/create',[PostController::class,'create']);
//récupère les infos du post et les envoie dans la BDD
Route::post('/post/create',[PostController::class,'store']);

//GET UPDATE DELETE (pour les details d'un POST IMAGE)