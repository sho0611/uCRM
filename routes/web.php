<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AnalysisControler;
use App\Http\Controllers\GamesController;
use App\Models\Customer;
use App\Models\Games;
use App\Models\Item;
use App\Http\Controllers\GameCustomerController;
use App\Http\Controllers\GamePurchaseController;
use App\Models\gamePurchase;
use App\Http\Controllers\GameAnalysisControler;

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
//items ....... items.index › ItemController@index
Route::resource('items', ItemController::class)
->middleware('auth', 'verified');

Route::get('/items/{item}', [ItemController::class, 'show'])->name('item.show');

Route::resource('customers', CustomerController::class)
->middleware('auth', 'verified');

Route::resource('purchases', PurchaseController::class)
->middleware('auth', 'verified');

Route::resource('games', GamesController::class)
->middleware('auth', 'verified');

Route::get('analysis', [AnalysisControler::class, 'index'])->name('analysis');

Route::get('/items/{item}', [ItemController::class, 'show'])->name('item.show');

Route::resource('gameCustomers', GameCustomerController::class)
->middleware(['auth', 'verified']);

Route::resource('gamepurchase', GamePurchaseController::class)
->middleware(['auth', 'verified']);

Route::get('gameanalysis', [GameAnalysisControler::class, 'index'])->name('gameanalysis');
//gameanalysis
//GameAnalysisControler









Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
