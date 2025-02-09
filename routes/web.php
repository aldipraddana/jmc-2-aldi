<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomingItemController;
use App\Http\Controllers\ItemHeaderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserManagementController;
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
    return redirect()->route('incoming.items');
})->middleware('auth');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/incoming-items', [IncomingItemController::class, 'index'])->name('incoming.items');
    Route::get('/incoming-items/create', [IncomingItemController::class, 'create'])->name('incoming.items.create');
    Route::get('/incoming-items/pdf/{headerId}', [IncomingItemController::class, 'pdf'])->name('incoming.items.pdf');
    Route::post('/incoming-items', [IncomingItemController::class, 'store'])->name('incoming.items.store');
    Route::delete('/incoming-items/{id}', [IncomingItemController::class, 'destroy'])->name('incoming.items.destroy');
    Route::put('/incoming-items/update-status/{id}', [IncomingItemController::class, 'updateStatusItem'])->name('incoming.items.update.status');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('sub-category');
    Route::post('/sub-category', [SubCategoryController::class, 'store'])->name('sub-category.store');
    Route::put('/sub-category/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
    Route::delete('/sub-category/{id}', [SubCategoryController::class, 'destroy'])->name('sub-category.destroy');
    Route::get('/sub-category/category/{categoryId}', [SubCategoryController::class, 'subCategoryByCategoryId']);

    Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
    Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
    Route::put('/user-management/{id}', [UserManagementController::class, 'update'])->name('user-management.update');
    Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
    Route::post('/user-management/lock/{id}', [UserManagementController::class, 'lock'])->name('user-management.lock');
});

require __DIR__.'/auth.php';
