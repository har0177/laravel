<?php

namespace App\Livewire;

use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class StudentList extends Component
{
  use WithPagination;
  
  public $active;
  public $search;
  public $sortBy      = 'id';
  public $sortAsc     = true;
  public $create      = false;
  public $editStudent = null;
  
  protected $queryString = [
    'active',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editStudent'
  ];
  
  use WithFileUploads;
  
  public $first_name = '';
  public $last_name  = '';
  public $email      = '';
  public $phone      = '';
  public $cnic       = '';
  public $username   = '';
  #[Rule( 'required|min:5' )]
  public $password   = '';
  
  public $userId         = '';
  #[Rule( 'required|image|max:1024|mimes:png,jpg,jpeg' )]
  public $image          = '';
  public $user           = '';
  public $avatar         = '';
  #[Rule( 'required' )]
  public $address        = '';
  #[Rule( 'required' )]
  public $father_nic     = '';
  #[Rule( 'required' )]
  public $father_contact = '';
  #[Rule( 'required' )]
  public $dob            = '';
  #[Rule( 'required' )]
  public $gender_id      = null;
  public $genderList     = '';
  #[Rule( 'required' )]
  public $father_name    = '';
  //#[Rule( 'required' )]
  public $district_id    = null;
  public $districtList   = '';
  #[Rule( 'required' )]
  public $blood_group_id = null;
  public $bloodGroupList = '';
  
  public $errorMessage;
  
  public function mount()
  {
    $this->genderList = Taxonomy::whereType( Taxonomy::GENDER )->get();
    $this->districtList = Taxonomy::whereType( Taxonomy::DISTRICT )->get();
    $this->bloodGroupList = Taxonomy::whereType( Taxonomy::BLOODGROUP )->get();
  }
  
  public function render()
  {
    $query = User::with( 'userInfo' )->where( 'role_id', User::ROLE_STUDENT );
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'first_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'last_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'username', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'phone', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'email', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->when( $this->active, function( $q ) {
      return $q->where( 'status', 'Active' );
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $students = $query->paginate( 10 );
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
  
  protected function rules()
  {
    return [
      'first_name' => 'required|min:2|max:50',
      'last_name'  => 'required|min:2|max:50',
      'username'   => 'required|max:8|unique:users,username,' . $this->editStudent,
      'phone'      => 'required|numeric|digits:11|unique:users,phone,' . $this->editStudent,
      //'email'      => 'required|email|max:255|unique:users,email,' . $this->userId,
      'cnic'       => 'required|numeric|digits:13|unique:users,cnic,' . $this->editStudent
    ];
  }
  
  public function updateProfile()
  {
    try {
      DB::beginTransaction();
      
      $validate = $this->validate();
      $validate[ 'email' ] = $this->email;
      $this->birthValidation( $this->dob );
      $validate[ 'role_id' ] = User::ROLE_STUDENT;
      
      if( $this->editStudent ) {
        $user = User::find( $this->editStudent );
        $user->userInfo()->update( [
          'gender_id'      => $this->gender_id,
          'father_name'    => $this->father_name,
          'father_nic'     => $this->father_nic,
          'father_contact' => $this->father_contact,
          'dob'            => $this->dob,
          'blood_group_id' => $this->blood_group_id,
          'address'        => $this->address,
          'district_id'    => $this->district_id,
        ] );
        $user->update( $validate );
      } else {
        $user = User::create( $validate );
        $user->userInfo()->create( [
          'gender_id'      => $this->gender_id,
          'father_name'    => $this->father_name,
          'father_nic'     => $this->father_nic,
          'father_contact' => $this->father_contact,
          'dob'            => $this->dob,
          'blood_group_id' => $this->blood_group_id,
          'address'        => $this->address,
          'district_id'    => $this->district_id,
          'profile_status' => 1,
        ] );
        
        if( $this->image ) {
          $user->clearMediaCollection( 'avatars' );
          $user->addMedia( $this->image )->toMediaCollection( 'avatars' );
        }
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
    $this->editStudent = $id;
    $student = User::findOrFail( $id );
    $this->first_name = $student->first_name;
    $this->last_name = $student->last_name;
    $this->email = $student->email;
    $this->phone = $student->phone;
    $this->username = $student->username;
    $this->cnic = $student->cnic;
    $this->avatar = $student->avatar;
    $this->gender_id = $student->userInfo->gender_id;
    $this->district_id = $student->userInfo->district_id;
    $this->father_name = $student->userInfo->father_name;
    $this->blood_group_id = $student->userInfo->blood_group_id;
    $this->dob = $student->userInfo->dob;
    $this->father_contact = $student->userInfo->father_contact;
    $this->father_nic = $student->userInfo->father_nic;
    $this->address = $student->userInfo->address;
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
