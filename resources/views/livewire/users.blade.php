<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<span class="px-3 py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
	@endif

	@if($create)

	<!-- Card Header -->
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">{{$editUser ? 'Update User' : 'Add User'}}</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
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
				<!-- Password field -->
				@if(!$editUser)
					<div>
						<label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
						<input id="password" name="password" type="password" wire:model.live="password"
						       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
						       placeholder="********">
						@error('password')
						<span class="text-red-600 text-sm">{{ $message }}</span>
						@enderror
					</div>
				@endif
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
				<div class="mr-2 mt-8">
					<input type="checkbox" class="mr-2 leading-tight" wire:model.live="active"/> Active Only ?
				</div>
			</div>
			<table class="table-auto w-full border mt-5">
				<thead>
				<tr>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							No
							<x-sorting name="id"/>
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							First Name
							<x-sorting name="first_name"/>
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Last Name
							<x-sorting name="last_name"/>
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Username
							<x-sorting name="username"/>
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Phone
							<x-sorting name="phone"/>
						</div>
					</th>
					<th scope="col" class="px-6 py-3">
						<div class="flex items-center">
							Email
							<x-sorting name="email"/>
						</div>
					</th>
					<th class="border px-4 py-2" width="150px">Action</th>
				</tr>
				</thead>
				<tbody>
				@forelse($users as $user)
					<tr>
						<td class="border px-4 py-2">{{ $user->id }}</td>
						<td class="border px-4 py-2">{{ $user->first_name }}</td>
						<td class="border px-4 py-2">{{ $user->last_name }}</td>
						<td class="border px-4 py-2">{{ $user->username }}</td>
						<td class="border px-4 py-2">{{ $user->phone }}</td>
						<td class="border px-4 py-2">{{ $user->email }}</td>
						<td class="border px-4 py-2 inline-flex w-full">
							<x-button class="ml-3" wire:click="edit({{$user->id}})" wire:loading.attr="disabled">
								<i class="fas fa-edit"></i>
							</x-button>
							@if(auth()->user()->id !== $user->id)
								<x-danger-button class="ml-3" wire:click="deleteUser({{$user->id}})" wire:loading.attr="disabled">
									<i class="fas fa-trash-alt"></i>
								</x-danger-button>
							@endif
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