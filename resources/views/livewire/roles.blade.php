<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<span class="px-3 py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
	@endif


	@if($create)

	<!-- Card Header -->
		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">{{$editRole ? 'Update Role' : 'Add Role'}}</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->
				<div>
					<label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
					<input id="name" name="name" type="text" wire:model.live="name"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="John">
					@error('name')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>
				<!-- Last Name field -->
				<div>
					<label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
					<textarea id="description" name="description" wire:model.live="description"
					          class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"> </textarea>
					@error('description')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
				@if($name !== 'Student')
					<div class="flex flex-col md:flex-row">
						<div class="md:w-1/4 border-r">
							<div class="flex flex-col p-4">
								@foreach($abilities as $data)
									<a
										class="p-2 text-blue-500 hover:text-blue-700"
										wire:click="switchTab('{{ $data['title'] }}')"
										role="tab"
										href="#tabs-{{ str_slug($data['title']) }}"
										aria-controls="tabs-{{ str_slug($data['title']) }}"
										aria-selected="{{ $activeTab === $data['title'] }}"
									>
										{{ $data['title'] }}
									</a>
								@endforeach
							</div>
						</div>
						<div class="md:w-3/4 p-4">
							<div class="tab-content">
								@error('permissions')
								<span class="text-red-600 text-sm">{{ $message }}</span>
								@enderror
								@foreach($abilities as $data)
									<div
										class="{{ $activeTab === $data['title'] ? '' : 'hidden' }} opacity-100 transition-opacity duration-150 ease-linear {{ $activeTab === $data['title'] ? 'block' : 'data-[te-tab-active]' }}"
										id="tabs-{{ str_slug($data['title']) }}"
										role="tabpanel"
										aria-labelledby="tabs-{{ str_slug($data['title']) }}-tab"
										{{ $activeTab === $data['title'] ? 'data-te-tab-active' : '' }}
									>
										<!-- Tab Content -->
										<div class="flex flex-col md:flex-row items-center mb-4">
											<div class="md:w-1/2 pr-8">
												<h3 class="text-xl font-bold">{{ $data['title'] }}</h3>
												<p class="text-sm">{{ $data['description'] }}</p>
											</div>
										</div>
										<hr class="mb-4">
										<div class="space-y-4">
											@foreach($data['abilities'] as $ability => $perm)
												<div class="flex items-center justify-between">
													<h4 class="text-lg font-bold">{{ $perm['title'] }}</h4>
													<div class="relative inline-block w-12 align-middle select-none transition duration-200 ease-in">
														<input
															type="checkbox"
															id="{{ str_slug($ability) }}"
															name="permissions[]"
															value="{{ $ability }}"
															wire:model="permissions"
															class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
														>
														<label
															for="{{ str_slug($ability) }}"
															class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
														></label>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endforeach
							</div>
						</div>
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
			<h1 class="text-xl text-white font-semibold">Role Management</h1>
			<div>
				<x-button wire:click="add">
					Create Role
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
							Description
						</div>
					</th>
					<th class="border px-4 py-2" width="150px">Action</th>
				</tr>
				</thead>
				<tbody>
				@forelse($roles as $role)
					<tr>
						<td class="border px-4 py-2">{{ $role->id }}</td>
						<td class="border px-4 py-2">{{ $role->name }}</td>
						<td class="border px-4 py-2">{{ $role->description }}</td>
						<td class="border px-4 py-2 inline-flex w-full">
							<x-button class="ml-3" wire:click="edit({{$role->id}})" wire:loading.attr="disabled">
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
			{{ $roles->links() }}
		</div>

	@endif

</div>