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
  public $sortBy  = 'id';
  public $sortAsc = true;
  
  protected $queryString = [
    'active',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc'
  ];
  
  #[Rule( 'required|min:2|max:50' )]
  public $name     = '';
  #[Rule( 'required|email|unique:users' )]
  public $email    = '';
  #[Rule( 'required|min:5' )]
  public $password = '';
  
  public function render()
  {
    $query = User::query();
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'name', 'LIKE', '%' . $this->search . '%' )
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
  
  public function create()
  {
    dd( 'asdasd' );
    $validate = $this->validate();
    User::create( $validate );
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
