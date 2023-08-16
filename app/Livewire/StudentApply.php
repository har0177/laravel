<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class StudentApply extends Component
{
  public function render()
  {
    $projects = Project::where( 'expiry_date', '>', now() )->get();
    return view( 'livewire.student.apply', [ 'projects' => $projects ] );
  }
  
}
