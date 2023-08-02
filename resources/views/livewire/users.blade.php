<div class="p-6 lg:p-8 bg-white border-b border-gray-200">

	@if (session()->has('success'))
		<span class="px-3 py-3 bg-green-600 text-white rounded">{{ session('success') }}</span>
	@endif

	<table class="table-auto w-full border mt-5">
		<thead>
		<tr>
			<th class="border px-4 py-2">No.</th>
			<th class="border px-4 py-2">Name</th>
			<th class="border px-4 py-2">Email</th>
			<th class="border px-4 py-2" width="150px">Action</th>
		</tr>
		</thead>
		<tbody>

		@forelse($users as $user)
			<tr>
				<td class="border px-4 py-2">{{ $user->id }}</td>
				<td class="border px-4 py-2">{{ $user->name }}</td>
				<td class="border px-4 py-2">{{ $user->email }}</td>
				<td class=" px-4 inline-flex space-x-2">
					<button
						class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">
						<i class="fas fa-edit"></i>
					</button>
					<button
						class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">
						<i class="fas fa-trash-alt"></i>
					</button>
				</td>
			</tr>
		@empty
			<tr>
				<td class="border px-4 py-2" colspan="4">No user found.</td>
			</tr>
		@endforelse
		</tbody>
	</table>
	{{ $users->links() }}
</div>

