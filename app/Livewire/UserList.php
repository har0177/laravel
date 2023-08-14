<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
  use WithPagination;
  
  public $active;
  public $search;
  public $sortBy   = 'id';
  public $sortAsc  = true;
  public $create   = false;
  public $editUser = null;
  
  protected $queryString = [
    'active',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editUser'
  ];
  
  #[Rule( 'required|min:2|max:50' )]
  public $first_name = '';
  #[Rule( 'required|min:2|max:50' )]
  public $last_name  = '';
  #[Rule( 'required|email|max:255|unique:users' )]
  public $email      = '';
  #[Rule( 'required|numeric|digits:11|unique:users' )]
  public $phone      = '';
  #[Rule( 'required|numeric|digits:13|unique:users' )]
  public $cnic       = '';
  #[Rule( 'required|unique:users' )]
  public $username   = '';
  #[Rule( 'required|min:5' )]
  public $password   = '';
  
  public function render()
  {
    $query = User::query()->where( 'role_id', '!=', User::ROLE_STUDENT );
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'first_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'last_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'username', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'phone', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'email', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->when( $this->active, function( $q ) {
      return $q->active();
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $users = $query->paginate( 10 );
    return view( 'livewire.users', [
      'users' => $users
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
  
  public function store()
  {
    
    if( $this->editUser ) {
      $validate = $this->validate( [
        'first_name' => 'required|min:2|max:50',
        'last_name'  => 'required|min:2|max:50',
        'username'   => 'required|unique:users,username,' . $this->editUser,
        'phone'      => 'required|numeric|digits:11|unique:users,phone,' . $this->editUser,
        'cnic'       => 'required|numeric|digits:13|unique:users,cnic,' . $this->editUser,
        'email'      => 'required|email|max:255|unique:users,email,' . $this->editUser,
      ] );
      
      User::where( 'id', $this->editUser )->update( $validate );
      $this->toggleSection();
      session()->flash( 'success', 'User updated successfully.' );
      return;
    }
    
    $validate = $this->validate();
    User::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'User added successfully.' );
  }
  
  public function edit( $id )
  {
    $this->editUser = $id;
    $user = User::findOrFail( $id );
    $this->first_name = $user->first_name;
    $this->last_name = $user->last_name;
    $this->cnic = $user->cnic;
    $this->email = $user->email;
    $this->username = $user->username;
    $this->phone = $user->phone;
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
