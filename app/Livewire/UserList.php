<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
  use WithPagination;
  
  
  #[Rule( 'required|min:2|max:50' )]
  public $name     = '';
  #[Rule( 'required|email|unique:users' )]
  public $email    = '';
  #[Rule( 'required|min:5' )]
  public $password = '';
  
  public function create()
  {
    dd('asdasd');
    $validate = $this->validate();
    User::create( $validate );
  }
  
  
  public function render()
  {
    $users = User::paginate( 1 );
    return view( 'livewire.users', compact( 'users' ) );
  }
  
}
