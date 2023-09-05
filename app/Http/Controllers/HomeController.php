<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Application;
use App\Models\Gallery;
use App\Models\NewsEvents;
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
  
  public function dashboard()
  {
    $students = User::where( 'role_id', User::ROLE_STUDENT )->count();
    $applications = Application::count();
    
    return view( 'dashboard', compact( 'students', 'applications' ) );
  }
  
  public function studentDashboard()
  {
    return view( 'student-dashboard' );
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
