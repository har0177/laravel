<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
  public function index()
  {
    return view( 'admin.users' );
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
}