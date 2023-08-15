<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::get( '/auth-redirect', [ HomeController::class, 'redirects' ] )->name( 'redirects' );

Route::group( [ 'middleware' => [ 'auth' ] ], function() {
  Route::get( 'roles', [ HomeController::class, 'roles' ] )->name( 'roles' );
  Route::get( 'users', [ HomeController::class, 'users' ] )->name( 'users' );
  Route::get( 'slides', [ HomeController::class, 'slides' ] )->name( 'slides' );
  Route::get( 'students', [ HomeController::class, 'students' ] )->name( 'students' );
  Route::get( 'profile', [ HomeController::class, 'profile' ] )->name( 'profile' );
  Route::get( 'education', [ HomeController::class, 'education' ] )->name( 'education' );
  Route::get( 'apply', [ HomeController::class, 'apply' ] )->name( 'apply' );
  Route::get( 'projects', [ HomeController::class, 'projects' ] )->name( 'projects' );
} );

Route::middleware( [
  'auth:sanctum',
  config( 'jetstream.auth_session' ),
  'verified'
] )->group( function() {
  Route::get( '/dashboard', [ HomeController::class, 'dashboard' ] )->name( 'dashboard' );
  Route::get( '/student-dashboard', [ HomeController::class, 'studentDashboard' ] )->name( 'student-dashboard' );
  
} );
