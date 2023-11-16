<x-guest-layout>
	<div class="bg-white border border-gray-200 rounded-lg shadow-lg">

		<!-- Card Header -->
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">Add Student Information</h1>

		</div>
		@if (session()->has('success'))
			<x-flash-success-message message="{{ session('success') }}"/>
		@endif
		@if (session()->has('error'))
			<x-flash-error-message message="{{ session('error') }}"/>
		@endif
		@if(session('user-host') !== gethostname())
			<!-- Card Body -->
			<form class="py-6 px-4 sm:px-6" method="post" enctype="multipart/form-data" action="{{route('save-student-info')}}">
				@csrf
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<!-- Name field -->
					<div>
						<label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
						<input id="first_name" name="first_name" type="text"
						       value="{{old('first_name')}}"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="John">
						@error('first_name')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>
					<!-- Last Name field -->
					<div>
						<label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
						<input value="{{old('last_name')}}" id="last_name" name="last_name" type="text"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="Doe">
						@error('last_name')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>
					<div>
						<label for="father_name" class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
						<input value="{{old('father_name')}}" id="father_name" name="father_name" type="text"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="Doe">
						@error('father_name')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="username" class="block text-sm font-medium text-gray-700 mb-1">UserName</label>
						<input value="{{old('username')}}" id="username" name="username" type="text"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="joe123">
						@error('username')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="diploma_id" class="block text-sm font-medium text-gray-700 mb-1">Admitted In Diploma</label>
						<div class="relative">
							<select name="diploma_id" id="diploma_id"
							        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option>Select Diploma</option>
								@foreach($diplomaList as $diploma)
									<option value="{{$diploma->id}}" @selected(old('diploma_id'))>{{$diploma->name}}</option>
								@endforeach
							</select>

						</div>
						@error('diploma_id')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>

					<div>
						<label for="section_id" class="block text-sm font-medium text-gray-700 mb-1">Section</label>
						<div class="relative">
							<select name="section_id" id="section_id"
							        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option>Select Section</option>
								@foreach($sectionList as $sec)
									<option value="{{$sec->id}}" @selected(old('section_id'))>{{$sec->name}}</option>
								@endforeach
							</select>

						</div>
						@error('section_id')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>

					<div>
						<label for="session_id" class="block text-sm font-medium text-gray-700 mb-1">Session</label>
						<div class="relative">
							<select name="session_id" id="session_id" wire:model.live="session_id"

							        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option>Select Session</option>
								@foreach($sessionList as $session)
									<option value="{{$session->id}}" @selected(old('session_id'))>{{$session->name}}</option>
								@endforeach
							</select>

						</div>
						@error('session_id')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>


					<div>
						<label for="reg_no" class="block text-sm font-medium text-gray-700 mb-1">Assign Registration #</label>
						<input value="{{old('reg_no')}}" id="reg_no" name="reg_no" type="text"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="ASA001">
						@error('reg_no')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>

					<div>
						<label for="class_no" class="block text-sm font-medium text-gray-700 mb-1">Assign Class #</label>
						<input value="{{old('class_no')}}" id="class_no" name="class_no" type="number"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="001">
						@error('class_no')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror

					</div>


					<div>
						<label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
						<input value="{{old('password')}}" id="password" name="password" type="password"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="********">
						@error('password')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>


					<div>
						<label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
						<input value="{{old('phone')}}" id="phone" name="phone" type="number"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="xxxxxxxxxxx">
						@error('phone')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="cnic" class="block text-sm font-medium text-gray-700 mb-1">CNIC/FormB</label>
						<input value="{{old('cnic')}}" id="cnic" name="cnic" type="number"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="xxxxxxxxxxxxx">
						@error('cnic')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
						<input value="{{old('email')}}" id="email" name="email" type="email"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="john.doe@example.com">
						@error('email')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>


					<div>
						<label for="father_contact" class="block text-sm font-medium text-gray-700 mb-1">Father / Guardian Contact
							#</label>
						<input value="{{old('father_contact')}}" id="father_contact" name="father_contact" type="number"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="xxxxxxxxxxx">
						@error('father_contact')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact</label>
						<input value="{{old('emergency_contact')}}" id="emergency_contact" name="emergency_contact" type="number"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="xxxxxxxxxxx">
						@error('emergency_contact')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
						<input value="{{old('dob')}}" id="dob" name="dob" type="date"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
						@error('dob')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
						<input value="{{old('address')}}" id="address" name="address" type="text"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="i.e. Peshawar City">
						@error('address')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="postal_address" class="block text-sm font-medium text-gray-700 mb-1">Postal Address</label>
						<input value="{{old('postal_address')}}" id="postal_address" name="postal_address" type="text"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="i.e. Peshawar City">
						@error('postal_address')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>

					<div>
						<label for="province_id" class="block text-sm font-medium text-gray-700 mb-1">Province</label>
						<div class="relative">
							<select name="province_id" id="province_id"
							        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option value="">Select Province</option>
								@foreach($provinceList as $list)
									<option value="{{$list->id}}" @selected(old('province_id'))>{{$list->name}}</option>
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
							<select name="district_id" id="district_id"
							        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option value="">Select District</option>
								@foreach($districtList as $dis)
									<option value="{{$dis->id}}" @selected(old('district_id'))>{{$dis->name}}</option>
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
							<select name="blood_group_id" id="blood_group_id"
							        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option value="">Select Blood Group</option>
								@foreach($bloodGroupList as $bg)
									<option value="{{$bg->id}}" @selected(old('blood_group_id'))>{{$bg->name}}</option>
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
							<select name="gender_id" id="gender_id"
							        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option value="">Select Gender</option>
								@foreach($genderList as $gen)
									<option value="{{$gen->id}}" @selected(old('gender_id'))>{{$gen->name}}</option>
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
							<select name="religion" id="religion"
							        class=" block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option value="">Select Religion</option>
								@foreach($religionList as $religion)
									<option value="{{ $religion->name }}" @selected(old('religion'))>
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
						<input accept="image/png, image/jpg, image/jpeg" type="file" id="image" name="image"
						       class="ring-1 ring-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full">
						@error('image')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>


				</div>
				<button type="submit"
				        name="submit"
				        class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
					Submit
				</button>

			</form>
		@else
			<x-flash-error-message message="You have already register yourself."/>
		@endif

	</div>
</x-guest-layout>