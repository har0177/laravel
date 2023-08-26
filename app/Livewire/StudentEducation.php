<?php

namespace App\Livewire;

use App\Enums\TaxonomyTypeEnum;
use App\Models\Education;
use App\Models\Taxonomy;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StudentEducation extends Component
{
  use WithPagination;
  
  public $create         = false;
  public $editEducation  = null;
  public $educationAdded = false;
  
  protected $queryString = [
    'editEducation'
  ];
  
  #[Rule( 'required' )]
  public $degree_id;
  #[Rule( 'required|min:2|max:50' )]
  public $board;
  #[Rule( 'required|numeric|min_digits:1|max_digits:4' )]
  public $obtained_marks;
  #[Rule( 'required|numeric|min_digits:1|max_digits:4' )]
  public $total_marks;
  public $percentage;
  #[Rule( 'required' )]
  public $result_declaration_date;
  #[Rule( 'required' )]
  public $grade;
  #[Rule( 'required' )]
  public $roll_number;
  public $degreeList = [];
  
  public function mount()
  {
    $profileStatus = auth()->user()->userInfo?->profile_status;
    if( !$profileStatus ) {
      session()->flash( 'error', 'Please Update Profile First.' );
      
      return $this->redirect( '/profile', navigate: true );
    }
    $this->degreeList = Taxonomy::whereType( TaxonomyTypeEnum::DEGREE )->get();
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
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    $validate = $this->validate();
    $resultDate = Carbon::parse( $this->result_declaration_date );
    if( $resultDate->isAfter( Carbon::now() ) ) {
      $this->addError( 'result_declaration_date', "Result Date must be in past." );
      return;
    }
    if( !preg_match( '/^[\pL\s]+$/u', $this->board ) ) {
      $this->addError( 'board', "Board Name must use Alphabets and spaces." );
      return;
    }
    
    $education = Education::where( 'degree_id', $this->degree_id )
                          ->where( 'user_id',
                            auth()->user()->id );
    
    $totalMarks = (int) $this->total_marks;
    if( $totalMarks > 0 ) {
      $validate[ 'percentage' ] = round( ( (int) $this->obtained_marks / $totalMarks ) * 100, 2 );
    } else {
      $this->addError( 'total_marks', "Total Marks should be greater than 0." );
      return;
    }
    if( $this->obtained_marks > $totalMarks ) {
      $this->addError( 'obtained_marks', "Obtained Marks should be equal or less than Total Marks." );
      return;
    }
    try {
      $validate[ 'user_id' ] = auth()->user()->id;
      
      if( $this->editEducation ) {
        $education = $education->where( 'id', '!=', $this->editEducation )->first();
        if( !$education ) {
          Education::where( 'id', $this->editEducation )->update( $validate );
          $this->toggleSection();
          session()->flash( 'success', 'Education updated successfully.' );
          return;
        }
        session()->flash( 'error', 'This education is already exist.' );
        return;
      }
      $education = $education->first();
      if( !$education ) {
        Education::create( $validate );
        $this->educationAdded = true;
        session()->put( 'showApplyLink', true );
        $this->toggleSection();
        session()->flash( 'success', 'Education added successfully.' );
        return;
      }
      session()->flash( 'error', 'This education is already exist.' );
    } catch ( \Exception $e ) {
      session()->flash( 'error',
        'An error occurred while saving the education details, do not use autocomplete. Please try again to fill the form.' );
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
    $this->roll_number = $education->roll_number;
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
      'roll_number',
    ] );
    $this->resetErrorBag( [
      'degree_id',
      'board',
      'obtained_marks',
      'total_marks',
      'percentage',
      'result_declaration_date',
      'grade',
      'roll_number'
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
