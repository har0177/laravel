<div class="bg-white border border-gray-200 rounded-lg shadow-lg">

	<div class="mt-4 mb-4 text-center">
		@if (session()->has('success'))
			<span class="px-3  py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
		@endif


		@if (session()->has('error'))
			<span class="px-3 mt-4 mb-4 text-center py-1 bg-red-600 text-white rounded">{{ session('error') }}</span>
		@endif
	</div>
	<!-- Card Header -->
	<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
		<h1 class="text-xl text-white font-semibold">Update Profile</h1>

	</div>

	<!-- Card Body -->
	<form class="py-6 px-4 sm:px-6" wire:submit.prevent="updateProfile" enctype="multipart/form-data">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<!-- Name field -->
			<div>
				<label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
				<input id="first_name" name="first_name" type="text" wire:model.live="first_name"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="John">
				@error('first_name')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror

			</div>
			<!-- Last Name field -->
			<div>
				<label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
				<input id="last_name" name="last_name" type="text" wire:model.live="last_name"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="Doe">
				@error('last_name')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>
			<div>
				<label for="username" class="block text-sm font-medium text-gray-700 mb-1">UserName</label>
				<input id="username" name="username" type="text" wire:model.live="username"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="joe123">
				@error('username')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>
			<div>
				<label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
				<input id="phone" name="phone" type="text" wire:model.live="phone"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="xxxxxxxxxxx">
				@error('phone')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>

			<div>
				<label for="cnic" class="block text-sm font-medium text-gray-700 mb-1">CNIC/FormB</label>
				<input id="cnic" name="cnic" type="text" wire:model.live="cnic"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="xxxxxxxxxxxxx">
				@error('cnic')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>

			<div>
				<label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
				<input id="email" name="email" type="email" wire:model.live="email"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="john.doe@example.com">
				@error('email')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>


			<div>
				<label for="father_name" class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
				<input id="father_name" name="father_name" type="text" wire:model.live="father_name"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="Jhon">
				@error('father_name')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>

			<div>
				<label for="father_nic" class="block text-sm font-medium text-gray-700 mb-1">Father CNIC</label>
				<input id="father_nic" name="father_nic" type="text" wire:model.live="father_nic"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="xxxxxxxxxxxxx">
				@error('father_nic')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>

			<div>
				<label for="father_contact" class="block text-sm font-medium text-gray-700 mb-1">Father Contact #</label>
				<input id="father_contact" name="father_contact" type="text" wire:model.live="father_contact"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="xxxxxxxxxxx">
				@error('father_contact')
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
				<input id="address" name="father_contact" type="text" wire:model.live="address"
				       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				       placeholder="i.e. Peshawar City">
				@error('address')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>


			<div>
				<label for="district_id" class="block text-sm font-medium text-gray-700 mb-1">District</label>
				<div class="relative">
					<select name="district_id" id="district_id" wire:model.live="district_id"
					        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
						<option>Select District</option>
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
					<select name="blood_group_id" id="blood_group_id" wire:model.live="blood_group_id"
					        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
						<option>Select Blood Group</option>
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
					<select name="gender" id="gender" wire:model.live="gender_id"
					        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
						<option>Select Gender</option>
						@foreach($genderList as $list)
							<option value="{{$list->id}}" {{$this->gender_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
						@endforeach
					</select>

				</div>

				@error('gender_id')
				<span class="text-red-600 text-sm">{{ $message }}</span>
				@enderror
			</div>
			<!-- Email field -->

			<div>
				@if ($image)
					<img class="rounded h-16 mt-5 block" src="{{ $image->temporaryUrl() }}">
				@else
					<img class="rounded h-16 mt-5 block" src="{{ $avatar }}">
				@endif
				<br>
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
			<span wire:loading wire:target="updateProfile">Saving...</span>
			<span wire:loading.remove wire:target="updateProfile">Update</span>
		</button>

	</form>


</div>
