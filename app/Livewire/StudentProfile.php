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
  
  public $userId         = '';
  public $first_name     = '';
  public $last_name      = '';
  public $email          = '';
  public $phone          = '';
  public $username       = '';
  #[Rule( 'nullable|image|max:1024|mimes:png,jpg,jpeg' )]
  public $image          = '';
  public $cnic           = '';
  public $user           = '';
  public $avatar         = '';
  #[Rule( 'required', message: 'Please provide your full address' )]
  public $address        = '';
  public $postal_address        = '';
  #[Rule( 'required', message: 'Please provide father CNIC #' )]
  public $father_nic     = '';
  #[Rule( 'required', message: 'Please provide father Name' )]
  public $father_name    = '';
  #[Rule( 'required', message: 'Please provide father phone #' )]
  public $father_contact = '';
  #[Rule( 'required', message: 'Please provide date of birth' )]
  public $dob            = '';
  #[Rule( 'required', message: 'Please select your gender' )]
  public $gender_id      = '';
  public $genderList     = '';
  #[Rule( 'required', message: 'Please select your district' )]
  public $district_id    = '';
  public $districtList   = '';
  #[Rule( 'required', message: 'Please select your blood group.' )]
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
    $this->gender_id = $user->userInfo?->gender_id;
    $this->district_id = $user->userInfo?->district_id;
    $this->blood_group_id = $user->userInfo?->blood_group_id;
    $this->dob = $user->userInfo?->dob;
    $this->father_contact = $user->userInfo?->father_contact;
    $this->father_name = $user->userInfo?->father_name;
    $this->father_nic = $user->userInfo?->father_nic;
    $this->address = $user->userInfo?->address;
    $this->genderList = Taxonomy::whereType( Taxonomy::GENDER )->get();
    $this->districtList = Taxonomy::whereType( Taxonomy::DISTRICT )->get();
    $this->bloodGroupList = Taxonomy::whereType( Taxonomy::BLOODGROUP )->get();
  }
  
  protected function rules()
  {
    return [
      'first_name' => 'required|min:2|max:50',
      'last_name'  => 'required|min:2|max:50',
      'username'   => 'required|max:8|unique:users,username,' . $this->userId,
      'phone'      => 'required|numeric|digits:11|unique:users,phone,' . $this->userId,
      //'email'      => 'required|email|max:255|unique:users,email,' . $this->userId,
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
  
  public function birthValidation()
  {
    $dob = Carbon::parse( $this->dob );
    $minAge = 16;
    
    if( $dob->addYears( $minAge )->isAfter( Carbon::now() ) ) {
      $this->addError( 'dob', "You must be at least $minAge years old." );
    }
  }
  
  public function updateProfile()
  {
    $validate = $this->validate();
    $dob = Carbon::parse( $this->dob );
    $minAge = 16;
    if( $dob->addYears( $minAge )->isAfter( Carbon::now() ) ) {
      $this->addError( 'dob', "You must be at least $minAge years old." );
      return;
    }
    $validate[ 'email' ] = $this->email;
    try {
      $user = User::where( 'id', $this->userId )->first();
      if( !$user->hasMedia( 'avatars' ) && empty($this->image)) {
        $this->addError( 'image', "Please upload your image." );
        return;
      }
      if( $this->image ) {
        $user->clearMediaCollection( 'avatars' );
        $user->addMedia( $this->image )->toMediaCollection( 'avatars' );
      }
      $user->update( $validate );
      $user->userInfo->update( [
        'gender_id'      => $this->gender_id,
        'father_name'    => $this->father_name,
        'father_nic'     => $this->father_nic,
        'father_contact' => $this->father_contact,
        'dob'            => $this->dob,
        'blood_group_id' => $this->blood_group_id,
        'address'        => $this->address,
        'postal_address'        => $this->postal_address,
        'district_id'    => $this->district_id,
        'profile_status' => 1,
      ] );
      $this->image = '';
      $this->avatar = $user->getFirstMediaUrl( 'avatars' );
      session()->flash( 'success', 'User updated successfully.' );
    } catch ( \Exception $e ) {
      session()->flash( 'error', 'An error occurred: ' . $e->getMessage() );
      
    }
    
  }
  
}
