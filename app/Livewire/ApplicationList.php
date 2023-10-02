<?php
		namespace App\Livewire;
		use App\Enums\TaxonomyTypeEnum;
		use App\Models\Application;
		use App\Models\Student;
		use App\Models\Taxonomy;
		use App\Models\User;
		use Carbon\Carbon;
		use Livewire\Attributes\Rule;
		use Livewire\Component;
		use Livewire\WithPagination;
		class ApplicationList extends Component
		{
				use WithPagination;
				public    $paid;
				public    $search;
				public    $sortBy             = 'id';
				public    $sortAsc            = true;
				public    $applyPanel         = false;
				public    $editApplication    = null;
				public    $project_id         = '';
				public    $application_number = '';
				public    $challan_number     = '';
				public    $diplomaName        = '';
				#[Rule( 'required|array|min:1' )]
				public    $quota              = [ '33' ];
				public    $quotaList          = '';
				public    $user               = '';
				public    $status             = 'Pending';
				public    $changeStatusId     = '';
				public    $diplomaList        = [];
				public    $sessionList        = [];
				public    $sectionList        = [];
				public    $admitStudent       = null;
				public    $userId             = '';
				public    $first_name         = '';
				public    $last_name          = '';
				public    $avatar             = '';
				public    $admitPanel         = false;
				public    $class_no           = 1;
				public    $reg_no             = 'ASA001';
				public    $diploma_id         = null;
				public    $session_id         = null;
				public    $section_id         = null;
				public    $admission_date     = null;
				protected $queryString        = [
						'paid',
						'search',
						'sortBy' => [ 'except' => 'id' ],
						'sortAsc',
				];
				public function mount()
				{
						$this->diplomaList = Taxonomy::whereType( TaxonomyTypeEnum::DIPLOMA )->get();
						$this->sessionList = Taxonomy::whereType( TaxonomyTypeEnum::SESSION )->orderByDesc( 'id' )->get();
				}
				public function render()
				{
						$applications = Application::query()
						                           ->when( $this->search, function( $query ) {
								                           $query->where( function( $subQuery ) {
										                           $subQuery->where( 'challan_number', 'LIKE', '%' . $this->search . '%' )
										                                    ->orWhere( 'application_number', 'LIKE', '%' . $this->search . '%' );
								                           } )->orWhereHas( 'user', function( $q ) {
										                           $q->whereRaw( "CONCAT(first_name, ' ',last_name) LIKE ?",
												                           [ '%' . $this->search . '%' ] );
								                           } );
						                           } )
						                           ->when( $this->paid, function( $query ) {
								                           $query->where( 'status', 'Paid' );
						                           } )
						                           ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' )
						                           ->latest() // Order by the default timestamp column in descending order (usually 'created_at')
						                           ->take( 100 ) // Limit to the latest 100 records
						                           ->paginate( 20 );
						return view( 'livewire.applications', compact( 'applications' ) );
				}
				public function admitAsStudent( Application $application )
				{
						$student = User::with( 'student' )->findOrFail( $application->user_id );
						$this->admitStudent = $application->user_id;
						$this->userId = $student->id;
						$this->diploma_id = $application->project->diploma_id;
						$this->first_name = $student->first_name;
						$this->last_name = $student->last_name;
						$this->avatar = $student->avatar;
						$this->admission_date = Carbon::parse( now() )->format( 'Y-m-d' );
						$this->sectionList = Taxonomy::whereType( TaxonomyTypeEnum::SECTION )->where( 'parent_id',
								$application->project->diploma_id )->get();
						$this->admitPanel = true;
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
				public function changeStatus( Application $application )
				{
						$this->changeStatusId = $application->id;
				}
				public function paymentStatus()
				{
						$application = Application::find( $this->changeStatusId );
						if( empty( $application->challan_number ) ) {
								$application->challan_number = $application->application_number;
						}
						$application->status = 'Paid';
						$application->save();
						session()->flash( 'success', 'Payment status changed to Paid Successfully.' );
						
				}
				public function getClassNumber()
				{
						if( $this->diploma_id && $this->session_id && $this->section_id ) {
								$classNo = Student::where( 'diploma_id', $this->diploma_id )
								                  ->where( 'session_id', $this->session_id )
								                  ->where( 'section_id', $this->section_id )
								                  ->latest()->first();
								if( $classNo ) {
										$this->class_no = $classNo->class_no + 1;
								}
						}
				}
				public function saveAdmit()
				{
						$validateRules = [
								'reg_no'         => 'required|unique:students,reg_no,' . $this->admitStudent,
								'class_no'       => 'required',
								'admission_date' => 'required',
								'diploma_id'     => 'required',
								'session_id'     => 'required',
								'section_id'     => 'required'
						];
						$validate = $this->validate( $validateRules );
						$validate[ 'status' ] = 'Active';
						unset( $validate[ 'quota' ] );
						$student = Student::where( 'user_id', $this->admitStudent )->first();
						$student->update( $validate );
						session()->flash( 'success', 'Student Admitted Successfully' );
						$this->toggleSection();
						
				}
				public function toggleSection()
				{
						$this->create = false;
						$this->admitPanel = false;
						$this->resetForm();
						$this->resetPage();
				}
				public function resetForm()
				{
						$this->reset( [ 'fee', 'description', 'quota', 'diploma_id', 'expiry_date' ] );
				}
				public function add()
				{
						$this->create = true;
				}
				public function edit( Application $application )
				{
						$this->editApplication = $application->id;
						$this->quotaList = Taxonomy::whereType( TaxonomyTypeEnum::QUOTA )
						                           ->where( 'id', '!=', 33 )
						                           ->get();
						$this->quota = $application->quota;
						$this->application_number = $application->application_number;
						$this->challan_number = $application->challan_number;
						$this->status = $application->status;
						$this->project_id = $application->project_id;
						$this->quotaList = $this->quotaList
								->filter( function( $taxonomy ) use ( $application ) {
										return in_array( $taxonomy->id, $application->project->quota );
								} )
								->map( function( $taxonomy ) {
										return $taxonomy;
								} );
						$editApplication = Application::find( $this->editApplication );
						$this->user = User::find( $editApplication->user_id );
						$this->applyPanel = true;
				}
				public function updateApplication()
				{
						$validate = $this->validate();
						$user = $this->user;
						try {
								$validate[ 'user_id' ] = $user->id;
								$validate[ 'project_id' ] = $this->project_id;
								$validate[ 'status' ] = $this->status;
								$validate[ 'application_number' ] = $this->application_number;
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
								
						} catch ( \Exception $e ) {
								session()->flash( 'error',
										$e->getMessage() );
						}
						
				}
				public function deleteApplication( Application $application )
				{
						if( $application->applications->count() > 0 ) {
								session()->flash( 'error', 'Application has applications submitted, so can not be deleted.' );
								return true;
						}
						$application->delete();
						session()->flash( 'success', 'Application Deleted Successfully.' );
				}
				public function sortField( $field )
				{
						if( $field === $this->sortBy ) {
								$this->sortAsc = !$this->sortAsc;
						}
						$this->sortBy = $field;
				}
		}
