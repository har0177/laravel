<?php

namespace App\Livewire;

use App\Enums\TaxonomyTypeEnum;
use App\Models\Project;
use App\Models\Taxonomy;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectList extends Component
{
  use WithPagination;
  
  public $active;
  public $search;
  public $sortBy      = 'id';
  public $sortAsc     = true;
  public $create      = false;
  public $editProject = null;
  
  protected $queryString = [
    'active',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editProject'
  ];
  
  #[Rule( 'required' )]
  public $diploma_id  = null;
  public $diplomaList = [];
  #[Rule( 'required' )]
  public $fee         = '';
  #[Rule( 'required|array' )]
  public $quota       = [];
  public $quotaList   = '';
  #[Rule( 'required' )]
  public $expiry_date = '';
  #[Rule( 'required' )]
  public $description = '';
  
  public function mount()
  {
    $this->diplomaList = Taxonomy::whereType( TaxonomyTypeEnum::DIPLOMA )->get();
    $this->quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )->get();
  }
  
  public function render()
  {
    $query = Project::query();
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->whereHas( 'diploma', function( $qqq ) {
          $qqq->where( 'name', 'LIKE', '%' . $this->search . '%' );
        } );
      } );
    } )->when( $this->active, function( $q ) {
      return $q->where( 'expiry_date', '>=', now() );
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $projects = $query->paginate( 10 );
    
    return view( 'livewire.projects', [
      'projects' => $projects
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
    if( $this->editProject ) {
      Project::where( 'id', $this->editProject )->update( $validate );
      $this->toggleSection();
      session()->flash( 'success', 'Project updated successfully.' );
      return;
    }
    Project::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'Project added successfully.' );
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function edit( $id )
  {
    $this->editProject = $id;
    $project = Project::findOrFail( $id );
    $this->diploma_id = $project->diploma_id;
    $this->fee = $project->fee;
    $this->description = $project->description;
    $this->quota = $project->quota;
    $this->expiry_date = $project->expiry_date;
    
    $this->create = true;
  }
  
  public function resetForm()
  {
    $this->reset( [ 'fee', 'description', 'quota', 'diploma_id', 'expiry_date' ] );
  }
  
  public function deleteProject( Project $project )
  {
    if( $project->applications->count() > 0 ) {
      session()->flash( 'error', 'Project has applications submitted, so can not be deleted.' );
      return true;
    }
    $project->delete();
    session()->flash( 'success', 'Project Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
