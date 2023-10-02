<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class GalleryList extends Component
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
  public $title  = '';
  public $status = 'Show';
  #[Rule( 'required' )]
  public $image  = [];
  
  public function render()
  {
    $query = Gallery::query();
    $query->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $gallery = $query->paginate( 10 );
    
    return view( 'livewire.gallery', [
      'gallery' => $gallery
    ] );
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function updateStatus( Gallery $gallery )
  {
    $status = $gallery->status === 'Show' ? 'Hide' : 'Show';
    $gallery->status = $status;
    $gallery->save();
    session()->flash( 'success', 'Gallery Status changed Successfully.' );
  }
  
  public function store()
  {
    foreach( $this->image as $key => $image ) {
      $gallery = Gallery::create( [
        'title' => $this->title,
      ] );
      $gallery->addMedia( $this->image[ $key ] )->toMediaCollection( 'gallery' );
    }
    
    $this->toggleSection();
    session()->flash( 'success', 'Gallery added successfully.' );
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function resetForm()
  {
    $this->reset( [  'title', 'status', 'image' ] );
  }
  
  public function deleteGallery( Gallery $gallery )
  {
    if( $gallery->hasMedia( 'gallery' ) ) {
      $gallery->clearMediaCollection( 'gallery' );
    }
    $gallery->delete();
    session()->flash( 'success', 'Gallery Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
