<?php

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

use Illuminate\Support\Facades\Route;

Route::prefix('map')->group(function () {
    Route::get('/', 'MapController@index');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin/map')->as('admin.map.')->group(function () {
        Route::get('/', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'index'])
             ->name('index');
        Route::get('/{marker}/show', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'show'])
             ->name('show');
        Route::get('/create', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'create'])
             ->name('create');
        Route::post('/store', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'store'])
             ->name('store');
        Route::get('/{marker}/edit', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'edit'])
             ->name('edit');
        Route::post('/{marker}/update', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'update'])
             ->name('update');
        Route::post('/destroy/{marker}', [\Modules\Map\Http\Controllers\Admin\MapController::class, 'destroy'])
             ->name('destroy');
    });
});
