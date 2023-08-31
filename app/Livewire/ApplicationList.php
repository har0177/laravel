<?php

namespace App\Livewire;

use App\Enums\TaxonomyTypeEnum;
use App\Models\Application;
use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicationList extends Component
{
  use WithPagination;
  
  public $paid;
  public $search;
  public $sortBy             = 'id';
  public $sortAsc            = true;
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
  public $changeStatusId     = '';
  
  protected $queryString = [
    'paid',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
  ];
  
  public function render()
  {
    
    $query = Application::query();
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'challan_number', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'application_number', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->when( $this->paid, function( $q ) {
      return $q->where( 'status', 'Paid' );
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $applications = $query->paginate( 10 );
    
    return view( 'livewire.applications', [
      'applications' => $applications
    ] );
  }
  
  public function updateExpiryDate()
  {
    $this->expiryDateValidation( $this->expiry_date );
  }
  
  public function changeStatus( Application $application )
  {
    $this->changeStatusId = $application->id;
  }
  
  public function paymentStatus()
  {
    $application = Application::find( $this->changeStatusId );
    $application->status = 'Paid';
    $application->save();
    session()->flash( 'success', 'Payment status changed to Paid Successfully.' );
    
  }
  
  public function expiryDateValidation( $value )
  {
    $expiryDate = Carbon::parse( $value );
    if( $expiryDate->isBefore( Carbon::now() ) ) {
      $this->addError( 'expiry_date', "Expiry Date must be in future." );
    }
  }
  
  public function checkQuota()
  {
    
    $user = $this->user->userInfo;
    foreach( $this->quota as $selectedQuota ) {
      $quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
      if( str_contains( $quotaName, 'Female' ) && $user->gender->name === 'Male' ) {
        $this->addError( 'quota', 'You cannot apply for Female Quota' );
        return;
      }
      if( !str_contains( $quotaName, 'Female' ) && $user->gender->name === 'Female' ) {
        $this->addError( 'quota', 'Female can only apply to Female Quota.' );
        return;
      }
      if( !str_contains( $quotaName, 'FATA' ) && in_array( $user->district_id,
          [ 70, 71, 72, 73, 74, 75, 76 ] ) ) {
        $this->addError( 'quota', 'FATA Candidates can only apply for Newly Merged Districts (FATA) Quota.' );
        return;
      }
      if( str_contains( $quotaName, 'FATA' ) && !in_array( $user->district_id,
          [ 70, 71, 72, 73, 74, 75, 76 ] ) ) {
        $this->addError( 'quota', 'You cannot apply for  Newly Merged Districts (FATA) Quota' );
        return;
      }
      if( str_contains( $quotaName, 'Open' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
        $this->addError( 'quota', 'Gilgit Baltistan Candidates only apply to Gilgit Baltistan Quota.' );
        return;
      }
      if( str_contains( $quotaName, 'Agriculture' ) && count( $this->quota ) > 2 ) {
        $this->addError( 'quota', 'You can only apply to Agriculture & Livestock OR ASA Employees Son & Open Merit' );
        return;
      }
      if( str_contains( $quotaName, 'ASA' ) && count( $this->quota ) > 2 ) {
        $this->addError( 'quota', 'You can only apply to Agriculture & Livestock OR ASA Employees Son & Open Merit' );
        return;
      }
      if( str_contains( $quotaName, 'Gilgit' ) && !str_contains( $user->province->name, 'Gilgit' ) ) {
        $this->addError( 'quota', 'You cannot apply for Gilgit Baltistan Quota' );
        return;
      }
      if( str_contains( $quotaName, 'FATA' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
        $this->addError( 'quota', 'You cannot apply for Newly Merged Districts (FATA) Quota' );
        return;
      }
      if( str_contains( $quotaName, 'Disabled' ) && count( $this->quota ) > 2 ) {
        $this->addError( 'quota', 'Disabled can only apply to disabled quota & Open Merit' );
        return;
      }
    }
    
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    
    $validate = $this->validate();
    $expiryDate = Carbon::parse( $this->expiry_date );
    if( $expiryDate->isBefore( Carbon::now() ) ) {
      $this->addError( 'expiry_date', "Expiry Date must be in future." );
      return;
    }
    if( $this->editApplication ) {
      Application::where( 'id', $this->editApplication )->update( $validate );
      $this->toggleSection();
      session()->flash( 'success', 'Application updated successfully.' );
      return;
    }
    Application::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'Application added successfully.' );
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function edit( Application $application )
  {
    $this->editApplication = $application->id;
    $this->quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )
                               ->where( 'id', '!=', 33 )
                               ->get();
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
    $editApplication = Application::find( $this->editApplication );
    
    $this->user = User::find( $editApplication->user_id );
    
    $this->applyPanel = true;
  }
  
  public function updateApplication()
  {
    $validate = $this->validate();
    
    $user = $this->user;
    
    try {
      $validate[ 'user_id' ] = $user->id;
      $validate[ 'project_id' ] = $this->project_id;
      $validate[ 'status' ] = $this->status;
      $validate[ 'application_number' ] = $this->application_number;
      $selectedQuotas = $validate[ 'quota' ];
      $userInfo = $user->userInfo;
      foreach( $selectedQuotas as $selectedQuota ) {
        $quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
        if( str_contains( $quotaName, 'Female' ) && $userInfo->gender->name === 'Male' ) {
          $this->addError( 'quota', 'You cannot apply for Female Quota' );
          return;
        }
        if( !str_contains( $quotaName, 'Female' ) && $userInfo->gender->name === 'Female' ) {
          $this->addError( 'quota', 'Female can only apply to Female Quota.' );
          return;
        }
        if( !str_contains( $quotaName, 'FATA' ) && in_array( $userInfo->district_id,
            [ 70, 71, 72, 73, 74, 75, 76 ] ) ) {
          $this->addError( 'quota', 'FATA Candidates can only apply for Newly Merged Districts (FATA) Quota.' );
          return;
        }
        if( str_contains( $quotaName, 'FATA' ) && !in_array( $userInfo->district_id,
            [ 70, 71, 72, 73, 74, 75, 76 ] ) ) {
          $this->addError( 'quota', 'You cannot apply for  Newly Merged Districts (FATA) Quota' );
          return;
        }
        if( str_contains( $quotaName, 'Open' ) && str_contains( $userInfo->province->name, 'Gilgit' ) ) {
          $this->addError( 'quota', 'Gilgit Baltistan Candidates only apply to Gilgit Baltistan Quota.' );
          return;
        }
        
        if( str_contains( $quotaName, 'Agriculture' ) && count( $this->quota ) > 2 ) {
          $this->addError( 'quota',
            'You can only apply to Agriculture & Livestock OR ASA Employees Son & Open Merit' );
          return;
        }
        if( str_contains( $quotaName, 'ASA' ) && count( $this->quota ) > 2 ) {
          $this->addError( 'quota',
            'You can only apply to Agriculture & Livestock OR ASA Employees Son & Open Merit' );
          return;
        }
        
        if( str_contains( $quotaName, 'Gilgit' ) && !str_contains( $userInfo->province->name, 'Gilgit' ) ) {
          $this->addError( 'quota', 'You cannot apply for Gilgit Baltistan Quota' );
          return;
        }
        if( str_contains( $quotaName, 'FATA' ) && str_contains( $userInfo->province->name, 'Gilgit' ) ) {
          $this->addError( 'quota', 'You cannot apply for Newly Merged Districts (FATA) Quota' );
          return;
        }
        if( str_contains( $quotaName, 'Disabled' ) && count( $this->quota ) > 2 ) {
          $this->addError( 'quota', 'Disabled can only apply to disabled quota & Open Merit' );
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
        $e->getMessage() );
    }
    
  }
  
  public function resetForm()
  {
    $this->reset( [ 'fee', 'description', 'quota', 'diploma_id', 'expiry_date' ] );
  }
  
  public function deleteApplication( Application $application )
  {
    if( $application->applications->count() > 0 ) {
      session()->flash( 'error', 'Application has applications submitted, so can not be deleted.' );
      return true;
    }
    $application->delete();
    session()->flash( 'success', 'Application Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
