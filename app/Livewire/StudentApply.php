<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\Project;
use App\Models\Taxonomy;
use http\Client\Curl\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StudentApply extends Component
{
  
  public $applyPanel         = false;
  public $project_id         = '';
  public $application_number = '';
  public $diplomaName        = '';
  #[Rule( 'required|array|min:1|max:2' )]
  public $quota     = [];
  public $quotaList = '';
  public $status    = '';
  
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
    $applications = Application::where( 'user_id', auth()->user()->id )->pluck( 'project_id' )->toArray();
    return view( 'livewire.student.apply', [ 'projects' => $projects, 'applications' => $applications ] );
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
  
  public function checkQuota()
  {
    $userGender = auth()->user()->userInfo->gender->name;
    
    foreach( $this->quota as $selectedQuota ) {
      $quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
      if( str_contains( $quotaName, 'Female' ) && $userGender === 'Male' ) {
        $this->addError( 'quota', 'You cannot apply for Female Quota' );
        return;
      }
    }
  }
  
  public function storeApplication()
  {
    $validate = $this->validate();
    try {
      $validate[ 'user_id' ] = auth()->user()->id;
      $validate[ 'project_id' ] = $this->project_id;
      $validate[ 'status' ] = $this->status;
      $validate[ 'application_number' ] = $this->application_number;
      $selectedQuotas = $validate[ 'quota' ];
      $userGender = auth()->user()->userInfo->gender->name;
      
      foreach( $selectedQuotas as $selectedQuota ) {
        $quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
        if( str_contains( $quotaName, 'Female' ) && $userGender === 'Male' ) {
          
          $this->addError( 'quota', 'You cannot apply for Female Quota' );
          return;
        }
      }
      Application::create( $validate );
      session()->flash( 'success', 'You have successfully applied for ' . $this->diplomaName );
      $this->applyPanel = false;
      $this->toggleSection();
      return;
    } catch ( \Exception $e ) {
      session()->flash( 'error',
        'An error occurred while saving the education details. Please try to fill the form again.' );
    }
  }
  
  public function applyNow( Project $project )
  {
    $this->applyPanel = true;
    $this->project_id = $project->id;
    $this->diplomaName = $project->diploma->name;
    $this->status = 'Pending Payment';
    $this->application_number = $this->getFirstLetter( $project->diploma->name ) . '-' . $project->id . '-' . rand( 1,
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
      'application_number',
    ] );
    $this->resetErrorBag( [
      'quota',
      'status',
      'diplomaName',
      'project_id',
      'application_number',
    ] );
    
  }
  
}
