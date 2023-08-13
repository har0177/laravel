<?php

namespace App\Livewire;

use App\Models\Education;
use App\Models\Taxonomy;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StudentEducation extends Component
{
  use WithPagination;
  
  public $search;
  public $sortBy        = 'id';
  public $sortAsc       = true;
  public $create        = false;
  public $editEducation = null;
  
  protected $queryString = [
    'active',
    'search',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editEducation'
  ];
  
  #[Rule( 'required' )]
  public $degree_id = '';
  #[Rule( 'required|min:2|max:50' )]
  public $board = '';
  #[Rule( 'required|numeric' )]
  public $obtained_marks = '';
  #[Rule( 'required|numeric' )]
  public $total_marks = '';
  public $percentage  = '';
  #[Rule( 'required' )]
  public $result_declaration_date = '';
  public $grade                   = '';
  public $degreeList = [];
  public $subDegreeList = [];
  
  
  public function mount()
  {
    $this->degreeList = Taxonomy::whereType( Taxonomy::DEGREE )->get();
    $this->subDegreeList = Taxonomy::whereType( Taxonomy::SUBDEGREE )->get();
  }
  
  public function render()
  {
    $educations = Education::where( 'user_id', auth()->user()->id )
                      ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' )->paginate( 10 );
    return view( 'livewire.student.education', [
      'educations' => $educations
    ] );
  }
  
  public function updateResultDeclarationDate( $value )
  {
    $this->resultDateValidation( $value );
    
  }
  
  public function resultDateValidation( $value )
  {
    $resultDate = Carbon::parse( $value );
    if( $resultDate->isBefore( Carbon::now() ) ) {
      $this->addError( 'result_declaration_date', "Result Date must be in past." );
    }
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    $validate = $this->validate();
    $validate[ 'user_id' ] = auth()->user()->id;
    if( $this->editEducation ) {
      Education::where( 'id', $this->editEducation )->update( $validate );
      $this->toggleSection();
      session()->flash( 'success', 'Education updated successfully.' );
      return;
    }
    
    Education::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'Education added successfully.' );
  }
  
  public function edit( $id )
  {
    $this->editEducation = $id;
    $education = Education::findOrFail( $id );
    $this->board = $education->board;
    $this->degree_id = $education->degree_id;
    $this->percentage = $education->percentage;
    $this->obtained_marks = $education->obtained_marks;
    $this->total_marks = $education->total_marks;
    $this->result_declaration_date = $education->result_declaration_date;
    $this->grade = $education->grade;
    $this->create = true;
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->editEducation = null;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function resetForm()
  {
    $this->reset();
  }
  
  public function deleteEducation( Education $education )
  {
    $education->delete();
    session()->flash( 'success', 'Education Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
