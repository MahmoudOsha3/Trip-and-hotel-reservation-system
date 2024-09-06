<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\{HomeController , TripController , HotelController } ;
use App\Http\Controllers\Auth\RegisteredUserController ;

// ================== Login and Register ===============
Route::get('/selection', function () {
    return view('welcome');
})->name('welcome');

Route::get('register' , [RegisteredUserController::class ,'create' ])->name('user.register');
Route::post('register' , [RegisteredUserController::class ,'store' ])->name('register');


//================= Website route ================
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function () {

//=================== Home page ===============
Route::get('/', [ HomeController::class, 'index'])->name('home');
//================== create company ======================
Route::get('create/company' , [HomeController::class , 'createCompany'])->name('create.company') ;
Route::post('create/company' , [HomeController::class , 'storeCompany'])->name('store.company') ;



//====================== Trips =================
Route::controller(TripController::class)->group(function(){
    Route::get('trip/places' , 'getAllPlaces')->name('places.trips');
    Route::get('trip/place/{place_id}', 'getAllTripsUsingPlace')->name('city.trips') ;
    Route::get('company/{company_id}/trips', 'getAllTripsOfCompany')->name('company.trips');
    Route::get('/trips/{trip_id}', 'getDetailsAboutTrip')->name('details.trip');

    // booking and payment
    Route::middleware('auth')->group(function () {
        Route::get('checkout/{trip_id}' , 'checkout')->name('checkout') ;
        Route::post('payment/{trip_id}', 'payment')->name('payment') ;
    });

});

// ==================== Hotel ===================
Route::controller(HotelController::class)->group(function(){

    Route::get('hotels', 'getAllHotels')->name('all.hotels');
    Route::get('hotel/{hotel_id}', 'getAllDetailsOfHotel')->name('details.hotel');
    Route::get('hotel/room/{room_id}', 'getAllDetailsOfRoom')->name('details.room');
    Route::post('hotel/room/check-availability', 'checkAvailabilityRoom')->name('check.availability');

    // booking and payment
    Route::middleware('auth')->group(function () {
        Route::get('hotel/checkout/{room_id}' , 'checkout')->name('room.checkout') ;
        Route::post('hotel/payment/{room_id}', 'payment')->name('room.payment') ;
    });
});

    Route::middleware('auth')->group(function () {
        Route::get('tickets',[HomeController::class , 'tickets'] )->name('tickets');
    });

});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
