<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<span class="px-3 py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
@endif


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
			<!-- Email field -->
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
