<?php

namespace App\Livewire;

use App\Enums\TaxonomyTypeEnum;
use App\Models\Application;
use App\Models\Project;
use App\Models\Taxonomy;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StudentApply extends Component
{
  
  public $applyPanel         = false;
  public $editApplication    = null;
  public $project_id         = '';
  public $application_number = '';
  public $challan_number     = '';
  public $diplomaName        = '';
  #[Rule( 'required|array|min:1' )]
  public $quota              = [ '33' ];
  public $quotaList          = '';
  public $user               = '';
  public $status             = 'Pending';
  
  public function mount()
  {
    $education = auth()->user()->education->count();
    if( $education < 1 ) {
      session()->flash( 'error', 'Please add at least one education.' );
      
      return $this->redirect( '/education', navigate: true );
    }
    $this->quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )
                               ->where( 'id', '!=', 33 )
                               ->get();
  }
  
  public function render()
  {
    $userId = auth()->user()->id;
    
    $projects = Project::with( [
      'applications' => function( $query ) use ( $userId ) {
        $query->where( 'user_id', $userId );
      }
    ] )
                       ->where( 'expiry_date', '>', now() )
                       ->get();
    return view( 'livewire.student.apply', [ 'projects' => $projects ] );
  }
  
  public function edit( Application $application )
  {
    $this->editApplication = $application->id;
    $this->quota = $application->quota;
    $this->application_number = $application->application_number;
    $this->challan_number = $application->challan_number;
    $this->status = $application->status;
    $this->project_id = $application->project_id;
    $this->quotaList = $this->quotaList
      ->filter( function( $taxonomy ) use ( $application ) {
        return in_array( $taxonomy->id, $application->project->quota );
      } )
      ->map( function( $taxonomy ) {
        return $taxonomy;
      } );
    $this->applyPanel = true;
  }
  
  public function getFirstLetter( $value )
  {
    $excludedWords = [ "In", "The", "Of", 'in', 'the', 'of' ];
    $words = explode( " ", $value );
    $acronym = "";
    
    foreach( $words as $w ) {
      if( !in_array( $w, $excludedWords ) ) {
        $acronym .= mb_substr( $w, 0, 1 );
      }
    }
    return $acronym;
  }
  
  public function checkQuota()
  {
    $user = auth()->user()->userInfo;
    
    foreach( $this->quota as $selectedQuota ) {
      $quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
      if( str_contains( $quotaName, 'Female' ) && $user->gender->name === 'Male' ) {
        $this->addError( 'quota', 'You cannot apply for Female Quota' );
        return;
      }
      if( str_contains( $quotaName, 'Open' ) && $user->gender->name === 'Female' ) {
        $this->addError( 'quota', 'Female can only apply to Female Quota.' );
        return;
      }
      if( str_contains( $quotaName, 'Open' ) && in_array( $user->district_id,
          [ 70, 71, 72, 73, 74, 75, 76 ], true ) ) {
        $this->addError( 'quota', 'FATA Candidates only apply to Erstwhile Fata Quota.' );
        return;
      }
      if( str_contains( $quotaName, 'Open' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
        $this->addError( 'quota', 'Gilgit Baltistan Candidates only apply to Gilgit Baltistan Quota.' );
        return;
      }
      if( str_contains( $quotaName, 'Gilgit' ) && !str_contains( $user->province->name, 'Gilgit' ) ) {
        $this->addError( 'quota', 'You cannot apply for Gilgit Baltistan Quota' );
        return;
      }
      if( str_contains( $quotaName, 'Fata' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
        $this->addError( 'quota', 'You cannot apply for Erstwhile Fata Quota' );
        return;
      }
      if( str_contains( $quotaName, 'Disabled' ) && count( $this->quota ) >= 2 ) {
        $this->addError( 'quota', 'Disabled can only apply to disabled quota' );
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
      $user = auth()->user()->userInfo;
      foreach( $selectedQuotas as $selectedQuota ) {
        $quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
        if( str_contains( $quotaName, 'Female' ) && $user->gender->name === 'Male' ) {
          $this->addError( 'quota', 'You cannot apply for Female Quota' );
          return;
        }
        if( str_contains( $quotaName, 'Open' ) && $user->gender->name === 'Female' ) {
          $this->addError( 'quota', 'Female can only apply to Female Quota.' );
          return;
        }
        if( str_contains( $quotaName, 'Open' ) && in_array( $user->district_id,
            [ 70, 71, 72, 73, 74, 75, 76 ], true ) ) {
          $this->addError( 'quota', 'FATA Candidates only apply to Erstwhile Fata Quota.' );
          return;
        }
        if( str_contains( $quotaName, 'Open' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
          $this->addError( 'quota', 'Gilgit Baltistan Candidates only apply to Gilgit Baltistan Quota.' );
          return;
        }
        if( str_contains( $quotaName, 'Gilgit' ) && !str_contains( $user->province->name, 'Gilgit' ) ) {
          $this->addError( 'quota', 'You cannot apply for Gilgit Baltistan Quota' );
          return;
        }
        if( str_contains( $quotaName, 'Fata' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
          $this->addError( 'quota', 'You cannot apply for Erstwhile Fata Quota' );
          return;
        }
        if( str_contains( $quotaName, 'Disabled' ) && count( $this->quota ) >= 2 ) {
          $this->addError( 'quota', 'Disabled can only apply to disabled quota' );
          return;
        }
        
      }
      if( $this->editApplication ) {
        $application = Application::findOrFail( $this->editApplication );
        $application->update( $validate );
        session()->flash( 'success', 'Application for ' . $this->diplomaName . ' has been updated.' );
      } else {
        Application::create( $validate );
        session()->flash( 'success', 'You have successfully applied for ' . $this->diplomaName );
      }
      $this->applyPanel = false;
      $this->toggleSection();
      return;
    } catch ( \Exception $e ) {
      session()->flash( 'error',
        'An error occurred while saving the application. Please try again.' );
    }
  }
  
  public function applyNow( Project $project )
  {
    $this->applyPanel = true;
    $this->project_id = $project->id;
    $this->diplomaName = $project->diploma->name;
    $this->application_number = $this->getFirstLetter( $project->diploma->name ) . '-' . $project->id . '-' . rand( 1,
        1000 );
    $this->user = auth()->user();
    $this->quotaList = $this->quotaList
      ->filter( function( $taxonomy ) use ( $project ) {
        return in_array( $taxonomy->id, $project->quota );
      } )
      ->map( function( $taxonomy ) {
        return $taxonomy;
      } );
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
  
  public function saveChallan( Application $application )
  {
    $this->validate( [
      'challan_number' => 'required',
    ] );
    
    $application->challan_number = $this->challan_number;
    $application->save();
    
    // Add any success message if needed
    session()->flash( 'success', 'Challan Number submitted successfully.' );
  }
  
}
