<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class StudentProfile extends Component
{
  use WithFileUploads;
  
  #[Rule( 'required|min:2|max:50' )]
  public $first_name = '';
  #[Rule( 'required|min:2|max:50' )]
  public $last_name = '';
  #[Rule( 'required|email|unique:users' )]
  public $email = '';
  #[Rule( 'required|unique:users' )]
  public $phone = '';
  #[Rule( 'required|unique:users' )]
  public $username = '';
  public $userId   = '';
  
  public $photo;
  
  public function mount()
  {
    $user = auth()->user();
    $this->userId = $user->id;
    $this->first_name = $user->first_name;
    $this->last_name = $user->last_name;
    $this->email = $user->email;
    $this->phone = $user->phone;
    $this->username = $user->username;
  }
  
  public function render()
  {
    return view( 'livewire.student.profile' );
  }
  
  public function updateProfile()
  {
    
    $validate = $this->validate( [
      'first_name' => 'required|min:2|max:50',
      'last_name'  => 'required|min:2|max:50',
      'username'   => 'required|unique:users,username,' . $this->userId,
      'phone'      => 'required|unique:users,phone,' . $this->userId,
      'email'      => 'required|email:rfc|unique:users,email,' . $this->userId,
      'photo'      => 'image|max:1024', // 1MB Max
    ] );
    $user = User::where( 'id', $this->userId )->first();
    if( $this->photo ) {
      $user->addMedia( $this->photo )->toMediaCollection( 'avatar' );
    }
    $user->update( $validate );
    session()->flash( 'success', 'User updated successfully.' );
    
  }
  
  public function resetForm()
  {
    $this->reset( [ 'first_name', 'last_name', 'email', 'password', 'username', 'password' ] );
  }
  
}
