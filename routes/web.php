<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\GoogleSigninController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\RecruiterProfileController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\SeekerProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function (){


    Route::middleware('recruiter')->group(function () {

    Route::get('/dashboardRe', [JobPostController::class, 'index'])->name('dashboardRe');
    Route::resource('jobs',JobPostController::class);
    Route::resource('profile', RecruiterProfileController::class);
    Route::get('/seekers', [RecruiterController::class, 'search'])->name('user.search');

});
    Route::resource('application', ApplicationController::class);
    Route::get('selects/{id}', [ApplicationController::class, 'update'])->name('selected');

    Route::middleware('seeker')->group(function () {
        Route::get('/dashboard', [SeekerController::class, 'index'])->name('dashboard');
        Route::get('/display/{uuid}', [JobPostController::class, 'show'])->name('display');
        Route::resource('profiles', SeekerProfileController::class);
        Route::get('apply/{id}', [ApplicationController::class, 'create'])->name('apply');


    });


});


Route::post('googleIn',[GoogleSigninController::class, 'update'])->name('googleIn');

Route::get('roles',[GoogleSigninController::class, 'create'])->name('create');

Route::post('googles',[GoogleSigninController::class, 'signUpGoogle'])->name('signUp');

Route::get('google',[GoogleSigninController::class, 'getData'])->name('google');

Route::get('SignIn',[GoogleSigninController::class, 'signInGoogle'])->name('signIn');





require __DIR__.'/auth.php';
