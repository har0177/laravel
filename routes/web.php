<?php
		
		use App\Http\Controllers\HomeController;
		use App\Livewire\ApplicationList;
		use App\Livewire\ContentList;
		use App\Livewire\EmployeeList;
		use App\Livewire\GalleryList;
		use App\Livewire\Merit;
		use App\Livewire\NewsEventsList;
		use App\Livewire\ProjectList;
		use App\Livewire\RegisteredUsers;
		use App\Livewire\RoleList;
		use App\Livewire\SlideList;
		use App\Livewire\StudentList;
		use App\Livewire\TaxonomyList;
		use App\Livewire\UserList;
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
		Route::get( '/course-content/{content:slug}', [ HomeController::class, 'courseContent' ] )->name( 'course-content' );
/*Route::get( '/admission-challan', function(){
  return view('hostel-first-year');
} );*/
/*Route::get( '/download', function(){
  return view('download');
} )->name('download');*/
Route::group( [ 'middleware' => [ 'auth' ] ], function() {
		Route::get( 'admin/roles', RoleList::class )->name( 'roles' )->middleware( 'can:manage roles' );
		Route::get( 'admin/users', UserList::class )->name( 'users' )->middleware( 'can:manage users' );
		Route::get( 'admin/registered-users',
				RegisteredUsers::class )->name( 'registeredUsers' )->middleware( 'can:manage users' );
		Route::get( 'admin/slides', SlideList::class )->name( 'slides' )->middleware( 'can:manage slides' );
		Route::get( 'admin/gallery', GalleryList::class )->name( 'gallery' )->middleware( 'can:manage gallery' );
		Route::get( 'admin/students', StudentList::class )->name( 'students' )->middleware( 'can:manage students' );
		Route::get( 'admin/events', NewsEventsList::class )->name( 'events' )->middleware( 'can:manage events' );
		Route::get( 'admin/projects', ProjectList::class )->name( 'projects' )->middleware( 'can:manage projects' );
		Route::get( 'admin/taxonomies', TaxonomyList::class )->name( 'taxonomies' )->middleware( 'can:manage taxonomies' );
		Route::get( 'admin/employees', EmployeeList::class )->name( 'employees' )->middleware( 'can:manage employees' );
		Route::get( 'admin/contents', ContentList::class )->name( 'contents' )->middleware( 'can:manage contents' );
		Route::get( 'admin/merit-lists', Merit::class )->name( 'merit-lists' )->middleware( 'can:generate merit-list' );
		Route::get( 'admin/applications',
				ApplicationList::class )->name( 'applications' )->middleware( 'can:manage applications' );
		Route::get( 'profile', \App\Livewire\StudentProfile::class )->name( 'profile' );
		Route::get( 'education', \App\Livewire\StudentEducation::class )->name( 'education' );
		Route::get( 'apply', \App\Livewire\StudentApply::class )->name( 'apply' );
		Route::get( 'student-card/{user}', [ HomeController::class, 'studentCard' ] )->name( 'student-card' );
		Route::get( 'employee-card/{employee}', [ HomeController::class, 'employeeCard' ] )->name( 'employee-card' );
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

