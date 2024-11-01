<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OurInfoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/signup', [AuthController::class, 'signUpFoward'])->name('signup');
Route::post('/signup', [AuthController::class, 'signUpFoward'])->name('signup.post');

Route::get('/email/verify', function () {
    return view('auth.verify_email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(route('index'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/login', [AuthController::class, 'signInFoward'])->name('login');
Route::post('/login', [AuthController::class, 'signInFoward'])->name('login.post');

Route::get('/logout', [AuthController::class, 'signOutFoward'])->name('logout');

Route::get('/explore', [BookController::class, 'create'])->name('book.create');
Route::get('/search', [BookController::class, 'search'])->name('book.search');
Route::get('/book', [BookController::class, 'book'])->name('book.book');
// Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
// Route::post('/book', [BookController::class, 'store'])->name('book.store');
// Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
// Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
// Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
// Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/about', [OurInfoController::class, 'about'])->name('about');
Route::get('/contact', [OurInfoController::class, 'contact'])->name('contact');

Route::get('/borrow', [UserController::class, 'borrowBook'])->name('borrow');
Route::get('/borrow_list', [UserController::class, 'borrowList'])->name('borrow_list');
