<?php

use App\Http\Controllers\slr\ItemCategoryController;
use App\Http\Controllers\slr\ItemController;
use App\Http\Controllers\slr\AreaController;
use Illuminate\Support\Facades\Route;

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

// ItemCategory Controller
Route::get('categories', [ItemCategoryController::class, 'index'])->name('categories');
Route::post('category/add', [ItemCategoryController::class, 'add'])->name('add.category');

// Item Controller
Route::get('items', [ItemController::class, 'index'])->name('items');
Route::post('item/add', [ItemController::class, 'add'])->name('add.item');

// Area Controller
Route::get('areas', [AreaController::class, 'index'])->name('areas');
Route::post('area/add', [AreaController::class, 'add'])->name('add.area');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
