<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\Back\AdminPanelController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\ShopCartController;
use App\Http\Controllers\Front\SingleController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/product/{id}', [SingleController::class, 'index'])->name('single');
Route::post('/comment/{id}', [SingleController::class, 'comment'])->name('single.comment');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/add', [ContactController::class, 'addContact'])->name('contact.add');

Route::get('/register', [AuthManager::class, 'register'])->name('register');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::middleware(isUser::class)->group(function () {

    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout.stepone');
    Route::post('/payout', [CheckOutController::class, 'payout'])->name('checkout.steptwo');

    Route::get('/shop-cart', [ShopCartController::class, 'index'])->name('shop.cart');
    Route::post('/shop-cart/add', [ShopCartController::class, 'addCart'])->name('shop.cart.add');
    Route::get('/shop-cart/delete/{id}', [ShopCartController::class, 'deleteCart'])->name('shop.cart.delete');

    Route::get('/my-orders', [ProfileController::class, 'orders'])->name('my.orders');
    Route::get('/my-orders/delete/{id}', [ProfileController::class, 'orderCancel'])->name('my.orders.delete');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/comment/delete/{commentId}', [SingleController::class, 'deleteComment'])->name('single.comment.delete');

    Route::get('/logout', [AuthManager::class, 'logOut'])->name('logout');
});

Route::middleware(isAdmin::class)->prefix('admin')->group(function () {

    Route::get('/panel', [AdminPanelController::class, 'index'])->name('panel');

    Route::get('/hero', [AdminPanelController::class, 'hero'])->name('hero');
    Route::post('/hero', [AdminPanelController::class, 'heroUpdate'])->name('hero.update');
    Route::get('/footer', [AdminPanelController::class, 'footer'])->name('footer');
    Route::post('/footer', [AdminPanelController::class, 'footerUpdate'])->name('footer.update');

    Route::get('/parallax', [AdminPanelController::class, 'parallax'])->name('parallax');
    Route::post('/parallax', [AdminPanelController::class, 'parallaxUpdate'])->name('parallax.update');

    Route::get('/books', [AdminPanelController::class, 'books'])->name('books');
    Route::get('/books/update/{id}', [AdminPanelController::class, 'update'])->name('books.update');
    Route::get('/books/create', [AdminPanelController::class, 'create'])->name('books.create');
    Route::get('/books/delete/{id}', [AdminPanelController::class, 'bookDelete'])->name('books.delete');
    Route::post('/books/update/{id}', [AdminPanelController::class, 'bookUpdate'])->name('books.reupdate');
    Route::post('/books/create', [AdminPanelController::class, 'addBook'])->name('books.add');

    Route::get('/orders', [AdminPanelController::class, 'orders'])->name('orders');
    Route::get('/order/cancel/{id}', [AdminPanelController::class, 'orderCancel'])->name('order.cancel');

    Route::get('/comments', [AdminPanelController::class, 'comments'])->name('comments');
    Route::get('/comment/delete/{id}', [AdminPanelController::class, 'commentDelete'])->name('comment.delete');

    Route::get('/users', [AdminPanelController::class, 'users'])->name('users');
    Route::get('/users/delete/{id}', [AdminPanelController::class, 'userDelete'])->name('users.delete');

});
