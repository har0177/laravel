<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
  use PasswordValidationRules;
  
  /**
   * Validate and create a newly registered user.
   * @param array<string, string> $input
   */
  public function create( array $input ) : User
  {
    Validator::make( $input, [
      'first_name'  => [ 'required', 'string', 'max:255' ],
      'last_name'   => [ 'required', 'string', 'max:255' ],
      'father_name' => [ 'required', 'string', 'max:255' ],
      //'email'       => [ 'string', 'email', 'max:255', 'unique:users' ],
      'phone'       => [ 'required', 'numeric', 'digits:11', 'unique:users' ],
      'cnic'        => [ 'required', 'numeric', 'digits:13', 'unique:users' ],
      'username'    => [ 'required', 'string', 'max:255', 'unique:users' ],
      'password'    => $this->passwordRules(),
    ], [
      'cnic.required' => 'The CNIC / FormB field is required',
      'cnic.numeric'  => 'The CNIC / FormB field must be a number',
      'cnic.digits'   => 'The CNIC / FormB field must be 13 digits',
      'cnic.unique'   => 'The CNIC / FormB must be unique'
    ] )->validate();
    
    $user = User::create( [
      'first_name' => $input[ 'first_name' ],
      'last_name'  => $input[ 'last_name' ],
      'email'      => $input[ 'email' ],
      'cnic'       => $input[ 'cnic' ],
      'username'   => $input[ 'username' ],
      'phone'      => preg_replace( '/[^0-9]/', '', $input[ 'phone' ] ),
      'password'   => Hash::make( $input[ 'password' ] ),
      'role_id'    => User::ROLE_STUDENT
    ] );
    
    UserInfo::create( [
      'user_id'     => $user->id,
      'father_name' => $input[ 'father_name' ]
    ] );
    return $user;
  }
}
