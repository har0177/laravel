<?php

namespace App\Livewire;

use App\Models\Taxonomy;
use Livewire\Component;
use Livewire\WithPagination;

class TaxonomyList extends Component
{
  use WithPagination;
  
  public $search;
  public $type;
  public $sortBy       = 'id';
  public $sortAsc      = true;
  public $create       = false;
  public $editTaxonomy = null;
  
  protected $queryString = [
    'search',
    'type',
    'sortBy' => [ 'except' => 'id' ],
    'sortAsc',
    'editTaxonomy'
  ];
  
  public $name = '';
  
  public function render()
  {
    
    $query = Taxonomy::where( 'type', $this->type );
    $query->when( $this->search, function( $q ) {
      return $q->where( function( $qq ) {
        $qq->where( 'name', 'LIKE', '%' . $this->search . '%' );
      } );
    } )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
    $taxonomies = $query->paginate( 10 );
    
    return view( 'livewire.taxonomies', [
      'taxonomies' => $taxonomies
    ] );
  }
  
  public function add()
  {
    $this->create = true;
  }
  
  public function store()
  {
    
    if( $this->editTaxonomy ) {
      $validate = $this->validate( [
        'name' => 'required|string|max:255|unique:taxonomies,name,' . $this->editTaxonomy
      ] );
      
      Taxonomy::where( 'id', $this->editTaxonomy )->update( [
        'name' => $validate[ 'name' ]
      ] );
      
      $this->toggleSection();
      session()->flash( 'success', 'Taxonomy updated successfully.' );
      return;
    }
    $validate = $this->validate( [
      'name' => 'required|string|max:255|unique:taxonomies'
    ] );
    $validate[ 'type' ] = $this->type;
    Taxonomy::create( $validate );
    $this->toggleSection();
    session()->flash( 'success', 'Taxonomy added successfully.' );
  }
  
  public function edit( $id )
  {
    $this->editTaxonomy = $id;
    $taxonomy = Taxonomy::findOrFail( $id );
    $this->name = $taxonomy->name;
    $this->create = true;
  }
  
  public function toggleSection()
  {
    $this->create = false;
    $this->editTaxonomy = null;
    $this->resetForm();
    $this->resetPage();
  }
  
  public function resetForm()
  {
    $this->reset( [ 'name' ] );
  }
  
  public function deleteTaxonomy( Taxonomy $taxonomy )
  {
    $taxonomy->delete();
    session()->flash( 'success', 'Taxonomy Deleted Successfully.' );
  }
  
  public function sortField( $field )
  {
    if( $field === $this->sortBy ) {
      $this->sortAsc = !$this->sortAsc;
    }
    $this->sortBy = $field;
  }
  
}
