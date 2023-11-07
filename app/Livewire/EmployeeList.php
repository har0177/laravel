<?php
		
		namespace App\Livewire;
		
		use App\Enums\TaxonomyTypeEnum;
		use App\Helper\Common;
		use App\Models\Employee;
		use App\Models\Taxonomy;
		use App\Services\SmsService;
		use Livewire\Component;
		use Livewire\WithFileUploads;
		use Livewire\WithPagination;
		class EmployeeList extends Component
		{
				
				use WithPagination;
				use WithFileUploads;
				public    $search;
				public    $sortBy           = 'id';
				public    $sortAsc          = true;
				public    $create           = false;
				public    $editEmployee     = null;
				public    $full_name        = '';
				public    $father_name      = '';
				public    $designation      = '';
				public    $bps              = '';
				public    $personal_number  = '';
				public    $contact_number   = '';
				public    $emergency_number = '';
				public    $nic              = '';
				public    $dob              = '';
				public    $address          = '';
				public    $avatar           = '';
				public    $image            = '';
				public    $status           = 1;
				public    $gender_id        = null;
				public    $blood_group_id   = null;
				public    $genderList       = [];
				public    $bloodGroupList   = [];
				public    $changeStatusId   = '';
				public    $employeeContact  = null;
				public    $sms              = null;
				public    $errorMessage;
				protected $queryString      = [
						'search',
						'sortBy' => [ 'except' => 'id' ],
						'sortAsc',
						'editEmployee',
						'employeeContact'
				];
				public function render()
				{
						$query = Employee::query();
						$query->when( $this->search, function( $q ) {
								return $q->where( function( $qq ) {
										$qq->where( "full_name LIKE ?",
												[ '%' . $this->search . '%' ] )
										   ->orWhere( 'father_name', 'LIKE', '%' . $this->search . '%' )
										   ->orWhere( 'nic', 'LIKE', '%' . $this->search . '%' )
										   ->orWhere( 'personal_number', 'LIKE', '%' . $this->search . '%' )
										   ->orWhere( 'contact_number', 'LIKE', '%' . $this->search . '%' );
								} );
						} )->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC' );
						$employees = $query->take( 50 ) // Limit the query to retrieve only the latest 50 records
						                   ->get(); // Retrieve all 50 records
						$employees = Common::showPerPage( 10, $employees );
						
						return view( 'livewire.employees', [
								'employees' => $employees
						] );
				}
				public function add()
				{
						$this->loadTaxonomies();
						$this->create = true;
				}
				private function loadTaxonomies()
				{
						$this->genderList = Taxonomy::whereType( TaxonomyTypeEnum::GENDER )->get();
						$this->bloodGroupList = Taxonomy::whereType( TaxonomyTypeEnum::BLOODGROUP )->get();
						
				}
				public function store()
				{
						
						$this->validate();
						$data = [
								'gender_id'        => $this->gender_id,
								'father_name'      => $this->father_name,
								'full_name'        => $this->full_name,
								'dob'              => $this->dob,
								'blood_group_id'   => $this->blood_group_id,
								'address'          => $this->address,
								'designation'      => $this->designation,
								'personal_number'  => $this->personal_number,
								'contact_number'   => $this->contact_number,
								'emergency_number' => $this->emergency_number,
								'nic'              => $this->nic,
								'status'           => $this->status,
								'bps'              => $this->bps
						];
						if( !$this->editEmployee ) {
								$employee = Employee::create( $data );
								session()->flash( 'success', 'Employee added successfully.' );
						} else {
								$employee = Employee::find( $this->editEmployee );
								$employee->update( $data );
								session()->flash( 'success', 'Employee updated successfully.' );
								
						}
						if( $this->image ) {
								$employee->clearMediaCollection( 'avatars' );
								$employee->addMedia( $this->image )->toMediaCollection( 'avatars' );
						}
						$this->image = '';
						$this->avatar = $employee->getFirstMediaUrl( 'avatars' );
						$this->toggleSection();
						
				}
				public function toggleSection()
				{
						$this->create = false;
						$this->editEmployee = null;
						$this->employeeContact = null;
						$this->sms = null;
						$this->resetForm();
						$this->resetPage();
				}
				public function resetForm()
				{
						$this->reset( [
								'full_name',
								'father_name',
								'designation',
								'bps',
								'personal_number',
								'contact_number',
								'emergency_number',
								'nic',
								'dob',
								'address', 'blood_group_id', 'gender_id', 'status'
						] );
						$this->resetErrorBag( [
								'full_name',
								'father_name',
								'designation',
								'bps',
								'personal_number',
								'contact_number',
								'emergency_number',
								'nic',
								'dob',
								'address', 'blood_group_id', 'gender_id', 'status'
						] );
				}
				public function edit( $id )
				{
						$this->loadTaxonomies();
						$employee = Employee::findOrFail( $id );
						$this->editEmployee = $id;
						$this->full_name = $employee->full_name;
						$this->father_name = $employee->father_name;
						$this->designation = $employee->designation;
						$this->bps = $employee->bps;
						$this->personal_number = $employee->personal_number;
						$this->contact_number = $employee->contact_number;
						$this->emergency_number = $employee->emergency_number;
						$this->nic = $employee->nic;
						$this->dob = $employee->dob;
						$this->status = $employee->status;
						$this->gender_id = $employee->gender_id;
						$this->blood_group_id = $employee->blood_group_id;
						$this->address = $employee->address;
						$this->avatar = $employee->avatar;
						$this->create = true;
				}
				public function changeStatus( Employee $employee )
				{
						$this->changeStatusId = $employee->id;
				}
				public function sendingSMS( Employee $employee )
				{
						$this->employeeContact = '03339471086'; //$employee->contact_number;
				}
				
				public function sendSMS()
				{
						$sms = new SmsService();
						$sms->send( $this->employeeContact, $this->sms );
						$this->toggleSection();
						session()->flash( 'success', 'SMS Send Successfully.' );
						
				}
				public function deleteEmployee()
				{
						$employee = Employee::find( $this->changeStatusId );
						$employee->delete();
						$this->changeStatusId = '';
						session()->flash( 'success', 'Employee Deleted Successfully.' );
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
								'full_name'       => 'required|min:2|max:50',
								'father_name'     => 'required|min:2|max:50',
								'designation'     => 'required',
								'bps'             => 'required',
								'personal_number' => 'required',
								'contact_number'  => 'required',
								'nic'             => 'required',
								'dob'             => 'required',
								'address'         => 'required',
								'gender_id'       => 'required',
								'blood_group_id'  => 'required',
						];
				}
				
		}
