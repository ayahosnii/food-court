<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\LoginComponent;
use App\Http\Livewire\MainCategoryComponent;
use App\Http\Livewire\MealsComponent;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\RegisterComponent;
use App\Http\Livewire\RegisterController;
use App\Http\Livewire\ReservationComponent;
use App\Http\Livewire\RestaurantComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\TermsConditionsComponent;
use App\Http\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/data-deletion-request', [AuthController::class, 'submitDataDeletionRequest'])->name('submit-data-deletion-request');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

Route::get('/login', LoginComponent::class)->name('login');
Route::get('/register', RegisterComponent::class)->name('register');
Route::post('login', [LoginController::class, 'login'])->name('post.login');
Route::post('register', [LoginController::class, 'register'])->name('post.register');
############################## Login by Social Media ##############################

Route::get('/', HomeComponent::class)->name('home');
Route::get('/reservation', ReservationComponent::class)->name('reservation');
Route::get('/meals', MealsComponent::class)->name('meals');
Route::get('/meal/{slug}', DetailsComponent::class)->name('meals.details');
Route::get('/main-category/{slug}', MainCategoryComponent::class)->name('main.category');
Route::get('/restaurant/{slug}', RestaurantComponent::class)->name('restaurant.details');
Route::get('/blog', BlogComponent::class)->name('blog');
Route::get('/contact-us', ContactComponent::class)->name('contact');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/search', SearchComponent::class)->name('meal.search');
//Route::get('/payments/verify/{payment?}',[FrontController::class,'payment_verify'])->name('payment-verify');
Route::get('/fawry',[PaymentController::class,'payWithFawryView'])->name('payment-verify');
Route::get('/verify-payment', [PaymentController::class,'verifyWithFawry'])->name('verify-payment');

    Route::group( ['middleware' => 'auth' ], function() {

        Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
        Route::get('/conversations/create', [ConversationController::class, 'create'])->name('conversations.create');
        Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');

        Route::get('/checkout', CheckoutComponent::class)->name('checkout');
    });

Route::get('/privacy-policy', PrivacyPolicyComponent::class)->name('privacy.policy');
Route::get('/terms-conditions', TermsConditionsComponent::class)->name('terms.conditions');

Auth::routes();

});
