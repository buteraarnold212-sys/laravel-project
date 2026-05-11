<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer; // Import the Customer model


Route::get('/customers', function () {

    $customers = Customer::all(); // Retrieve all customers from the database

    return view('customers.index', compact('customers')); // Pass the customers data to the view

});



