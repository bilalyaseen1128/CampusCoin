<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('categories', function () {
    return view('categories');
});

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('budget-goal', function () {
    return view('budget-goal');
});

Route::get('income-expense', function () {
    return view('income-expense');
});

Route::get('profile', function () {
    return view('profile');
});

Route::get('reports-insights', function () {
    return view('reports-insights');
});

Route::get('saving-tips', function () {
    return view('saving-tips');
});

Route::get('admin', function () {
    return view('admin');
});

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('register', function () {
    return view('register');
})->name('register');