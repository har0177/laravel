<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\Taxonomy;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicationList extends Component
{
  use WithPagination;
  
  public $paid;
  public $search;
  public $sortBy  = 'id';
  public $sortAsc = true;
  public $create  = false;
  
  protected $queryString = [
    'paid',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
  ];
  
  public function render()
  {
    $query = Application::query();
    $query->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $applications = $query->paginate( 10 );
    
    $query = Application::query();
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'first_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'last_name', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'username', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'phone', 'LIKE', '%' . $this->search . '%' )
           ->orWhere( 'email', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->when( $this->paid, function( $q ) {
      return $q->where( 'status', 'Applied' );
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
  
  public function expiryDateValidation( $value )
  {
    $expiryDate = Carbon::parse( $value );
    if( $expiryDate->isBefore( Carbon::now() ) ) {
      $this->addError( 'expiry_date', "Expiry Date must be in future." );
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
  
  public function edit( $id )
  {
    $this->editApplication = $id;
    $application = Application::findOrFail( $id );
    $this->diploma_id = $application->diploma_id;
    $this->fee = $application->fee;
    $this->description = $application->description;
    $this->quota = $application->quota;
    $this->expiry_date = $application->expiry_date;
    
    $this->create = true;
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
