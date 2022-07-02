<?php

use App\Http\Controllers\slr\CustomerController;
use App\Http\Controllers\slr\InvoiceController;
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
    $customers = \App\Models\Customer::all();
    return view('welcome', compact('customers'));
})->name('home');;

// ItemCategory Routes
Route::get('categories', [ItemCategoryController::class, 'index'])->name('categories');
Route::post('category/add', [ItemCategoryController::class, 'add'])->name('add.category');

// Item Routes
Route::get('items', [ItemController::class, 'index'])->name('items');
Route::get('items/get', [ItemController::class, 'getItems'])->name('getItems');
Route::post('item/add', [ItemController::class, 'add'])->name('add.item');

// Area Routes
Route::get('areas', [AreaController::class, 'index'])->name('areas');
Route::post('area/add', [AreaController::class, 'add'])->name('add.area');

// Customer Routes
Route::get('customers', [CustomerController::class, 'index'])->name('customers');
Route::post('customer/add', [CustomerController::class, 'add'])->name('add.customer');

// Invoice Routes
Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::post('invoice/create', [InvoiceController::class, 'create'])->name('create.invoice');
Route::get('invoice/{id}', [InvoiceController::class, 'invoice'])->name('invoice');
Route::post('invoice/{id}/addItem', [InvoiceController::class, 'addItem'])->name('addItem.invoice');
Route::get('invoice/{id}/deleteItem/{invoiceItemId}', [InvoiceController::class, 'deleteItem'])
    ->name('deleteItem.invoice');
Route::get('invoice/{id}/print', [InvoiceController::class, 'print'])->name('print.invoice');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
