<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<span class="px-3 py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
@endif
<!-- Card Header -->
	<div class="p-6 lg:p-8 border-b border-gray-200 flex items-center justify-between">
		<h1 class="text-xl font-semibold">User Management</h1>
		<div>
			<x-button wire:click="create">
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
						Name
						<x-sorting name="name"/>
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
					<td class="border px-4 py-2">{{ $user->name }}</td>
					<td class="border px-4 py-2">{{ $user->email }}</td>
					<td class="px-4 inline-flex space-x-2">
						<x-button>
							<i class="fas fa-edit"></i>
						</x-button>

						<x-danger-button class="ml-3" wire:click="deleteUser({{$user->id}})" wire:loading.attr="disabled">
							<i class="fas fa-trash-alt"></i>
						</x-danger-button>
					</td>
				</tr>
			@empty
				<tr>
					<td class="border px-4 py-2" colspan="4">No user found.</td>
				</tr>
			@endforelse
			</tbody>
		</table>

	</div>
	<!-- Card Footer -->
	<div class="py-4 px-8">
		{{ $users->links() }}
	</div>
</div>


