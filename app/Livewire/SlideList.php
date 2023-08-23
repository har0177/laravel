<?php

namespace App\Livewire;

use App\Models\Slide;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SlideList extends Component
{
  use WithPagination, WithFileUploads;
  
  public $sortBy  = 'id';
  public $sortAsc = true;
  public $create  = false;
  
  protected $queryString = [
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc'
  ];
  
  #[Rule( 'required' )]
  public $type   = '';
  public $url    = '';
  public $status = 'Show';
  public $image  = [];
  
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
  
  public function updateStatus( Slide $slide )
  {
    $status = $slide->status === 'Show' ? 'Hide' : 'Show';
    $slide->status = $status;
    $slide->save();
    session()->flash( 'success', 'Slide Status changed Successfully.' );
  }
  
  public function store()
  {
    $validate = $this->validate();
    if( $validate[ 'type' ] === 'image' ) {
      $this->validate( [ 'image' => 'required' ] );
      foreach( $this->image as $key => $image ) {
        $slide = Slide::create( [
          'type' => $this->type,
        ] );
        $slide->clearMediaCollection( 'slides' );
        $slide->addMedia( $this->image[ $key ] )->toMediaCollection( 'slides' );
      }
    }
    
    if( $validate[ 'type' ] === 'video' ) {
      $this->validate( [ 'url' => 'required' ] );
      
      Slide::create( [
        'type' => $this->type,
        'url'  => $this->url
      ] );
    }
    
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
    $this->reset( [ 'url', 'type', 'status', 'image' ] );
  }
  
  public function deleteSlide( Slide $slide )
  {
    if( $slide->hasMedia( 'slides' ) ) {
      $slide->clearMediaCollection( 'slides' );
    }
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
