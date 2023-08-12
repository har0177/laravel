<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentProfile extends Component
{
  use WithFileUploads;
  
  public $userId     = '';
  public $first_name = '';
  public $last_name  = '';
  public $email      = '';
  public $phone      = '';
  public $username   = '';
  #[Rule( 'nullable|image|max:1024|mimes:png,jpg,jpeg' )]
  public $image      = '';
  public $cnic       = '';
  public $user       = '';
  public $avatar     = '';
  
  public function mount()
  {
    $user = auth()->user();
    $this->userId = $user->id;
    $this->first_name = $user->first_name;
    $this->last_name = $user->last_name;
    $this->email = $user->email;
    $this->phone = $user->phone;
    $this->username = $user->username;
    $this->cnic = $user->cnic;
    $this->avatar = $user->avatar;
  }
  
  protected function rules()
  {
    return [
      'first_name' => 'required|min:2|max:50',
      'last_name'  => 'required|min:2|max:50',
      'username'   => 'required|max:8|unique:users,username,' . $this->userId,
      'phone'      => 'required|numeric|digits:11|unique:users,phone,' . $this->userId,
      'email'      => 'required|email|max:255|unique:users,email,' . $this->userId,
      'cnic'       => 'required|numeric|digits:13|unique:users,cnic,' . $this->userId,
    
    ];
  }
  
  public function render()
  {
    return view( 'livewire.student.profile' );
  }
  
  public function updated( $propertyName )
  {
    $this->validateOnly( $propertyName );
  }
  
  public function updateProfile()
  {
    
    $validate = $this->validate();
    try {
      $user = User::where( 'id', $this->userId )->first();
      if( $this->image ) {
        $user->clearMediaCollection( 'avatars' );
        $user->addMedia( $this->image )->toMediaCollection( 'avatars' );
      }
      $user->update( $validate );
      $this->image = '';
      $this->avatar = $user->getFirstMediaUrl('avatars');
      session()->flash( 'success', 'User updated successfully.' );
    } catch ( \Exception $e ) {
      $this->addError( 'avatar', 'An error occurred: ' . $e->getMessage() );
    }
    
  }
  
  
}
