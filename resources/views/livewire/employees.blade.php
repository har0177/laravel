<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
    @if (session()->has('success'))
        <x-flash-success-message message="{{ session('success') }}"/>
    @endif
    @if (session()->has('error'))
        <x-flash-error-message message="{{ session('error') }}"/>
    @endif


    @if(!empty($employeeContact))

        <!-- Card Header -->
        <div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
            <h1 class="text-xl text-white font-semibold">Send SMS to {{$employeeContact}}</h1>

        </div>

        <!-- Card Body -->
        <form class="py-6 px-4 sm:px-6" wire:submit.prevent="sendSMS">

            <!-- Name field -->
            <div>
                <label for="sms" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea id="sms" name="sms" wire:model="sms"
                          class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                          placeholder="John Doe">
					</textarea>
                @error('sms')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

            </div>

            <button type="submit"
                    wire:loading.attr="disabled"
                    class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
                <span wire:loading wire:target="sendSMS">Sending...</span>
                <span wire:loading.remove wire:target="sendSMS">Send SMS</span>
            </button>
            <x-button type="button" wire:click="toggleSection">
                Reset
            </x-button>
        </form>

    @endif
    @if($create)

        <!-- Card Header -->
        <div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
            <h1 class="text-xl text-white font-semibold">{{$editEmployee ? 'Update Employee' : 'Add Employee'}}</h1>

        </div>

        <!-- Card Body -->
        <form class="py-6 px-4 sm:px-6" wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Name field -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input id="full_name" name="full_name" type="text" wire:model="full_name"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="John Doe">
                    @error('full_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                </div>
                <!-- Last Name field -->
                <div>
                    <label for="father_name" class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
                    <input id="father_name" name="father_name" type="text" wire:model="father_name"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="Doe">
                    @error('father_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="personal_number" class="block text-sm font-medium text-gray-700 mb-1">Personnal
                        Number</label>
                    <input id="personal_number" name="personal_number" type="text" wire:model="personal_number"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="0035868">
                    @error('personal_number')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                    <input id="designation" name="designation" type="text" wire:model="designation"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="Vice Principal">
                    @error('designation')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="bps" class="block text-sm font-medium text-gray-700 mb-1">BPS</label>
                    <input id="bps" name="bps" type="text" wire:model="bps"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="BPS 17">
                    @error('bps')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="nic" class="block text-sm font-medium text-gray-700 mb-1">CNIC</label>
                    <input id="nic" name="nic" type="text" wire:model="nic"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="xxxxxxxxxxxxx">
                    @error('nic')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1">Contact
                        Number</label>
                    <input id="contact_number" name="contact_number" type="text" wire:model="contact_number"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="xxxxxxxxxxx">
                    @error('contact_number')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="emergency_number" class="block text-sm font-medium text-gray-700 mb-1">Emergency
                        Contact</label>
                    <input id="emergency_number" name="emergency_number" type="text" wire:model="emergency_number"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="xxxxxxxxxxx">
                    @error('emergency_number')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input id="dob" name="dob" type="date" wire:model="dob"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('dob')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input id="address" name="father_contact" type="text" wire:model="address"
                           class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="i.e. Peshawar City">
                    @error('address')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="blood_group_id" class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                    <div class="relative">
                        <select name="blood_group_id" id="blood_group_id" wire:model="blood_group_id"
                                class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Select Blood Group</option>
                            @foreach($bloodGroupList as $list)
                                <option
                                    value="{{$list->id}}" {{$this->blood_group_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    @error('blood_group_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <div class="relative">
                        <select name="gender" id="gender" wire:model="gender_id"
                                class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Select Gender</option>
                            @foreach($genderList as $list)
                                <option
                                    value="{{$list->id}}" {{$this->gender_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    @error('gender_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <div class="relative">
                        <select name="status" id="status" wire:model="status"
                                class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Select Status</option>
                            <option value="1" {{ $this->status === 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ $this->status === 0 ? 'selected' : '' }}>
                                De-Active
                            </option>

                        </select>

                    </div>

                    @error('status')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    @if ($image)
                        <img class="rounded h-16 mt-5 block" src="{{ $image->temporaryUrl() }}">
                    @else
                        <img class="rounded h-16 mt-5 block" src="{{ $avatar }}">
                    @endif

                    <input wire:model="image" accept="image/png, image/jpg, image/jpeg" type="file" id="image"
                           class="ring-1 ring-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full">
                    <div wire:loading wire:target="image">
                        <span class="text-green-500"> Uploading ... </span>
                    </div>
                    @error('image')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                </div>

            </div>
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
                <span wire:loading wire:target="store">Saving...</span>
                <span wire:loading.remove wire:target="store">Submit</span>
            </button>
            <x-button type="button" wire:click="toggleSection">
                Reset
            </x-button>
        </form>

    @else

        <div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
            <h1 class="text-xl text-white font-semibold">Employee Management</h1>
            <div>
                <x-button wire:click="add"
                          class="inline-block ml-2 px-3 text-white py-1 bg-green-700 rounded-lg hover:bg-indigo-700 transition duration-300"
                >
                    Create Employee
                </x-button>
                <a href="{{ route('employee-card') }}" target="_blank"
                   class="inline-block ml-2 px-3 text-white py-1 bg-pink-900 rounded-lg hover:bg-indigo-700 transition duration-300">
                    Employee ID Cards
                </a>
            </div>
        </div>


        <!-- Card Body -->
        <div class="mt-5 px-8">
            <div class="flex justify-between">
                <div class="p-4">
                    <input type="search" wire:model.live.debounce.500ms="search" placeholder="Search"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"/>
                </div>

            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-200">
                    <tr>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                No
                                <x-sorting name="id"/>
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                Full Name
                                <x-sorting name="full_name"/>
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                Father Name
                                <x-sorting name="father_name"/>
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                Designation
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                Contact #
                                <x-sorting name="contact_number"/>
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                CNIC
                                <x-sorting name="nic"/>
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                Card Status
                            </div>
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            <div class="flex items-center">
                                Status
                            </div>
                        </th>
                        <th class="border px-4 py-2" width="150px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($employees as $employee)
                        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
                            <td class="border px-4 py-2">{{ $employee->full_name }}</td>
                            <td class="border px-4 py-2">{{ $employee->father_name }}</td>
                            <td class="border px-4 py-2">{{ $employee->designation }}</td>
                            <td class="border px-4 py-2">{{ $employee->contact_number }}</td>
                            <td class="border px-4 py-2">{{ $employee->nic }}</td>
                            <td class="border px-4 py-2">
                                @if ($employee->card_status)
                                    <x-badge text="Printed" color="green"/>
                                @else
                                    <x-badge text="Not Yet" color="indigo"/>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                @if ($employee->status)
                                    <x-badge text="Active" color="green"/>
                                @else
                                    <x-badge text="De-Active" color="indigo"/>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex h-full items-center">
                                    <a target="_blank" href="{{ route('employee-card', ['id' => $employee->id]) }}"
                                       class="inline-block ml-2 px-3 text-white py-1 bg-indigo-500 rounded-lg hover:bg-indigo-700 transition duration-300">
                                        <i class="fas fa-credit-card"></i>
                                    </a>


                                    <x-button
                                        class="inline-block ml-2 px-3 text-white py-1 bg-purple-900 rounded-lg hover:bg-indigo-700 transition duration-300"
                                        wire:click="sendingSMS({{$employee->id}})" title="Send SMS"
                                        wire:loading.attr="disabled">
                                        <i class="fas fa-envelope"></i>
                                    </x-button>

                                    <x-button
                                        class="inline-block ml-2 px-3 text-white py-1 bg-orange-900 rounded-lg hover:bg-indigo-700 transition duration-300"
                                        wire:click="edit({{$employee->id}})"
                                        title="Edit Employee Form"
                                        wire:loading.attr="disabled">
                                        <i class="fas fa-edit"></i>
                                    </x-button>


                                    <div x-data="{ showModal: false }">


                                        <x-danger-button wire:click="changeStatus({{$employee->id}})" class="ml-3"
                                                         @click="showModal = true">
                                            <i class="fas fa-trash-alt"></i>
                                        </x-danger-button>

                                        <!-- Modal -->
                                        <div x-show="showModal"
                                             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="bg-white rounded shadow-lg w-80">
                                                <div class="modal-header bg-indigo-600 text-white rounded-t">
                                                    <div class="flex items-center justify-between p-3">
                                                        <h5 class="text-lg font-semibold">Delete Employee</h5>
                                                        <button @click="showModal = false"
                                                                class="text-white hover:text-gray-200">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <p class="text-gray-700">Are you sure you want to delete this
                                                        employee?</p>
                                                </div>

                                                <div class="modal-footer flex justify-end p-4 bg-gray-100 rounded-b">
                                                    <button @click="showModal = false"
                                                            class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none">
                                                        Close
                                                    </button>
                                                    <button wire:click.prevent="deleteEmployee()"
                                                            @click="showModal = false"
                                                            class="ml-2 px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600 focus:outline-none">
                                                        Yes, Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="7">No Record Found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Card Footer -->
        <div class="py-4 px-8">
            {{ $employees->links() }}
        </div>

    @endif

</div>

@push('scripts')
    <script>
        Livewire.directive('confirm', ({el, directive, component, cleanup}) => {
            let content = directive.expression

            let onClick = e => {
                if (!confirm(content)) {
                    e.preventDefault()
                    e.stopImmediatePropagation()
                }
            }
            el.addEventListener('click', onClick, {capture: true})
            cleanup(() => {
                el.removeEventListener('click', onClick)
            })
        })
    </script>

@endpush
