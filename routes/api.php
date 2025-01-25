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
    
    // Buku-Kategori API Routes
    Route::controller(BukuKategoriController::class)->group(function () {
        // Assign categories to book
        Route::post('buku/{buku}/kategori', 'assignCategories');
        
        // Remove category from book
        Route::delete('buku/{buku}/kategori/{kategori}', 'removeCategory');
        
        // Get categories for a book
        Route::get('buku/{buku}/kategori', 'getCategories');
        
        // Get books by category
        Route::get('kategori/{kategori}/books', 'getBooksByCategory');
    });
});
