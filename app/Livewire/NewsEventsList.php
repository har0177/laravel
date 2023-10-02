<?php

namespace App\Livewire;

use App\Models\NewsEvents;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NewsEventsList extends Component
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
  public $type        = '';
  public $description = '';
  #[Rule( 'required' )]
  public $title       = '';
  #[Rule( 'required' )]
  public $expiry_date = '';
  public $status      = 'Show';
  public $file        = '';
  
  public function render()
  {
    $query = NewsEvents::query();
    $query->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $slides = $query->paginate( 10 );
    
    return view( 'livewire.events', [
      'events' => $slides
    ] );
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
    if( $validate[ 'type' ] === 'File' ) {
      $this->validate( [ 'file' => 'required' ] );
    }
    if( $validate[ 'type' ] === 'Text' ) {
      $this->validate( [ 'description' => 'required' ] );
    }
    $slide = NewsEvents::create( [
      'type'        => $this->type,
      'title'       => $this->title,
      'description' => $this->description,
      'expiry_date' => $this->expiry_date
    ] );
    if( $this->file ) {
      $slide->clearMediaCollection( 'events' );
      $slide->addMedia( $this->file )->toMediaCollection( 'events' );
    }
    $this->toggleSection();
    session()->flash( 'success', 'News and Events added successfully.' );
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->resetForm();
    $this->resetPage();
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
  
  
  public function resetForm()
  {
    $this->reset( [ 'description', 'type', 'expiry_date', 'file', 'title' ] );
  }
  
  public function deleteEvent( NewsEvents $event )
  {
    if( $event->hasMedia( 'events' ) ) {
      $event->clearMediaCollection( 'events' );
    }
    $event->delete();
    session()->flash( 'success', 'News and Events  Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
