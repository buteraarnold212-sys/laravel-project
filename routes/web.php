<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;



Route::get('/', function () {

    return view('welcome'); 

});



Route::get('/welcome', function() {

    // passing student data to the view from models

        $students = Student::all(); // storing all students data in $students variable
    return view('hello', compact('students')); // passing $students variable to the view hello.blade.php

});

