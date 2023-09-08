<?php

namespace App\Livewire;

use App\Enums\ReligionEnum;
use App\Enums\TaxonomyTypeEnum;
use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RegisteredUsers extends Component
{
  use WithPagination;
  use WithFileUploads;
  
  public $search;
  public $sortBy   = 'id';
  public $sortAsc  = true;
  public $create   = false;
  public $editUser = null;
  
  protected $queryString = [
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editUser'
  ];
  
  public $first_name        = '';
  public $last_name         = '';
  public $email             = '';
  public $phone             = '';
  public $cnic              = '';
  public $username          = '';
  public $password          = '';
  public $userId            = '';
  public $image             = '';
  public $user              = '';
  public $avatar            = '';
  public $address           = '';
  public $hafiz_quran       = 0;
  public $father_contact    = '';
  public $dob               = '';
  public $gender_id         = null;
  public $genderList        = '';
  public $father_name       = '';
  public $district_id       = null;
  public $districtList      = '';
  public $blood_group_id    = null;
  public $bloodGroupList    = '';
  public $postal_address    = '';
  public $province_id       = '';
  public $provinceList      = [];
  public $emergency_contact = '';
  public $religion          = '';
  public $religionList      = [];
  public $hostel            = 0;
  
  public $errorMessage;
  
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
  
  public function mount()
  {
    $this->loadTaxonomies();
  }
  
  private function loadTaxonomies()
  {
    $this->genderList = Taxonomy::whereType( TaxonomyTypeEnum::GENDER )->get();
    $this->provinceList = Taxonomy::whereType( TaxonomyTypeEnum::PROVINCE )->get();
    $this->bloodGroupList = Taxonomy::whereType( TaxonomyTypeEnum::BLOODGROUP )->get();
    $this->districtList = Taxonomy::where( 'parent_id',
      $this->province_id )->whereType( TaxonomyTypeEnum::DISTRICT )->get();
    $this->religionList = ReligionEnum::cases();
  }
  
  public function render()
  {
    $query = User::with( 'student' )->where( 'role_id', User::ROLE_STUDENT );
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'first_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'last_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'username', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'phone', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'email', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->whereHas( 'student', function( $qq ) {
      $qq->whereNull( 'reg_no' );
    } )
          ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $users = $query->paginate( 10 );
    return view( 'livewire.registeredUsers', [
      'users' => $users
    ] );
  }
  
  public function add()
  {
    $this->create = true;
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
    $validateRules = [
      'first_name'        => 'required|min:2|max:50',
      'last_name'         => 'required|min:2|max:50',
      'username'          => 'required|max:8|unique:users,username,' . $this->editUser,
      'phone'             => 'required|numeric|digits:11|unique:users,phone,' . $this->editUser,
      'cnic'              => 'required|numeric|digits:13|unique:users,cnic,' . $this->editUser,
      'address'           => 'required',
      'father_name'       => 'required',
      'father_contact'    => 'required',
      'gender_id'         => 'required',
      'district_id'       => 'required',
      'province_id'       => 'required',
      'blood_group_id'    => 'required',
      'religion'          => 'required',
      'emergency_contact' => 'required',
    
    ];
    
    if( !$this->editUser ) {
      $validateRules[ 'password' ] = 'required|min:5';
    }
    $validate = $this->validate( $validateRules );
    try {
      DB::beginTransaction();
      $this->birthValidation( $this->dob );
      $user = User::findOrNew( $this->editUser );
      $user->fill( $validate );
      if( !$this->editUser ) {
        $user->email = $this->email;
        $user->role_id = User::ROLE_STUDENT;
      }
      if( !empty( $this->password ) ) {
        $user->password = Hash::make( $this->password );
      }
      $user->save();
      $studentData = [
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
      ];
      $user->student()->updateOrCreate( [], $studentData );
      if( $this->image ) {
        $user->clearMediaCollection( 'avatars' );
        $user->addMedia( $this->image )->toMediaCollection( 'avatars' );
      }
      $this->image = '';
      $this->avatar = $user->getFirstMediaUrl( 'avatars' );
      $this->toggleSection();
      
      DB::commit();
      
      session()->flash( 'success', 'User updated successfully.' );
    } catch ( \Exception $e ) {
      DB::rollback();
      session()->flash( 'error', 'An error occurred: ' . $e->getMessage() );
    }
  }
  
  public function edit( $id )
  {
    $student = User::with( 'student' )->findOrFail( $id );
    $this->editUser = $id;
    $this->userId = $student->id;
    $this->first_name = $student->first_name;
    $this->last_name = $student->last_name;
    $this->email = $student->email;
    $this->phone = $student->phone;
    $this->username = $student->username;
    $this->cnic = $student->cnic;
    $this->avatar = $student->avatar;
    
    if( $student->student ) {
      $this->gender_id = $student->student->gender_id;
      $this->district_id = $student->student->district_id;
      $this->blood_group_id = $student->student->blood_group_id;
      $this->dob = $student->student->dob;
      $this->father_contact = $student->student->father_contact;
      $this->father_name = $student->student->father_name;
      $this->address = $student->student->address;
      $this->postal_address = $student->student->postal_address;
      $this->emergency_contact = $student->student->emergency_contact;
      $this->religion = $student->student->religion;
      $this->province_id = $student->student->province_id;
      $this->hostel = $student->student->hostel;
      $this->hafiz_quran = $student->student->hafiz_quran;
    }
    
    $this->loadTaxonomies();
    $this->create = true;
  }
  
  
  
  public function toggleSection()
  {
    $this->create = false;
    $this->editUser = null;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function resetForm()
  {
    $this->reset( [
      'first_name', 'last_name', 'email', 'password', 'username', 'password', 'cnic'
    ] );
    $this->resetErrorBag( [
      'first_name', 'last_name', 'email', 'password', 'username', 'password', 'cnic'
    ] );
  }
  
  public function deleteUser( User $user )
  {
    $user->delete();
    session()->flash( 'success', 'User Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
