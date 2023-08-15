<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StudentApply extends Component
{
  public function render()
  {
   return view( 'livewire.student.apply' );
  }
  
}
