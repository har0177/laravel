<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<x-flash-success-message message="{{ session('success') }}"/>
	@endif
	@if (session()->has('error'))
		<x-flash-error-message message="{{ session('error') }}"/>
	@endif


	@if($create)

	<!-- Card Header -->
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">{{$editUser ? 'Update User' : 'Add User'}}</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="updateProfile" enctype="multipart/form-data">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
				<!-- Name field -->
				<div>
					<label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
					<input id="first_name" name="first_name" type="text" wire:model="first_name"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="John">
					@error('first_name')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>
				<!-- Last Name field -->
				<div>
					<label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
					<input id="last_name" name="last_name" type="text" wire:model="last_name"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="Doe">
					@error('last_name')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
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
					<label for="username" class="block text-sm font-medium text-gray-700 mb-1">UserName</label>
					<input id="username" name="username" type="text" wire:model="username"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="joe123">
					@error('username')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<!-- Password field -->

				<div>
					<label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
					<input id="password" name="password" type="password" wire:model="password"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="********">
					@error('password')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>


				<div>
					<label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
					<input id="phone" name="phone" type="text" wire:model="phone"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="xxxxxxxxxxx">
					@error('phone')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div>
					<label for="cnic" class="block text-sm font-medium text-gray-700 mb-1">CNIC/FormB</label>
					<input id="cnic" name="cnic" type="text" wire:model="cnic"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="xxxxxxxxxxxxx">
					@error('cnic')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div>
					<label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
					<input id="email" name="email" type="email" wire:model="email"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="john.doe@example.com">
					@error('email')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>


				<div>
					<label for="father_contact" class="block text-sm font-medium text-gray-700 mb-1">Father / Guardian Contact
						#</label>
					<input id="father_contact" name="father_contact" type="text" wire:model="father_contact"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="xxxxxxxxxxx">
					@error('father_contact')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div>
					<label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact</label>
					<input id="emergency_contact" name="emergency_contact" type="text" wire:model="emergency_contact"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="xxxxxxxxxxx">
					@error('emergency_contact')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div>
					<label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
					<input id="dob" name="dob" type="date" wire:model.lazy="dob" wire:change="birthValidation"
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
					<label for="postal_address" class="block text-sm font-medium text-gray-700 mb-1">Postal Address</label>
					<input id="postal_address" name="postal_address" type="text" wire:model="postal_address"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="i.e. Peshawar City">
					@error('postal_address')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div>
					<label for="province_id" class="block text-sm font-medium text-gray-700 mb-1">Province</label>
					<div class="relative">
						<select name="province_id" id="province_id" wire:model="province_id"
						        wire:change="updateDistrict"
						        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option value="">Select Province</option>
							@foreach($provinceList as $list)
								<option value="{{$list->id}}" {{$this->province_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
							@endforeach
						</select>

					</div>

					@error('province_id')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>


				<div>
					<label for="district_id" class="block text-sm font-medium text-gray-700 mb-1">District</label>
					<div class="relative">
						<select name="district_id" id="district_id" wire:model="district_id"
						        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option value="">Select District</option>
							@foreach($districtList as $list)
								<option value="{{$list->id}}" {{$this->district_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
							@endforeach
						</select>

					</div>

					@error('district_id')
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
								<option value="{{$list->id}}" {{$this->blood_group_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
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
								<option value="{{$list->id}}" {{$this->gender_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
							@endforeach
						</select>

					</div>

					@error('gender_id')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
				<div>
					<label for="religion" class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
					<div class="relative">
						<select name="religion" id="religion" wire:model="religion"
						        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option value="">Select Religion</option>

							@foreach($religionList as $religion)
								<option value="{{ $religion->name }}" {{ $this->religion === $religion->value ? 'selected' : '' }}>
									{{ $religion->value }}
								</option>
							@endforeach
						</select>

					</div>

					@error('religion')
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
				<div class="mb-4">
					<label for="hostel" class="block text-sm font-medium text-gray-700 mb-1">Hostel Required</label>
					<div class="space-y-2">
						<label class="relative flex items-center">
							<input type="radio"
							       id="hostel"
							       name="hostel"
							       value="1"
							       wire:model="hostel"
							       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
							<span class="ml-8">Yes</span>
						</label>
						<label class="relative flex items-center">
							<input type="radio"
							       id="hostel"
							       value="0"
							       name="hostel"
							       wire:model="hostel"
							       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
							<span class="ml-8">No</span>
						</label>

					</div>
					@error('hostel')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-4">
					<label for="hafiz_quran" class="block text-sm font-medium text-gray-700 mb-1">Hafiz Quran</label>
					<div class="space-y-2">
						<label class="relative flex items-center">
							<input type="radio"
							       id="hafiz_quran"
							       name="hafiz_quran"
							       value="1"
							       wire:model="hafiz_quran"
							       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
							<span class="ml-8">Yes</span>
						</label>
						<label class="relative flex items-center">
							<input type="radio"
							       id="hafiz_quran"
							       value="0"
							       name="hafiz_quran"
							       wire:model="hafiz_quran"
							       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer">
							<span class="ml-8">No</span>
						</label>

					</div>
					@error('hafiz_quran')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
				<!-- Email field -->
				<div>
					<label for="hifz_marks" class="block text-sm font-medium text-gray-700 mb-1">Hifz Marks</label>
					<input id="hifz_marks" name="hifz_marks" type="number" min="0" max="20" wire:model="hifz_marks"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
					@error('hifz_marks')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

			</div>
			<button type="submit"
			        wire:loading.attr="disabled"
			        class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
				<span wire:loading wire:target="updateProfile">Saving...</span>
				<span wire:loading.remove wire:target="updateProfile">Submit</span>
			</button>

		</form>



	@else


		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">User Management</h1>
			<div>
				<x-button wire:click="add">
					Create User
				</x-button>
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
			<table class="table-auto w-full border mt-5">
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
							<x-sorting name="first_name"/>
						</div>
					</th>
					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
							Father Name
						</div>
					</th>
					{{--<th sc
					ope="col" class="border px-6 py-3">
						<div class="flex items-center">
							Username
							<x-sorting name="studentname"/>
						</div>
					</th>--}}
					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
							Phone
							<x-sorting name="phone"/>
						</div>
					</th>
					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
							CNIC
							<x-sorting name="cnic"/>
						</div>
					</th>

					<th scope="col" class="border px-6 py-3">
						<div class="flex items-center">
							Email
							<x-sorting name="email"/>
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
				@forelse($users as $user)
					<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
						<td class="border px-4 py-2">{{ $loop->index + 1  }}</td>
						<td class="border px-4 py-2">{{ $user->full_name }}</td>
						<td class="border px-4 py-2">{{ $user->student->father_name }}</td>
						<td class="border px-4 py-2">{{ $user->phone }}</td>
						<td class="border px-4 py-2">{{ $user->cnic }}</td>
						<td class="border px-4 py-2">{{ $user->email }}</td>
						<td class="border px-4 py-2">{{ $user->student?->status }}</td>
						<td class="border px-4 py-2 ">
							<x-button class="ml-3" wire:click="edit({{$user->id}})" title="Edit User Form" wire:loading.attr="disabled">
								<i class="fas fa-edit"></i>
							</x-button>
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
		<!-- Card Footer -->
		<div class="py-4 px-8">
			{{ $users->links() }}
		</div>

	@endif

</div>