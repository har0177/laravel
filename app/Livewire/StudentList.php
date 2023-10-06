<?php

namespace App\Livewire;

use App\Enums\ReligionEnum;
use App\Enums\TaxonomyTypeEnum;
use App\Helper\Common;
use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class StudentList extends Component
{
  use WithPagination;
  use WithFileUploads;
  
  public $search;
  public $sortBy      = 'id';
  public $sortAsc     = true;
  public $create      = false;
  public $editStudent = null;
  
  protected $queryString = [
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editStudent'
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
		public $diplomaList       = [];
		public $sessionList       = [];
		public $sectionList       = [];
		
		public $class_no       = null;
		public $reg_no         = null;
		public $diploma_id     = null;
		public $session_id     = null;
		public $section_id     = null;
		public $admission_date = null;
		
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
		
		private function loadTaxonomies()
  {
    $this->genderList = Taxonomy::whereType( TaxonomyTypeEnum::GENDER )->get();
    $this->provinceList = Taxonomy::whereType( TaxonomyTypeEnum::PROVINCE )->get();
    $this->bloodGroupList = Taxonomy::whereType( TaxonomyTypeEnum::BLOODGROUP )->get();
    $this->districtList = Taxonomy::where( 'parent_id',
      $this->province_id )->whereType( TaxonomyTypeEnum::DISTRICT )->get();
    $this->religionList = ReligionEnum::cases();
    $this->diplomaList = Taxonomy::whereType( TaxonomyTypeEnum::DIPLOMA )->get();
    $this->sessionList = Taxonomy::whereType( TaxonomyTypeEnum::SESSION )->orderByDesc( 'id' )->get();
    
  }
  
  public function render()
  {
    $query = User::with( 'student' )->where( 'role_id', User::ROLE_STUDENT );
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->whereRaw( "CONCAT(first_name, ' ',last_name) LIKE ?",
          [ '%' . $this->search . '%' ] )
           ->orWhere( 'username', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'phone', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'email', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'cnic', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->whereHas( 'student', function( $qq ) {
      $qq->where( 'status', 'Active' );
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $students = $query->take( 50 ) // Limit the query to retrieve only the latest 50 records
                      ->get(); // Retrieve all 50 records
		  $students = Common::showPerPage( 10, $students );
    return view( 'livewire.students', [
      'students' => $students
    ] );
  }
  
  public function updatingActive()
  {
    return $this->resetPage();
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
    $minAge = 14;
    
    if( $dob->addYears( $minAge )->isAfter( Carbon::now() ) ) {
      $this->addError( 'dob', "You must be at least $minAge years old." );
    }
  }
  
  public function updateProfile()
  {
    $validateRules = [
      'first_name'        => 'required|min:2|max:50',
      'last_name'         => 'required|min:2|max:50',
      'username'          => 'required|max:8|unique:users,username,' . $this->editStudent,
      'phone'             => 'required|numeric|digits:11|unique:users,phone,' . $this->editStudent,
      'cnic'              => 'required|numeric|digits:13|unique:users,cnic,' . $this->editStudent,
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
    
    if( !$this->editStudent ) {
      $validateRules[ 'password' ] = 'required|min:5';
    }
    $validate = $this->validate( $validateRules );
    try {
      DB::beginTransaction();
      $this->birthValidation( $this->dob );
      $user = User::findOrNew( $this->editStudent );
      $user->fill( $validate );
      if( !$this->editStudent ) {
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
        'reg_no'            => $this->reg_no,
        'class_no'          => $this->class_no,
        'section_id'          => $this->section_id,
        'admission_date'    => $this->admission_date,
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
    $this->loadTaxonomies();
    $user = User::with( 'student' )->findOrFail( $id );
    $this->editStudent = $id;
    $this->userId = $user->id;
    $this->first_name = $user->first_name;
    $this->last_name = $user->last_name;
    $this->email = $user->email;
    $this->phone = $user->phone;
    $this->username = $user->username;
    $this->cnic = $user->cnic;
    $this->avatar = $user->avatar;
    
    if( $user->student ) {
		    $this->gender_id = $user->student->gender_id;
		    $this->district_id = $user->student->district_id;
		    $this->blood_group_id = $user->student->blood_group_id;
		    $this->dob = $user->student->dob;
		    $this->father_contact = $user->student->father_contact;
		    $this->father_name = $user->student->father_name;
		    $this->address = $user->student->address;
		    $this->postal_address = $user->student->postal_address;
		    $this->emergency_contact = $user->student->emergency_contact;
		    $this->religion = $user->student->religion;
		    $this->province_id = $user->student->province_id;
		    $this->hostel = $user->student->hostel;
		    $this->hafiz_quran = $user->student->hafiz_quran;
		    $this->class_no = $user->student->class_no;
		    $this->reg_no = $user->student->reg_no;
		    $this->admission_date = $user->student->admission_date;
		    $this->diploma_id = $user->student->diploma_id;
		    $this->session_id = $user->student->session_id;
		    $this->section_id = $user->student->section_id;
		    $this->sectionList = Taxonomy::whereType( TaxonomyTypeEnum::SECTION )->where( 'parent_id',
				    $this->diploma_id )->get();
    }
		  $this->create = true;
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->editStudent = null;
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
  
  public function deleteStudent( User $user )
  {
    $user->delete();
    session()->flash( 'success', 'Student Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
