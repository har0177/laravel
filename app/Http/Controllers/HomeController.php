<?php

namespace App\Http\Controllers;

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
  public function projects()
  {
    return view( 'admin.projects' );
  }
  
}
