<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\SiswaController;
use App\http\Controllers\KelasController;
use App\http\Controllers\BukuController;
use App\http\Controllers\PeminjamanController;
use App\http\Controllers\DetailController;
use App\http\Controllers\UserController;

/*
|----------- ---------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class,'register']); 
Route::post('/login', [UserController::class, 'login']); 



Route::group(['middleware' => ['jwt.verify']], function () { 


Route::get('/getsiswa',[SiswaController::class,'getsiswa']);
Route::get('/getsiswa/{id}',[SiswaController::class,'getsatusiswa']);
Route::post('/createsiswa',[SiswaController::class,'createsiswa']);
Route::put('/updatesiswa/{id}',[SiswaController::class,'updatesiswa']);
Route::delete('/deletesiswa/{id}',[SiswaController::class,'deletesiswa']);


Route::get('/getkelas',[KelasController::class,'getkelas']);
Route::post('/createkelas',[KelasController::class,'createkelas']);
Route::put('/updatekelas/{id}',[KelasController::class,'updatekelas']);
Route::delete('/deletekelas/{id}',[KelasController::class,'deletekelas']);


Route::get('/getbuku',[BukuController::class,'getbuku']);
Route::get('/getbuku/{id}',[BukuController::class,'getsatubuku']);
Route::post('/createbuku',[BukuController::class,'createbuku']);
Route::put('/updatebuku/{id}',[BukuController::class,'updatebuku']);
Route::delete('/deletebuku/{id}',[BukuController::class,'deletebuku']);


Route::get('/getpeminjaman/',[PeminjamanController::class,'getpeminjaman']);
Route::get('/getpeminjaman/{id}',[PeminjamanController::class,'getsatupeminjaman']);
Route::post('/createpeminjaman',[PeminjamanController::class,'createpeminjaman']);
Route::put('/kembalipeminjaman/{id}',[PeminjamanController::class,'kembalipeminjaman']);
Route::delete('/deletepeminjaman/{id}',[PeminjamanController::class,'deletepeminjaman']);

}); 



// Route::get('/getdetail',[DetailController::class , 'index']);