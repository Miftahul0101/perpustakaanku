<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuKategoriController;
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

    Route::apiResource('kategori', KategoriController::class);
    
    
});

// routes/api.php
Route::get('/buku/{buku}/kategoris', function ($bukuId) {
    return BukuKategori::where('buku_id', $bukuId)
        ->pluck('kategori_id');
});