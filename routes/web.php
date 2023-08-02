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

Route::group( [ 'middleware' => [ 'auth' ] ], function() {
  Route::resource( 'roles', RoleController::class );
  Route::resource( 'users', UserController::class );
  Route::resource( 'products', ProductController::class );
} );

Route::middleware( [
  'auth:sanctum',
  config( 'jetstream.auth_session' ),
  'verified'
] )->group( function() {
  Route::get( '/dashboard', function() {
    return view( 'dashboard' );
  } )->name( 'dashboard' );
} );
