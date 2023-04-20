<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Auth\SocialiteAuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/oauth/redirect/{driver}', [SocialiteAuthController::class, 'redirect'])->name('socialite.redirect');
Route::get('/oauth/{driver}/callback', [SocialiteAuthController::class, 'callback'])->name('socialite.callback');

Route::get('/', [ListingController::class, 'index'])->name('listings.index');
Route::get('/new', [ListingController::class, 'create'])->name('listings.create');
Route::post('/new', [ListingController::class, 'store'])->name('listings.store');

Route::post('/privacy-policy ', [InformationController::class, 'privacyPolicy'])->name('privacy-policy');
Route::post('/terms-of-use', [InformationController::class, 'termsOfUse'])->name('terms-of-use');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/{listing}/apply', [ListingController::class, 'apply'])->name('listings.apply');
Route::get('/{listing}/remove', [ListingController::class, 'remove'])->name('listings.remove');
Route::get('/{listing}/destroy', [ListingController::class, 'destroy'])->name('listings.destroy');
