<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Features\SupportFileUploads\FileUploadController;

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

Route::view( '/', 'welcome' )->name( 'home' );
Route::view( '/about', 'about' )->name( 'about' );
Route::view( '/contact', 'contact' )->name( 'contact' );
Route::view( '/veterinary-science', 'veterinary-science' )->name( 'veterinary-science' );
Route::view( '/agriculture-science', 'agriculture-science' )->name( 'agriculture-science' );
Route::view( '/fee-structure', 'fee-structure' )->name( 'fee-structure' );

Route::get( '/front-gallery', [ HomeController::class, 'frontGallery' ] )->name( 'front-gallery' );
Route::get( '/auth-redirect', [ HomeController::class, 'redirects' ] )->name( 'redirects' );
Route::get( '/showEvent/{event:slug}', [ HomeController::class, 'showEvent' ] )->name( 'event.show' );
Route::post( '/contact', [ HomeController::class, 'submitForm' ] )->name( 'contact.submit' );
Route::get( '/merit-list', [ HomeController::class, 'MeritList' ] )->name( 'merit-list' );
Route::get( '/admission-challan', function(){
  return view('hostel-first-year');
} );
Route::get( '/download', function(){
  return view('download');
} )->name('download');
Route::group( [ 'middleware' => [ 'auth' ] ], function() {
  Route::view( 'admin/roles', 'admin.roles' )->name( 'roles' )->middleware( 'can:manage roles' );
  Route::view( 'admin/users', 'admin.users' )->name( 'users' )->middleware( 'can:manage users' );
  Route::view( 'admin/registered-users',
    'admin.registeredUsers' )->name( 'registeredUsers' )->middleware( 'can:manage users' );
  Route::view( 'admin/slides', 'admin.slides' )->name( 'slides' )->middleware( 'can:manage slides' );
  Route::view( 'admin/gallery', 'admin.gallery' )->name( 'gallery' )->middleware( 'can:manage gallery' );
  Route::view( 'admin/students', 'admin.students' )->name( 'students' )->middleware( 'can:manage students' );
  Route::view( 'admin/events', 'admin.events' )->name( 'events' )->middleware( 'can:manage events' );
  Route::view( 'admin/projects', 'admin.projects' )->name( 'projects' )->middleware( 'can:manage projects' );
  Route::view( 'admin/taxonomies', 'admin.taxonomies' )->name( 'taxonomies' )->middleware( 'can:manage taxonomies' );
  
  Route::view( 'admin/merit-lists',
    'admin.merit-lists' )->name( 'merit-lists' )->middleware( 'can:generate merit-list' );
  Route::view( 'admin/applications',
    'admin.applications' )->name( 'applications' )->middleware( 'can:manage applications' );
  Route::view( 'profile', 'student.profile' )->name( 'profile' );
  Route::view( 'education', 'student.education' )->name( 'education' );
  Route::view( 'apply', 'student.apply' )->name( 'apply' );
  Route::view( 'apply', 'student.apply' )->name( 'apply' );
  Route::get( 'student-card/{user}', [ HomeController::class, 'studentCard' ] )->name( 'student-card' );
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

