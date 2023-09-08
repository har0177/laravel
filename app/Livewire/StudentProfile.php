<?php

namespace App\Livewire;

use App\Enums\ReligionEnum;
use App\Enums\TaxonomyTypeEnum;
use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentProfile extends Component
{
  use WithFileUploads;
  
  public $userId            = '';
  public $first_name        = '';
  public $last_name         = '';
  public $email             = '';
  public $phone             = '';
  public $username          = '';
  #[Rule( 'nullable|image|max:1024|mimes:png,jpg,jpeg' )]
  public $image             = '';
  public $cnic              = '';
  public $user              = '';
  public $avatar            = '';
  #[Rule( 'required' )]
  public $address           = '';
  public $postal_address    = '';
  #[Rule( 'required' )]
  public $father_name       = '';
  #[Rule( 'required|numeric|digits:11' )]
  public $father_contact    = '';
  #[Rule( 'required' )]
  public $dob               = '';
  #[Rule( 'required' )]
  public $gender_id         = '';
  public $genderList        = [];
  #[Rule( 'required' )]
  public $district_id       = '';
  public $districtList      = [];
  #[Rule( 'required' )]
  public $blood_group_id    = '';
  public $bloodGroupList    = [];
  #[Rule( 'required' )]
  public $province_id       = '';
  public $provinceList      = [];
  #[Rule( 'numeric|digits:11' )]
  public $emergency_contact = '';
  #[Rule( 'required' )]
  public $religion          = '';
  public $religionList      = [];
  public $hostel            = 0;
  public $hafiz_quran       = 0;
  
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
    $this->gender_id = $user->student?->gender_id;
    $this->district_id = $user->student?->district_id;
    $this->blood_group_id = $user->student?->blood_group_id;
    $this->dob = $user->student?->dob;
    $this->father_contact = $user->student?->father_contact;
    $this->father_name = $user->student?->father_name;
    $this->address = $user->student?->address;
    $this->postal_address = $user->student?->postal_address;
    $this->emergency_contact = $user->student?->emergency_contact;
    $this->religion = $user->student?->religion;
    $this->province_id = $user->student?->province_id;
    $this->hostel = $user->student?->hostel;
    $this->hafiz_quran = $user->student?->hafiz_quran;
    $this->genderList = Taxonomy::whereType( TaxonomyTypeEnum::GENDER )->get();
    $this->provinceList = Taxonomy::whereType( TaxonomyTypeEnum::PROVINCE )->get();
    $this->districtList = Taxonomy::where( 'parent_id',
      $this->province_id )->whereType( TaxonomyTypeEnum::DISTRICT )->get();
    $this->bloodGroupList = Taxonomy::whereType( TaxonomyTypeEnum::BLOODGROUP )->get();
    $this->religionList = ReligionEnum::cases();
  }
  
  protected function rules()
  {
    return [
      'first_name' => 'required|min:2|max:50',
      'last_name'  => 'required|min:2|max:50',
      'username'   => 'required|min:3|max:8|unique:users,username,' . $this->userId,
      'phone'      => 'required|numeric|digits:11|unique:users,phone,' . $this->userId,
      'email'      => 'email|max:255|unique:users,email,' . $this->userId,
      'cnic'       => 'required|numeric|digits:13|unique:users,cnic,' . $this->userId
    ];
  }
  
  public function render()
  {
    return view( 'livewire.student.profile' );
  }
  
  public function updateDistrict()
  {
    $this->districtList = Taxonomy::where( 'parent_id',
      $this->province_id )->whereType( TaxonomyTypeEnum::DISTRICT )->get();
  }
  
  public function birthValidation()
  {
    $dob = Carbon::parse( $this->dob );
    $minAge = 15;
    
    if( $dob->addYears( $minAge )->isAfter( Carbon::now() ) ) {
      $this->addError( 'dob', "You must be at least $minAge years old." );
    }
  }
  
  public function updateProfile()
  {
    if( auth()->user()->applications->count() > 0) {
      session()->flash( 'error', 'You cannot update your profile due to active applications.' );
      return true;
    }
    $validate = $this->validate();
    $dob = Carbon::parse( $this->dob );
    $minAge = 15;
    if( $dob->addYears( $minAge )->isAfter( Carbon::now() ) ) {
      $this->addError( 'dob', "You must be at least $minAge years old." );
      return;
    }
    $validate[ 'email' ] = $this->email;
    try {
      $user = User::where( 'id', $this->userId )->first();
      if( !$user->hasMedia( 'avatars' ) && empty( $this->image ) ) {
        $this->addError( 'image', "Please upload your image." );
        return;
      }
      if( $this->image ) {
        $user->clearMediaCollection( 'avatars' );
        $user->addMedia( $this->image )->toMediaCollection( 'avatars' );
      }
      $user->update( $validate );
      $user->student->update( [
        'gender_id'         => $this->gender_id,
        'father_name'       => $this->father_name,
        'father_contact'    => $this->father_contact,
        'dob'               => $this->dob,
        'blood_group_id'    => $this->blood_group_id,
        'address'           => $this->address,
        'postal_address'    => $this->postal_address,
        'district_id'       => $this->district_id,
        'province_id'       => $this->province_id,
        'emergency_contact' => $this->emergency_contact,
        'religion'          => $this->religion,
        'hostel'            => $this->hostel,
        'hafiz_quran'       => $this->hafiz_quran,
        'profile_status'    => 1,
      ] );
      $this->image = '';
      $this->avatar = $user->getFirstMediaUrl( 'avatars' );
      session()->flash( 'success', 'User updated successfully.' );
      return $this->redirect( '/education', navigate: true );
    } catch ( \Exception $e ) {
      session()->flash( 'error', 'An error occurred: ' . $e->getMessage() );
      
    }
    
  }
  
}
