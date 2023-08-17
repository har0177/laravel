<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Taxonomy;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StudentApply extends Component
{
  
  public $applyPanel     = false;
  public $project_id     = '';
  public $challan_number = '';
  public $diplomaName    = '';
  #[Rule( 'required|array|min:1|max:2' )]
  public $quota          = [];
  public $quotaList      = '';
  public $status         = '';
  
  public function mount()
  {
    $education = auth()->user()->education->count();
    if( $education < 1 ) {
      session()->flash( 'error', 'Please add at least one education.' );
      
      return $this->redirect( '/education', navigate: true );
    }
    $this->quotaList = Taxonomy::whereType( Taxonomy::QUOTA )->get();
    
  }
  
  public function render()
  {
    $projects = Project::where( 'expiry_date', '>', now() )->get();
    return view( 'livewire.student.apply', [ 'projects' => $projects ] );
  }
  
  public function getFirstLetter( $value )
  {
    $words = explode( " ", $value );
    $acronym = "";
    
    foreach( $words as $w ) {
      $acronym .= mb_substr( $w, 0, 1 );
    }
    return $acronym;
  }
  
  public function storeApplication()
  {
    $validate = $this->validate();
  }
  
  public function applyNow( Project $project )
  {
    $this->applyPanel = true;
    $this->project_id = $project->id;
    $this->diplomaName = $project->diploma->name;
    $this->status = 'Pending Payment';
    $this->challan_number = $this->getFirstLetter( $project->diploma->name ) . '-' . $project->id . '-' . rand( 1,
        1000 );
  }
  
  public function toggleSection()
  {
    $this->applyPanel = false;
    $this->resetForm();
  }
  
  public function resetForm()
  {
    $this->reset( [
      'quota',
      'status',
      'diplomaName',
      'project_id',
      'challan_number',
    ] );
    $this->resetErrorBag( [
      'quota',
      'status',
      'diplomaName',
      'project_id',
      'challan_number',
    ] );
    
  }
  
}
