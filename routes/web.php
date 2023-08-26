<?php

use App\Http\Controllers\HomeController;
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

Route::get( '/', [ HomeController::class, 'index' ] )->name( 'home' );
Route::get( '/about', [ HomeController::class, 'about' ] )->name( 'about' );
Route::get( '/contact', [ HomeController::class, 'contact' ] )->name( 'contact' );
Route::get( '/front-gallery', [ HomeController::class, 'frontGallery' ] )->name( 'front-gallery' );
Route::get( '/veterinary-science', [ HomeController::class, 'veterinaryScience' ] )->name( 'veterinary-science' );
Route::get( '/agriculture-science', [ HomeController::class, 'agricultureScience' ] )->name( 'agriculture-science' );
Route::get( '/auth-redirect', [ HomeController::class, 'redirects' ] )->name( 'redirects' );
Route::get( '/showEvent/{event:slug}', [ HomeController::class, 'showEvent' ] )->name( 'event.show' );
Route::post( '/contact', [ HomeController::class, 'submitForm' ] )->name( 'contact.submit' );

Route::group( [ 'middleware' => [ 'auth' ] ], function() {
  Route::get( 'roles', [ HomeController::class, 'roles' ] )->name( 'roles' );
  Route::get( 'users', [ HomeController::class, 'users' ] )->name( 'users' );
  Route::get( 'slides', [ HomeController::class, 'slides' ] )->name( 'slides' );
  Route::get( 'gallery', [ HomeController::class, 'gallery' ] )->name( 'gallery' );
  Route::get( 'students', [ HomeController::class, 'students' ] )->name( 'students' );
  Route::get( 'profile', [ HomeController::class, 'profile' ] )->name( 'profile' );
  Route::get( 'education', [ HomeController::class, 'education' ] )->name( 'education' );
  Route::get( 'apply', [ HomeController::class, 'apply' ] )->name( 'apply' );
  Route::get( 'events', [ HomeController::class, 'events' ] )->name( 'events' );
  Route::get( 'projects',
    [ HomeController::class, 'projects' ] )->name( 'projects' )->middleware( 'can:manage projects' );
  Route::get( 'applications',
    [ HomeController::class, 'applications' ] )->name( 'applications' )->middleware( 'can:manage projects' );
  Route::get( 'print-form/{application}', [ HomeController::class, 'printForm' ] )->name( 'print-form' );
  Route::get( 'print-challan/{application}', [ HomeController::class, 'printChallan' ] )->name( 'print-challan' );
} );

Route::middleware( [
  'auth:sanctum',
  config( 'jetstream.auth_session' ),
  'verified'
] )->group( function() {
  Route::get( '/dashboard', [ HomeController::class, 'dashboard' ] )->name( 'dashboard' );
  Route::get( '/student-dashboard', [ HomeController::class, 'studentDashboard' ] )->name( 'student-dashboard' );
  
} );
