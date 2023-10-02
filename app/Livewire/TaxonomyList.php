<?php
		namespace App\Livewire;
		use App\Models\Taxonomy;
		use Livewire\Component;
		use Livewire\WithPagination;
		class TaxonomyList extends Component
		{
				use WithPagination;
				public    $search;
				public    $type;
				public    $sortBy       = 'id';
				public    $sortAsc      = true;
				public    $create       = false;
				public    $editTaxonomy = null;
				public    $name         = '';
				protected $queryString  = [
						'search',
						'type',
						'sortBy' => [ 'except' => 'id' ],
						'sortAsc',
						'editTaxonomy'
				];
				public function render()
				{
						
						$taxonomies = Taxonomy::where( 'type', $this->type );
						$taxonomies->when( $this->search, function( $q ) {
								return $q->where( function( $qq ) {
										$qq->where( 'name', 'LIKE', '%' . $this->search . '%' );
								} );
						} )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' )
						      ->latest() // Order by the default timestamp column in descending order (usually 'created_at')
						      ->take( 100 ) // Limit to the latest 100 records
						      ->paginate( 20 );
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
								session()->flash( 'success', 'Taxonomy updated successfully.' );
								
						} else {
								$validate = $this->validate( [
										'name' => 'required|string|max:255|unique:taxonomies'
								] );
								$validate[ 'type' ] = $this->type;
								Taxonomy::create( $validate );
								session()->flash( 'success', 'Taxonomy added successfully.' );
								
						}
						$this->toggleSection();
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
				public function edit( $id )
				{
						$this->editTaxonomy = $id;
						$taxonomy = Taxonomy::findOrFail( $id );
						$this->name = $taxonomy->name;
						$this->create = true;
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
