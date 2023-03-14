<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\kelasController;
use App\http\Controllers\siswaController;
use App\http\Controllers\bukuController;
use App\http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
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



//login

    
//     Route::post('/register',[UserController::class,'register']);
// Route::post('/login', [UserController::class,'login']);
// Route::group(['middleware' => ['jwt.verify']], function (){



//siswa
Route::get('/getsiswa',[siswaController::class,'getsiswa']);
Route::get('/getsiswa/{id}',[siswaController::class,'getsemuasiswa']);
Route::post('/createsiswa',[siswaController::class,'createsiswa']);
Route::put('/updatesiswa/{id}',[siswaController::class,'updatesiswa']);
Route::delete('/deletesiswa/{id}',[siswaController::class,'deletesiswa']);
//kelas
Route::get('/getkelas',[kelasController::class,'getkelas']);
Route::get('/getkelas/{id}',[kelasController::class,'getsemuakelas']);
Route::post('/createkelas',[kelasController::class,'createkelas']);
Route::put('/updatekelas/{id}',[kelasController::class,'updatekelas']);
Route::delete('/deletekelas/{id}',[kelasController::class,'deletekelas']);
//buku
Route::get('/getbuku',[bukuController::class,'getbuku']);
Route::get('/getbuku/{id}',[bukuController::class,'getsemuabuku']);
Route::post('/createbuku',[bukuController::class,'createbuku']);
Route::put('/updatebuku/{id}',[bukuController::class,'updatebuku']);
Route::delete('/deletebuku/{id}',[bukuController::class,'deletebuku']);
//peminjaman
Route::get('/getpeminjaman/{id}',[peminjamanController::class,'getpeminjaman']);
Route::get('/getpeminjaman',[peminjamanController::class,'getsemuapeminjaman']);
Route::post('/createpeminjaman',[peminjamanController::class,'createpeminjaman']);
Route::put('/updatepeminjaman',[peminjamanController::class,'updatepeminjaman']);
Route::put('/updatepeminjaman/{id}',[peminjamanController::class,'kembalipeminjaman']);
Route::delete('/deletepeminjaman/{id}',[peminjamanController::class,'deletepeminjaman']);
// });
?>
