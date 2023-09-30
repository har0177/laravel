<?php
		namespace App\Livewire;
		use App\Enums\TaxonomyTypeEnum;
		use App\Models\Application;
		use App\Models\Project;
		use App\Models\Taxonomy;
		use Livewire\Attributes\Rule;
		use Livewire\Component;
		use Livewire\WithFileUploads;
		class StudentApply extends Component
		{
				use WithFileUploads;
				public $applyPanel         = false;
				public $editApplication    = null;
				public $project_id         = '';
				public $application_number = '';
				public $challan     = '';
				public $diplomaName        = '';
				#[Rule( 'required|array|min:1' )]
				public $quota              = [];
				public $quotaList          = '';
				public $user               = '';
				public $status             = 'Pending';
				public $cnic               = '';
				public $domicile           = '';
				public $dmc                = '';
				public $documentStatus     = false;
				public function mount()
				{
						$user = auth()->user();
						if( $user->hasMedia( 'dmc' ) && $user->hasMedia( 'domicile' ) && $user->hasMedia( 'cnic' ) ) {
								$this->documentStatus = true;
						}
						$education = $user->education->count();
						if( $education < 1 ) {
								session()->flash( 'error', 'Please add at least one education.' );
								return $this->redirect( '/education', navigate: true );
						}
						$this->quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )
						                           ->where( 'id', '!=', 33 )
						                           ->get();
				}
				public function render()
				{
						$userId = auth()->user()->id;
						$projects = Project::with( [
								'applications' => function( $query ) use ( $userId ) {
										$query->where( 'user_id', $userId );
								}
						] )
						                   ->where( 'expiry_date', '>', now() )
						                   ->get();
						return view( 'livewire.student.apply', [ 'projects' => $projects ] );
				}
				public function edit( Application $application )
				{
						$this->editApplication = $application->id;
						$this->quota = $application->quota;
						$this->application_number = $application->application_number;
						$this->status = $application->status;
						$this->project_id = $application->project_id;
						$this->quotaList = $this->quotaList
								->filter( function( $taxonomy ) use ( $application ) {
										return in_array( $taxonomy->id, $application->project->quota );
								} )
								->map( function( $taxonomy ) {
										return $taxonomy;
								} );
						$this->applyPanel = true;
				}
				public function storeApplication()
				{
						$validate = $this->validate();
						try {
								$validate[ 'user_id' ] = auth()->user()->id;
								$validate[ 'project_id' ] = $this->project_id;
								$validate[ 'status' ] = $this->status;
								$validate[ 'application_number' ] = $this->application_number;
								if( !$this->checkQuota() ) {
										if( $this->editApplication ) {
												$application = Application::findOrFail( $this->editApplication );
												$application->update( $validate );
												session()->flash( 'success', 'Application for ' . $this->diplomaName . ' has been updated.' );
										} else {
												Application::create( $validate );
												session()->flash( 'success', 'You have successfully applied for ' . $this->diplomaName );
										}
										$this->applyPanel = false;
										$this->toggleSection();
										return true;
								}
						} catch ( \Exception $e ) {
								session()->flash( 'error',
										'An error occurred while saving the application. Please try again.' );
						}
				}
				public function checkQuota()
				{
						$user = auth()->user()->student;
						foreach( $this->quota as $selectedQuota ) {
								$quotaName = Taxonomy::where( 'id', $selectedQuota )->first()->name;
								if( str_contains( $quotaName, 'Female' ) && $user->gender->name === 'Male' ) {
										$this->addError( 'quota', 'You cannot apply for Female Quota' );
										return true;
								}
								if( str_contains( $quotaName, 'Minority' ) && $user->religion->name === 'Islam' ) {
										$this->addError( 'quota', 'You cannot apply for Minority Quota' );
										return true;
								}
								if( str_contains( $quotaName, 'Minority' ) && count( $this->quota ) > 1 ) {
										$this->addError( 'quota', 'Minority can only apply to Minority quota' );
										return true;
								}
								if( $user->gender->name === 'Female' && !in_array( $user->district_id,
												[ 70, 71, 72, 73, 74, 75, 76, 93, 94, 95, 96, 97, 98 ] ) ) {
										if( !str_contains( $quotaName, 'Female' ) ) {
												$this->addError( 'quota', 'Female can only apply to Female Quota.' );
												return true;
										}
								}
								if( !str_contains( $quotaName, 'FATA' ) && in_array( $user->district_id,
												[ 70, 71, 72, 73, 74, 75, 76, 93, 94, 95, 96, 97, 98 ] ) ) {
										$this->addError( 'quota', 'FATA Candidates can only apply for Newly Merged Districts (FATA) Quota.' );
										return true;
								}
								if( str_contains( $quotaName, 'FATA' ) && !in_array( $user->district_id,
												[ 70, 71, 72, 73, 74, 75, 76, 93, 94, 95, 96, 97, 98 ] ) ) {
										$this->addError( 'quota', 'You cannot apply for  Newly Merged Districts (FATA) Quota' );
										return true;
								}
								if( str_contains( $quotaName, 'Open' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
										$this->addError( 'quota', 'Gilgit Baltistan Candidates only apply to Gilgit Baltistan Quota.' );
										return true;
								}
								if( str_contains( $quotaName, 'Agriculture' ) && count( $this->quota ) > 2 ) {
										$this->addError( 'quota', 'You can only apply to Agriculture & Livestock OR ASA Employees Son & Open Merit' );
										return true;
								}
								if( str_contains( $quotaName, 'ASA' ) && count( $this->quota ) > 2 ) {
										$this->addError( 'quota', 'You can only apply to Agriculture & Livestock OR ASA Employees Son & Open Merit' );
										return true;
								}
								if( str_contains( $quotaName, 'Gilgit' ) && !str_contains( $user->province->name, 'Gilgit' ) ) {
										$this->addError( 'quota', 'You cannot apply for Gilgit Baltistan Quota' );
										return true;
								}
								if( str_contains( $quotaName, 'FATA' ) && str_contains( $user->province->name, 'Gilgit' ) ) {
										$this->addError( 'quota', 'You cannot apply for Newly Merged Districts (FATA) Quota' );
										return true;
								}
								if( str_contains( $quotaName, 'Disabled' ) && count( $this->quota ) > 2 ) {
										$this->addError( 'quota', 'Disabled can only apply to disabled quota & Open Merit' );
										return true;
								}
						}
				}
				public function toggleSection()
				{
						$this->applyPanel = false;
						$this->resetForm();
				}
				public function resetForm()
				{
						$this->reset( [
								'quota',
								'status',
								'diplomaName',
								'project_id',
								'application_number',
						] );
						$this->resetErrorBag( [
								'quota',
								'status',
								'diplomaName',
								'project_id',
								'application_number',
						] );
						
				}
				public function uploadDocuments()
				{
						$this->validate( [
								'domicile' => 'required|mimes:pdf|max:2048',
								'cnic'     => 'required|mimes:pdf|max:2048',
								'dmc'      => 'required|mimes:jpg,jpeg,png|max:2048',
						] );
						$user = auth()->user();
						if( $this->domicile ) {
								$user->clearMediaCollection( 'domicile' );
								$user->addMedia( $this->domicile )->toMediaCollection( 'domicile' );
						}
						if( $this->dmc ) {
								$user->clearMediaCollection( 'dmc' );
								$user->addMedia( $this->dmc )->toMediaCollection( 'dmc' );
						}
						if( $this->cnic ) {
								$user->clearMediaCollection( 'cnic' );
								$user->addMedia( $this->cnic )->toMediaCollection( 'cnic' );
						}
						$this->documentStatus = true;
						session()->flash( 'success', 'Documents uploaded successfully.' );
				}
				public function applyNow( Project $project )
				{
						$this->applyPanel = true;
						$this->project_id = $project->id;
						$this->diplomaName = $project->diploma->name;
						$this->application_number = $this->getFirstLetter( $project->diploma->name ) . '-' . $project->id . '-' . rand( 1,
										1000 );
						$this->user = auth()->user();
						$this->quotaList = $this->quotaList
								->filter( function( $taxonomy ) use ( $project ) {
										return in_array( $taxonomy->id, $project->quota );
								} )
								->map( function( $taxonomy ) {
										return $taxonomy;
								} );
				}
				public function getFirstLetter( $value )
				{
						$excludedWords = [ "In", "The", "Of", 'in', 'the', 'of' ];
						$words = explode( " ", $value );
						$acronym = "";
						foreach( $words as $w ) {
								if( !in_array( $w, $excludedWords ) ) {
										$acronym .= mb_substr( $w, 0, 1 );
								}
						}
						return $acronym;
				}
				public function saveChallan( Application $application )
				{
						if(empty($this->challan)){
								$this->addError( 'challan', 'Please Select Challan' );
								return true;
						}
						$application->clearMediaCollection( 'challan' );
						$application->addMedia( $this->challan )->toMediaCollection( 'challan' );
						// Add any success message if needed
						$this->challan = '';
						session()->flash( 'success', 'Challan submitted successfully.' );
				}
		}
