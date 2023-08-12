<?php

namespace App\Livewire;

use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
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
  public $image  = '';
  public $cnic   = '';
  public $user   = '';
  public $avatar = '';
  #[Rule('required')]
  public $address = '';
  #[Rule('required')]
  public $father_nic = '';
  #[Rule('required')]
  public $father_contact = '';
  #[Rule('required')]
  public $dob = '';
  #[Rule('required')]
  public $gender_id  = '';
  public $genderList = '';
  #[Rule('required')]
  public $district_id  = '';
  public $districtList = '';
  #[Rule('required')]
  public $blood_group_id = '';
  public $bloodGroupList = '';
  
  public $errorMessage;
  
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
    $this->gender_id = $user->userInfo->gender_id;
    $this->district_id = $user->userInfo->district_id;
    $this->blood_group_id = $user->userInfo->blood_group_id;
    $this->dob = $user->userInfo->dob;
    $this->father_contact = $user->userInfo->father_contact;
    $this->father_nic = $user->userInfo->father_nic;
    $this->address = $user->userInfo->address;
    $this->genderList = Taxonomy::whereType( 'gender' )->get();
    $this->districtList = Taxonomy::whereType( 'district' )->get();
    $this->bloodGroupList = Taxonomy::whereType( 'bloodGroup' )->get();
  }
  
  protected function rules()
  {
    return [
      'first_name' => 'required|min:2|max:50',
      'last_name'  => 'required|min:2|max:50',
      'username'   => 'required|max:8|unique:users,username,' . $this->userId,
      'phone'      => 'required|numeric|digits:11|unique:users,phone,' . $this->userId,
      'email'      => 'required|email|max:255|unique:users,email,' . $this->userId,
      'cnic'       => 'required|numeric|digits:13|unique:users,cnic,' . $this->userId
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
  
  public function updatedDob( $value )
  {
    $this->birthValidation( $value );
    
  }
  
  public function birthValidation( $value )
  {
    $dob = Carbon::parse( $value );
    $minAge = 16;
    
    if( $dob->addYears( $minAge )->isAfter( Carbon::now() ) ) {
      $this->addError( 'dob', "You must be at least $minAge years old." );
    }
  }
  
  public function updateProfile()
  {
    $validate = $this->validate();
    $this->birthValidation( $this->dob );
    
    try {
      $user = User::where( 'id', $this->userId )->first();
      if( $this->image ) {
        $user->clearMediaCollection( 'avatars' );
        $user->addMedia( $this->image )->toMediaCollection( 'avatars' );
      }
      $user->update( $validate );
      $user->userInfo->update( [ 'gender_id' => $this->gender_id ] );
      $this->image = '';
      $this->avatar = $user->getFirstMediaUrl( 'avatars' );
      session()->flash( 'success', 'User updated successfully.' );
    } catch ( \Exception $e ) {
      session()->flash( 'error', 'An error occurred: ' . $e->getMessage() );
      
    }
    
  }
  
}
