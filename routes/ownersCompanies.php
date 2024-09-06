<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController ;
use App\Http\Controllers\Company\TripsCompany\Trip\{TripController , TicketsController};
use App\Http\Controllers\Company\HotelCompany\Hotel\{HotelController , RoomController , BookingHotelController };
use App\Http\Controllers\Company\DashboardController ;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:owner_company' ]
],function () {

    Route::prefix('owner')->group(function () {

        Route::get('dashboard', [DashboardController::class , 'index'])->name('owner.dashboard');

        // =================== Trips ==================
        Route::resource('trip', TripController::class);
        Route::post('trip/toggle/status/{trip_id}', [TripController::class , 'toggleStatusBooking'])->name('toggle.status.booking');
        Route::get('payments', [TripController::class , 'payments'])->name('trip.payments');


        // =================== Tickets ==================
        Route::resource('tickets', TicketsController::class);

        // ==================== Hotels =================
        Route::resource('hotel', HotelController::class ) ;
        Route::get('company/hotel/payments', [HotelController::class , 'payments'])->name('hotel.payments');

        // ==================== Rooms =================
        Route::resource('room', RoomController::class);

        // ==================== Booking ===============
        Route::resource('booking', BookingHotelController::class);

    });




});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth:admin', 'verified'])->name('dashboard');

// Route::middleware('auth:admin')->group(function () {

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// });

require __DIR__.'/auth.php';
