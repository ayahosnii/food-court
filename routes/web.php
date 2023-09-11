<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\LoginComponent;
use App\Http\Livewire\MealsComponent;
use App\Http\Livewire\RegisterComponent;
use App\Http\Livewire\RegisterController;
use App\Http\Livewire\ReservationComponent;
use App\Http\Livewire\RestaurantComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

############################## Login by Social Media ##############################
Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook']);
Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback'])->name('facebook');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google');

Route::get('/login', LoginComponent::class)->name('login');
Route::get('/register', RegisterComponent::class)->name('register');
Route::post('login', [LoginController::class, 'login'])->name('post.login');
Route::post('register', [LoginController::class, 'register'])->name('post.register');
############################## Login by Social Media ##############################

Route::get('/', HomeComponent::class)->name('home');
Route::get('/reservation', ReservationComponent::class)->name('reservation');
Route::get('/meals', MealsComponent::class)->name('meals');
Route::get('/meal/{slug}', DetailsComponent::class)->name('meals.details');
Route::get('/restaurant/{slug}', RestaurantComponent::class)->name('restaurant.details');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Auth::routes();

