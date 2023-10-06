<?php
		namespace App\Livewire;
		use App\Helper\Common;
		use App\Models\Content;
		use Livewire\Component;
		use Livewire\WithPagination;
		class ContentList extends Component
		{
				use WithPagination;
				public    $search;
				public    $sortBy         = 'id';
				public    $sortAsc        = true;
				public    $create         = false;
				public    $editContent    = null;
				public    $title          = '';
				public    $description    = '';
				public    $errorMessage;
				public    $changeStatusId = '';
				protected $queryString    = [
						'search',
						'sortBy' => [ 'except' => 'id' ],
						'sortAsc',
						'editContent'
				];
				public function render()
				{
						$query = Content::query();
						$query->when( $this->search, function( $q ) {
								return $q->where( "title LIKE ?", [ '%' . $this->search . '%' ] );
						} )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
						$contents = $query->take( 50 ) // Limit the query to retrieve only the latest 50 records
						                  ->get(); // Retrieve all 50 records
						$contents = Common::showPerPage( 10, $contents );
						
						return view( 'livewire.contents', [
								'contents' => $contents
						] );
				}
				public function add()
				{
						$this->create = true;
				}
				public function store()
				{
						
						$this->validate();
						$data = [
								'title'       => $this->title,
								'description' => $this->description,
						];
						if( !$this->editContent ) {
								Content::create( $data );
								session()->flash( 'success', 'Content added successfully.' );
						} else {
								$content = Content::find( $this->editContent );
								$content->update( $data );
								session()->flash( 'success', 'Content updated successfully.' );
						}
						$this->toggleSection();
						
				}
				public function updateStatus( Content $content )
				{
						$status = $content->status === 'Active' ? 'De-Active' : 'Active';
						$content->status = $status;
						$content->save();
						session()->flash( 'success', 'Content Status changed Successfully.' );
				}
				public function toggleSection()
				{
						$this->create = false;
						$this->editContent = null;
						$this->resetForm();
						$this->resetPage();
				}
				public function resetForm()
				{
						$this->reset( [
								'title',
								'description',
						] );
						$this->resetErrorBag( [
								'title',
								'description',
						] );
				}
				public function edit( $id )
				{
						$content = Content::findOrFail( $id );
						$this->editContent = $id;
						$this->title = $content->title;
						$this->description = $content->description;
						$this->create = true;
				}
				public function changeStatus( Content $content )
				{
						$this->changeStatusId = $content->id;
				}
				public function deleteContent()
				{
						$content = Content::find( $this->changeStatusId );
						$content->delete();
						$this->changeStatusId = '';
						session()->flash( 'success', 'Content Deleted Successfully.' );
				}
				public function sortField( $field )
				{
						if( $field === $this->sortBy ) {
								$this->sortAsc = !$this->sortAsc;
						}
						$this->sortBy = $field;
				}
				protected function rules()
				{
						return [
								'title'       => 'required|min:2|max:50',
								'description' => 'required',
						];
				}
		}
