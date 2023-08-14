<?php

namespace App\Livewire;

use App\Models\Slide;
use App\Models\Slide;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class SlideList extends Component
{
  use WithPagination;
  
  public $sortBy  = 'id';
  public $sortAsc = true;
  public $create  = false;
  
  protected $queryString = [
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc'
  ];
  
  #[Rule( 'required' )]
  public $url = '';
  #[Rule( 'required' )]
  public $type      = '';
  public $status    = 'Show';
  public $activeTab = '';
  
  public function render()
  {
    $query = Slide::query();
    $query->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $slides = $query->paginate( 10 );
    
    return view( 'livewire.slides', [
      'slides' => $slides
    ] );
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    $validate = $this->validate();
    
    Slide::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'Slide added successfully.' );
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function resetForm()
  {
    $this->reset( [ 'url', 'type', 'status' ] );
  }
  
  public function deleteSlide( Slide $slide )
  {
    $slide->delete();
    session()->flash( 'success', 'Slide Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
