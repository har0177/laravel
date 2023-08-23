<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\NewsEvents;
use App\Models\User;

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
  
  public function index()
  {
    return view( 'welcome' );
  }
  
  public function about()
  {
    return view( 'about' );
  }
  
  public function contact()
  {
    return view( 'contact' );
  }
  
  public function dvs()
  {
    return view( 'dvs' );
  }
  
  public function das()
  {
    return view( 'das' );
  }
  
  public function dashboard()
  {
    return view( 'dashboard' );
  }
  
  public function studentDashboard()
  {
    return view( 'student-dashboard' );
  }
  
  public function roles()
  {
    return view( 'admin.roles' );
  }
  
  public function users()
  {
    return view( 'admin.users' );
  }
  
  public function slides()
  {
    return view( 'admin.slides' );
  }
  
  public function students()
  {
    return view( 'admin.students' );
  }
  
  public function profile()
  {
    return view( 'student.profile' );
  }
  
  public function education()
  {
    return view( 'student.education' );
  }
  
  public function apply()
  {
    return view( 'student.apply' );
  }
  
  public function showEvent( NewsEvents $event )
  {
    return view( 'showEvent', compact( 'event' ) );
  }
  
  public function events()
  {
    return view( 'admin.events' );
  }
  
  public function projects()
  {
    return view( 'admin.projects' );
  }
  
  public function applications()
  {
    return view( 'admin.applications' );
  }
  
  public function printForm( Application $application )
  {
    $user = auth()->user();
    if( $user->role_id === User::ROLE_ADMIN ) {
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
