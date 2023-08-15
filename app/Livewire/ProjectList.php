<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Taxonomy;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class ProjectList extends Component
{
  use WithPagination;
  
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
  public $fee = '';
  #[Rule( 'required' )]
  public $quota = '';
  #[Rule( 'required' )]
  public $expiry_date = '';
  #[Rule( 'required' )]
  public $description = '';
  
  public function mount()
  {
    $this->diplomaList = Taxonomy::whereType( Taxonomy::DIPLOMA )->get();
  }
  
  public function render()
  {
    $query = Project::query();
    $query->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $projects = $query->paginate( 10 );
    
    return view( 'livewire.projects', [
      'projects' => $projects
    ] );
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    $validate = $this->validate();
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
