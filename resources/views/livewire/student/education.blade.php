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
			<h1 class="text-xl text-white font-semibold">{{$editEducation ? 'Update Education' : 'Add Education'}}</h1>

		</div>

		<!-- Card Body -->
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="store">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<label for="degree_id" class="block text-sm font-medium text-gray-700 mb-1">Degree</label>
					<div class="relative">
						<select name="degree_id" id="degree_id" wire:model="degree_id"
						        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option value="">Select Degree</option>
							@foreach($degreeList as $list)
								<option
									value="{{$list->id}}" {{$this->degree_id === $list->id? 'selected' : ''}}>{{$list->name}}</option>
							@endforeach
						</select>

					</div>

					@error('degree_id')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>


				<!-- Name field -->
				<div>
					<label for="board" class="block text-sm font-medium text-gray-700 mb-1">Board</label>
					<input id="board" name="board" type="text" wire:model="board"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="BISE Peshawar">
					@error('board')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror

				</div>
				<!-- Last Name field -->
				<div>
					<label for="total_marks" class="block text-sm font-medium text-gray-700 mb-1">Total Marks</label>
					<input id="total_marks" name="total_marks" type="number" min="0" wire:model="total_marks"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="1100">
					@error('total_marks')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
				<div>
					<label for="obtained_marks"
					       class="block text-sm font-medium text-gray-700 mb-1">Obtained Marks</label>
					<input id="obtained_marks" name="obtained_marks" type="number" min="0"
					       wire:model="obtained_marks"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="900">
					@error('obtained_marks')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
				{{--				<div>
									<label for="percentage" class="block text-sm font-medium text-gray-700 mb-1">Percentage</label>
									<input id="percentage" name="percentage" type="number"
																wire:model="percentage"
																class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
									>
									@error('percentage')
									<span class="text-red-600 text-sm">{{ $message }}</span>
									@enderror
								</div>--}}

				<div>
					<label for="grade" class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
					<select name="grade" id="grade" wire:model="grade"
					        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
						<option value="">Select Grade</option>
						<option value="A1">A1</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
					</select>
					@error('grade')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>

				<div>
					<label for="roll_number" class="block text-sm font-medium text-gray-700 mb-1">Roll Number</label>
					<input id="roll_number" name="roll_number" type="text" wire:model="roll_number"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					       placeholder="124586">
					@error('roll_number')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror
				</div>
				<!-- Email field -->
				<div>
					<label for="result_declaration_date" class="block text-sm font-medium text-gray-700 mb-1">Result
						Decleration Date</label>
					<input id="result_declaration_date" name="result_declaration_date" type="date"
					       wire:model="result_declaration_date"
					       wire:change="updateResultDeclarationDate"
					       class="appearance-none rounded-md block w-full px-3 py-2 border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
					>
					@error('result_declaration_date')
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
			<h1 class="text-xl text-white font-semibold">Education Management</h1>
			<div>
				<x-button wire:click="add">
					Create Education
				</x-button>
			</div>
		</div>


		<!-- Card Body -->
		<div class="mt-5 px-8">
			<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
				<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
					<thead class="bg-gray-200">
					<tr>
						<th scope="col" class="border px-6 py-3">No</th>
						<th scope="col" class="border px-6 py-3">Degree</th>
						<th scope="col" class="border px-6 py-3">Board</th>
						<th scope="col" class="border px-6 py-3">Obtained Marks</th>
						<th scope="col" class="border px-6 py-3">Total Marks</th>
						<th scope="col" class="border px-6 py-3">Percentage</th>
						<th scope="col" class="border px-6 py-3">Grade</th>
						<th scope="col" class="border px-6 py-3">Roll #</th>
						<th scope="col" class="border px-6 py-3">Result Date</th>
						<th class="" width="150px">Action</th>
					</tr>
					</thead>
					<tbody>
					@forelse($educations as $education)
						<tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
							<td class="">{{ $loop->index + 1  }}</td>
							<td class="">{{ $education->degree->name }}</td>
							<td class="">{{ $education->board }}</td>
							<td class="">{{ $education->obtained_marks }}</td>
							<td class="">{{ $education->total_marks }}</td>
							<td class="">{{ $education->percentage }}%</td>
							<td class="">{{ $education->grade }}</td>
							<td class="">{{ $education->roll_number }}</td>
							<td
								class="">{{ \Carbon\Carbon::parse($education->result_declaration_date)->format('d-m-Y') }}</td>
							<td class="">
								<x-button class="ml-3" wire:click="edit({{ $education->id }})" wire:loading.attr="disabled">
									<i class="fas fa-edit"></i>
								</x-button>
							</td>
						</tr>
					@empty
						<tr>
							<td class="" colspan="7">No Record Found.</td>
						</tr>
					@endforelse
					</tbody>
				</table>
			</div>

		</div>
		<!-- Card Footer -->
		<div class="py-4 px-8">
			{{ $educations->links() }}
		</div>

	@endif

</div>