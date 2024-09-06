<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController ;
use App\Http\Controllers\Dashboard\{DashboardController , UserController , PlaceController , TripController , OwnerCompanyController , CompanyController , HotelController , RoomController};


Route::middleware('guest')->group(function (){

    Route::get('login/{type}' , [LoginController::class , 'create'])->name('create.login');
    Route::post('login' , [LoginController::class , 'checklogin'])->name('login');
});
Route::get('logout/{type}', [LoginController::class , 'logout'])->name('logout') ;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:admin' ]
],function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

        // ================== Owners ====================
        Route::resource('owners', OwnerCompanyController::class);

        // ================== Users ====================
        Route::resource('users', UserController::class);

        // ================== Companies =================
        Route::resource('companies', CompanyController::class);
        Route::get('company/payments', [CompanyController::class , 'payments'])->name('company.payments');


        // =================== Places ===================
        Route::resource('places', PlaceController::class);

        // =================== Trips ====================
        Route::resource('trips', TripController::class);

        // =================== Hotels ====================
        Route::resource('hotels', HotelController::class);

        // =================== Rooms of hotel ============
        Route::resource('rooms', RoomController::class);

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
