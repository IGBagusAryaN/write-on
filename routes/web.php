<?php

use App\Http\Controllers\Front\BookDetailController;
use App\Http\Controllers\Front\HomePageController;
use App\Http\Controllers\Member\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'index'])->name('baca');
Route::get('/category/{slug}', [HomePageController::class, 'byCategory'])->name('baca-category');


Route::get('/detail-book', function () {
    return view('components.front.detail-book');
})->name('detail-book');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Blog
    // Route::get('/member/books', [BlogController::class, 'index']);
    // Route::get('/member/books/{post}/edit', [BlogController::class, 'edit']);

 Route::resource('/members/books', BlogController::class)
    ->parameters(['books' => 'post']) // ini penting
    ->names([
        'index'=> 'member.books.index',
        'edit' => 'member.books.edit',
        'update' => 'member.books.update',
        'create' => 'member.books.create',
        'store' => 'member.books.store',
        'destroy' => 'member.books.destroy',
    ]);

});

require __DIR__.'/auth.php';

Route::get('/{slug}', [BookDetailController::class, 'detail'])->name('book-detail');