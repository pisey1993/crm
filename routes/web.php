<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClaimOnlineController;


Route::get('/', function () {
    return view('home');
});
Route::get('/client', function () {
    return view('client');
});

// Claims routes
Route::get('/claims/submit', function () {
    return view('online_claims');
})->name('claims.submit');

Route::get('/claims/checker', function () {
    return view('claims_checker');
})->name('claims.checker');

// Policy Finder route
Route::get('/policy-finder', function () {
    return view('policy_finder');
})->name('policy.finder');

// Buy Insurance routes
Route::get('/buy-insurance', function () {
    return view('buynow');
})->name('buy-insurance');

// Request Quote (GET to show form, POST to submit form)
Route::get('/insurance/request-quote', function () {
    return view('request_quote');
})->name('insurance.request-quote');



Route::get('/claims/create', [ClaimOnlineController::class, 'create'])->name('claims.create');
Route::post('/claims/submit', [ClaimOnlineController::class, 'store'])->name('claims.store');



