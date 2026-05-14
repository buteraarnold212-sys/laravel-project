<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return view('home');
});

Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);
Route::resource('borrowings', BorrowingController::class);

