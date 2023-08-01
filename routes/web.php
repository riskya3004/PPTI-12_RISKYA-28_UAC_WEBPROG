<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\AvatarSubmissionController;
use App\Http\Controllers\CasualFriendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CoinTopUpController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/', [CasualFriendController::class, 'index']);

Route::get('/register', function () {
    return view('register'); 
});

Route::get('/register', [CasualFriendController::class, 'register']);
Route::post('/register', [CasualFriendController::class, 'store']);

// Rute untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/process-payment', [PaymentController::class, 'processPayment']);

Route::get('/profile', [UserController::class, 'showProfile'])
    ->name('user.profile')
    ->middleware('auth.redirect'); 


// Rute untuk mengupdate profil pengguna
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

// Rute untuk menghapus foto profil pengguna
Route::delete('/profile/photo', [UserController::class, 'deleteProfilePhoto'])->name('profile.photo.delete');

// Tambahkan route untuk mengatur aksi Wishlist
Route::post('/wishlist/{user}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');


Route::post('/chat/send', [ChatController::class, 'sendChat'])->name('chat.send');
Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/filter', [HomeController::class, 'filterByGender'])->name('home.filter');
Route::get('/home/filter', [HomeController::class, 'filterByGenderAndSearch'])->name('home.filter');

Route::get('/avatars', [AvatarController::class, 'index'])->name('avatars.index');
Route::post('/avatars/{avatar}', [AvatarController::class, 'purchase'])->name('avatars.purchase');

Route::get('/top-up-koin', [CoinTopUpController::class, 'topUp'])->name('top-up.koin');

Route::get('/send-avatar', [AvatarSubmissionController::class, 'showForm'])->name('send.avatar.form');
Route::post('/send-avatar', [AvatarSubmissionController::class, 'submitAvatar'])->name('send.avatar.submit');

Route::get('/collectors-angels', [CollectorsAngelsController::class, 'showSubmissions'])->name('collectors.angels');

Route::group(['middleware' => 'auth'], function () {
    // routes lainnya
    Route::post('/settings/hide-from-home', [SettingsController::class, 'hideFromHome'])->name('settings.hide_from_home');
    Route::post('/settings/set-random-bear-photo', [SettingsController::class, 'setRandomBearPhoto'])->name('settings.set_random_bear_photo');
});
