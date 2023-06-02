<?php

use App\Http\Controllers\Admin\PollController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/pay', [\App\Http\Controllers\PayController::class, 'index'])->name('pay');

Route::get('/poll/{poll}/vote', [\App\Http\Controllers\PollController::class, 'vote'])->name('poll-vote');
Route::post('/poll/{poll}/store-vote', [\App\Http\Controllers\PollController::class, 'store'])->name('poll-vote-store');
Route::get('/poll/{poll}/show-votes', [\App\Http\Controllers\PollController::class, 'show'])->name('poll-show-votes');
Route::get('/poll/{poll}/data', [\App\Http\Controllers\PollController::class, 'data'])
    ->name('poll-votes-data');

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name("home");
    Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name("about");
    Route::get('/country', [\App\Http\Controllers\CountryController::class, 'index'])->name('country.index');
    Route::get('/country-search/{query?}', [\App\Http\Controllers\CountryController::class, 'search'])
         ->name('country-search');

    Route::prefix('category')->as('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
             ->name('index');
        Route::get('/{category}/show', [CategoryController::class, 'show'])
             ->name('show');
        Route::get('/create', [CategoryController::class, 'create'])
             ->name('create');
        Route::post('/store', [CategoryController::class, 'store'])
             ->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])
             ->name('edit');
        Route::post('/{category}/update', [CategoryController::class, 'update'])
             ->name('update');
        Route::post('/category/{category}', [CategoryController::class, 'destroy'])
             ->name('destroy');
    });

    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])
             ->name('index');
        Route::get('/{product}/show', [ProductController::class, 'show'])
             ->name('show');
        Route::get('/create', [ProductController::class, 'create'])
             ->name('create');
        Route::post('/store', [ProductController::class, 'store'])
             ->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])
             ->name('edit');
        Route::post('/{product}/update', [ProductController::class, 'update'])
             ->name('update');
        Route::post('/product/{product}', [ProductController::class, 'destroy'])
             ->name('destroy');
    });

    Route::prefix('poll')->as('poll.')->group(function () {
        Route::get('/', [PollController::class, 'index'])
             ->name('index');
        Route::get('/{poll}/show', [PollController::class, 'show'])
             ->name('show');
        Route::get('/create', [PollController::class, 'create'])
             ->name('create');
        Route::post('/store', [PollController::class, 'store'])
             ->name('store');
        Route::get('/{poll}/edit', [PollController::class, 'edit'])
             ->name('edit');
        Route::post('/{poll}/update', [PollController::class, 'update'])
             ->name('update');
        Route::post('/destroy/{poll}', [PollController::class, 'destroy'])
             ->name('destroy');
        Route::post('/destroy-variant/{poll}/{variant}', [PollController::class, 'destroyVariant'])
             ->name('destroy-variant');
        Route::post('/variant-store/{poll}', [PollController::class, 'storeVariant'])
             ->name('store-variant');
    });
});




