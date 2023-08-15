<?php

namespace App\Livewire;

use App\Models\Education;
use App\Models\Taxonomy;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StudentEducation extends Component
{
  use WithPagination;
  
  public $create        = false;
  public $editEducation = null;
  public $educationAdded = false;
  
  
  protected $queryString = [
    'editEducation'
  ];
  
  #[Rule( 'required' )]
  public            $degree_id;
  #[Rule( 'required|min:2|max:50' )]
  public            $board;
  #[Rule( 'required|numeric' )]
  public            $obtained_marks;
  #[Rule( 'required|numeric' )]
  public            $total_marks;
  public            $percentage;
  #[Rule( 'required' )]
  public            $result_declaration_date;
  #[Rule( 'required' )]
  public            $grade;
  public Collection $degreeList;
  
  public function mount()
  {
    $this->degreeList = Taxonomy::whereType( Taxonomy::DEGREE )->get();
  }
  
  public function render()
  {
    $educations = Education::where( 'user_id', auth()->user()->id )
                         ->paginate( 10 );
    return view( 'livewire.student.education', [
      'educations' => $educations
    ] );
  }
  
  public function updateResultDeclarationDate()
  {
    $this->resultDateValidation( $this->result_declaration_date );
  }
  
  public function resultDateValidation( $value )
  {
    $resultDate = Carbon::parse( $value );
    if( $resultDate->isAfter( Carbon::now() ) ) {
      $this->addError( 'result_declaration_date', "Result Date must be in past." );
    }
  }
  
  public function updatedObtainedMarks( $value )
  {
    $totalMarks = (int) $this->total_marks;
    if( $totalMarks > 0 ) {
      $this->percentage = round( ( (int) $value / $totalMarks ) * 100, 2 );
    }
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    $validate = $this->validate();
    try {
      $validate[ 'user_id' ] = auth()->user()->id;
      $validate[ 'percentage' ] = $this->percentage;
      if( $this->editEducation ) {
        Education::where( 'id', $this->editEducation )->update( $validate );
        $this->toggleSection();
        session()->flash( 'success', 'Education updated successfully.' );
        return;
      }
      $education = Education::where( 'degree_id', $validate[ 'degree_id' ] )->where( 'user_id',
        auth()->user()->id )->first();
      if( !$education ) {
        Education::create( $validate );
        $this->educationAdded = true;
        session()->put('showApplyLink', true);
        $this->toggleSection();
        session()->flash( 'success', 'Education added successfully.' );
        return;
      }
      session()->flash( 'error', 'This education is already exist.' );
    } catch ( \Exception $e ) {
      session()->flash( 'error', 'An error occurred while saving the education details. Please try to fill the form again.' );
    }
    
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
    $this->reset( [
      'degree_id',
      'board',
      'obtained_marks',
      'total_marks',
      'percentage',
      'result_declaration_date',
      'grade',
    ] );
    $this->resetErrorBag( [
      'degree_id',
      'board',
      'obtained_marks',
      'total_marks',
      'percentage',
      'result_declaration_date',
      'grade'
    ] );
    
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
