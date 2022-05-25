<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
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


Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/search/provinces', [APIController::class, 'searchProvince'])->name('province.search');
    Route::get('/search/cities', [APIController::class, 'searchCity'])->name('city.search');
});

Route::get('/swab/search/provinces', [APIController::class, 'swabSearchProvince'])->name('swab.search.province');
Route::get('/swab/search/cities', [APIController::class, 'swabSearchCity'])->name('swab.search.city');
Route::get('/province/import', [APIController::class, 'importProvince'])->name('province.import');
Route::get('/city/import', [APIController::class, 'importCity'])->name('city.import');
