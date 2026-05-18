<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Models\Student;
use App\Models\Member;
use App\Models\Book;
use App\Models\Borrowing;

Route::get('/', function () {
    $studentCount = Student::count();
    $memberCount = Member::count();
    $bookCount = Book::count();
    $borrowingCount = Borrowing::count();

    return view('home', compact('studentCount', 'memberCount', 'bookCount', 'borrowingCount'));
})->name('home');

Route::resource('students', StudentController::class);

Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);
Route::resource('borrowings', BorrowingController::class);

