<?php
		namespace App\Http\Controllers;
		use App\Enums\TaxonomyTypeEnum;
		use App\Mail\ContactFormMail;
		use App\Models\Application;
		use App\Models\Content;
		use App\Models\Employee;
		use App\Models\Gallery;
		use App\Models\MeritList;
		use App\Models\NewsEvents;
		use App\Models\Project;
		use App\Models\Taxonomy;
		use App\Models\User;
		use Illuminate\Http\Request;
		use Illuminate\Support\Facades\Mail;
		class HomeController extends Controller
		{
				public function redirects()
				{
						$redirect = route( 'dashboard' );
						if( session()->has( 'url.intended' ) ) {
								$redirect = session()->get( 'url.intended' );
								session()->forget( 'url.intended' );
						}
						if( auth()->user()->role->id === User::ROLE_STUDENT ) {
								$redirect = route( 'student-dashboard' );
						}
						
						return redirect( $redirect );
				}
				public function frontGallery()
				{
						$images = Gallery::where( 'status', 'Show' )->paginate( 10 );
						
						return view( 'frontGallery', compact( 'images' ) );
				}
				public function courseContent( Content $content )
				{
						return view( 'course-content', compact( 'content' ) );
				}
				
				public function attendance()
				{
						$sections = Taxonomy::whereType( TaxonomyTypeEnum::SECTION )->get();
						
						return view( 'attendance', compact( 'sections' ) );
						//return view( 'admin.infos.result-sheet', compact( 'classes' ) );
						// return view( 'admin.infos.vaccine', compact( 'classes' ) );
				}
				
				public function dashboard()
				{
						$students = User::where( 'role_id', User::ROLE_STUDENT )->whereHas( 'student', function( $q ) {
								$q->where( 'status', 'Active' );
						} )->count();
						$users = User::where( 'role_id', User::ROLE_STUDENT )->whereHas( 'student', function( $q ) {
								$q->where( 'status', 'Pending' );
						} )->count();
						$applications = Application::whereHas( 'project', function( $q ) {
								$q->where( 'expiry_date', '>', now() );
						} )->count();
						$projects = Project::where( 'expiry_date', '>', now() )->count();
						return view( 'dashboard', compact( 'students', 'applications', 'users', 'projects' ) );
				}
				public function studentDashboard()
				{
						return view( 'student-dashboard' );
				}
				public function MeritList( Request $request )
				{
						$project = Project::findOrFail( $request->project );
						$meritData = MeritList::with( 'user', 'project', 'district', 'quota' )
						                      ->where( 'project_id', $project->id
						                      )->get();
						$districtList = Taxonomy::whereType( TaxonomyTypeEnum::DISTRICT )
						                        ->get();
						$quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )->where( 'id', '!=', '33' )
						                     ->get();
						return view( 'merit-list-show', compact( 'meritData', 'districtList', 'quotaList', 'project' ) );
						
				}
				public function showEvent( NewsEvents $event )
				{
						return view( 'showEvent', compact( 'event' ) );
				}
				public function submitForm( Request $request )
				{
						
						$request->validate( [
								'name'    => 'required|min:3|max:30',
								'email'   => 'required|email',
								'subject' => 'required|min:3|max:50',
								'message' => 'required',
						] );
						Mail::to( 'admission@asap.edu.pk' )->send( new ContactFormMail(
								$request->message,
								$request->email,
								$request->subject,
								$request->name ) );
						
						// Process the form data and send emails, save to database, etc.
						return response()->json( [ 'message' => 'Message Send successfully. We will inform you through your email.' ] );
				}
				public function studentCard( Request $request )
				{
						
						$students = User::with( 'student' )->whereHas( 'student', function( $q ) {
								$q->whereNotNull( 'diploma_id' )->where( 'status', 'Active' )->where( 'card_status', 0 );
						} );
						if( $request->id ) {
								$students->where( 'id', $request->id );
						}
						$students = $students->get();
						
						return view( 'student-card', compact( 'students' ) );
				}
				public function employeeCard( Request $request )
				{
						$employees = Employee::query();
						if( $request->id ) {
								$employees->where( 'id', $request->id );
						}
						$employees = $employees->get();
						
						return view( 'employee-card', compact( 'employees' ) );
				}
				public function printForm( Application $application )
				{
						$user = auth()->user();
						if( $user->role_id !== User::ROLE_STUDENT ) {
								$user = User::find( $application->user_id );
						}
						if( $application->user_id !== $user->id ) {
								return redirect()->back();
						}
						return view( 'print-form', compact( 'user', 'application' ) );
				}
				public function printChallan( Application $application )
				{
						$user = User::find( $application->user_id );
						return view( 'print-challan', compact( 'user', 'application' ) );
				}
		}
