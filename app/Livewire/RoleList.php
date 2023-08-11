<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class RoleList extends Component
{
  use WithPagination;
  
  public $search;
  public $sortBy    = 'id';
  public $sortAsc   = true;
  public $create    = false;
  public $editRole  = null;
  public $abilities = [];
  
  protected $queryString = [
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editRole'
  ];
  
  #[Rule( 'required|string|max:191|unique:roles|regex:/^[a-zA-Z\s]+$/' )]
  public $name        = '';
  #[Rule( 'required|min:5' )]
  public $description = '';
  #[Rule( 'required|array' )]
  public $permissions = [];
  public $activeTab   = '';
  
  public function mount()
  {
    $this->abilities = config( 'permissions' );
    $this->activeTab = 'Roles';
  }
  
  public function switchTab( $tabTitle )
  {
    $this->activeTab = $tabTitle;
  }
  
  public function render()
  {
    $query = Role::query();
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'name', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $roles = $query->paginate( 10 );
    
    return view( 'livewire.roles', [
      'roles' => $roles
    ] );
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    if( $this->editRole ) {
      $validate = $this->validate( [
        'name'        => 'required|string|max:191|regex:/^[a-zA-Z\s]+$/|unique:roles,name,' . $this->editRole,
        'description' => 'required'
      ] );
      
      Role::where( 'id', $this->editRole )->update( [
        'name'        => $validate[ 'name' ],
        'description' => $validate[ 'description' ],
        'permissions' => $this->permissions
      ] );
      
      $this->toggleSection();
      session()->flash( 'success', 'Role updated successfully.' );
      return;
    }
    
    $validate = $this->validate();
    $validate[ 'permissions' ] = $this->permissions;
    
    Role::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'Role added successfully.' );
  }
  
  public function edit( $id )
  {
    $this->editRole = $id;
    $role = Role::findOrFail( $id );
    $this->name = $role->name;
    $this->description = $role->description;
    $this->permissions = $role->permissions;
    $this->create = true;
    $this->abilities = config( 'permissions' );
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->editRole = null;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function resetForm()
  {
    $this->reset( [ 'name', 'description', 'permissions' ] );
  }
  
  public function deleteRole( Role $role )
  {
    $role->delete();
    session()->flash( 'success', 'Role Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
