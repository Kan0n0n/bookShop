<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OurInfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
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
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');



Route::get('/explore', [BookController::class, 'create'])->name('book.create');
Route::get('/explore/search', [BookController::class, 'search'])->name('book.search');
Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');

// Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
// Route::post('/book', [BookController::class, 'store'])->name('book.store');
// Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
// Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
// Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
// Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/about', [OurInfoController::class, 'about'])->name('about');
Route::get('/contact', [OurInfoController::class, 'contact'])->name('contact');

//edit account
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/password/edit', [UserController::class, 'editPassword'])->name('user.password.edit');
Route::post('/user/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');


// payment
Route::get('/activate/{id}', [UserController::class, 'activate'])->name('activate');
Route::post('/payment', [UserController::class, 'payment'])->name('user.process.payment');
Route::get('/payment/callback', [UserController::class, 'paymentCallback'])->name('payment.callback');

// borrow
Route::get('/borrow', [UserController::class, 'borrowBook'])->name('borrow');
Route::get('/borrow_list', [UserController::class, 'borrowList'])->name('borrow_list');
Route::get('/borrow/extend/{id}', [UserController::class, 'extendBorrow'])->name('borrow.extend');

// review
Route::post('/review', [ReviewController::class,'create'])->name('review.create');
Route::post('/review/update', [ReviewController::class,'update'])->name('review.update');

// cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// checkout
Route::get('/checkout/{id}', [CartController::class, 'checkoutPage'])->name('checkout');
Route::post('/checkout/{id}/proccess', [CartController::class, 'checkout'])->name('checkout.process');

// admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// admin book
Route::get('/admin/book', [AdminController::class, 'book'])->name('admin.book');
Route::post('/admin/book/create', [AdminController::class, 'createBook'])->name('admin.book.create');
Route::post('/admin/book/update/{id}', [AdminController::class, 'updateBook'])->name('admin.book.update');
Route::post('/admin/book/delete/{id}', [AdminController::class, 'deleteBook'])->name('admin.book.delete');

// admin author
Route::get('/admin/author', [AdminController::class, 'author'])->name('admin.author');
Route::post('/admin/author/create', [AdminController::class, 'createAuthor'])->name('admin.author.create');
Route::post('/admin/author/update/{id}', [AdminController::class, 'updateAuthor'])->name('admin.author.update');
Route::post('/admin/author/delete/{id}', [AdminController::class, 'deleteAuthor'])->name('admin.author.delete');

// admin publisher
Route::get('/admin/publisher', [AdminController::class, 'publisher'])->name('admin.publisher');
Route::post('/admin/publisher/create', [AdminController::class, 'createPublisher'])->name('admin.publisher.create');
Route::post('/admin/publisher/update/{id}', [AdminController::class, 'updatePublisher'])->name('admin.publisher.update');
Route::post('/admin/publisher/delete/{id}', [AdminController::class, 'deletePublisher'])->name('admin.publisher.delete');

// admin category
Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
Route::post('/admin/category/create', [AdminController::class, 'createCategory'])->name('admin.category.create');
Route::post('/admin/category/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
Route::post('/admin/category/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');

// admin user
Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
Route::post('/admin/user/create', [AdminController::class, 'createUser'])->name('admin.user.create');
Route::post('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
Route::post('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

// admin cart
Route::get('/admin/cart', [AdminController::class, 'cart'])->name('admin.cart');
Route::get('/admin/cart/checkout/{id}', [AdminController::class, 'checkout'])->name('admin.cart.checkout');
Route::post('/admin/cart/delete/{id}', [AdminController::class, 'deleteCart'])->name('admin.cart.delete');
Route::get('admin/cart/undoCheckout/{id}', [AdminController::class, 'undoCheckout'])->name('admin.cart.undoCheckout');
Route::get('admin/cart/print/{id}', [AdminController::class, 'printCartReceipt'])->name('admin.cart.print');

// admin borrow
Route::get('/admin/borrow', [AdminController::class, 'borrowBookPage'])->name('admin.borrow');
Route::get('/admin/borrow/return/{id}', [AdminController::class, 'returnBook'])->name('admin.borrow.return');
Route::get('/admin/borrow/returnAll/{id}', [AdminController::class, 'returnAllBook'])->name('admin.borrow.returnAll');
