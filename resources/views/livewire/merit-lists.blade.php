<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	@if (session()->has('success'))
		<x-flash-success-message message="{{ session('success') }}"/>
	@endif
	@if (session()->has('error'))
		<x-flash-error-message message="{{ session('error') }}"/>
	@endif


	<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
		<h1 class="text-xl text-white font-semibold">Merit List Management</h1>
	</div>
	<!-- Card Body -->
	<div class="mt-5 px-8">
		<form class="py-6 px-4 sm:px-6" wire:submit.prevent="generateMeritList">
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<!-- Name field -->

				<div class="mb-4">
					<label for="project" class="block text-sm font-medium text-gray-700 mb-1">Project</label>
					<div class="relative">
						<select name="project" id="project" wire:model.live="project"
						        class="select2 block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							<option value="">Select Option</option>
							@foreach($projectList as $project)
								<option value="{{$project->id}}">{{$project->diploma->name}}</option>
							@endforeach
						</select>

					</div>
					@error('project')
					<span class="text-red-600 text-sm">{{ $message }}</span>
					@enderror


				</div>

				<div class="mb-4">
					<button type="submit"
					        wire:loading.attr="disabled"
					        class="mt-6 max-w-md bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-white">
						<span wire:loading wire:target="generateMeritList">Saving...</span>
						<span wire:loading.remove wire:target="generateMeritList">Generate Merit List</span>
					</button>
					<x-button type="button" wire:click="toggleSection">
						Reset
					</x-button>

				</div>

			</div>


		</form>

		@if($view)
			@php
				// Create an associative array where the keys are district IDs and the values are flags indicating data presence
				$districtDataPresence = [];

				// Initialize the flags for all districts to false
				foreach ($districtList as $district) {
								$districtDataPresence[$district->id] = false;
				}

				// Check if there's data for each district in $meritData
				foreach ($meritData as $merit) {
								if (isset($districtDataPresence[$merit->district_id])) {
												$districtDataPresence[$merit->district_id] = true;
								}
				}
			@endphp
			@php
				$filteredMeritData = $meritData->filter(function ($merit) {
								return !empty($merit->quota_id) && $merit->quota_id === 33;
				})->sortBy('merit_number');
			@endphp




			<div class="mb-4">
				<h3 class="text-xl mb-5 text-center font-semibold">Open Merit: {{$project->diploma->name}}</h3>
				<div class="overflow-x-auto">
					<table class="min-w-full bg-white rounded-lg shadow-xs overflow-hidden" style="font-size: 14px !important;">
						<thead class="bg-gray-800 text-white">
						<tr>
							<th class="py-1 px-3">Open Merit #</th>
							<th class="py-1 px-3">Name</th>
							<th class="py-1 px-3">Father Name</th>
							<th class="py-1 px-3">District</th>
							<th class="py-1 px-3">DOB</th>
							<th class="py-1 px-3">Hifz Marks</th>
							<th class="py-1 px-3">SSc Marks</th>
							<th class="py-1 px-3">Total Marks</th>
							<th class="py-1 px-3">Percentage</th>
							<th class="py-1 px-3">Remarks</th>
						</tr>
						</thead>
						<tbody class="text-gray-700">
						@foreach($filteredMeritData as $merit)
								<tr>
									<td class="py-1 px-3">{{$merit->merit_number}}</td>
									<td class="py-1 px-3">{{$merit->user->full_name}}</td>
									<td class="py-1 px-3">{{$merit->user->userInfo->father_name}}</td>
									<td class="py-1 px-3">{{$district->name}}</td>
									<td class="py-1 px-3">{{\Carbon\Carbon::parse($merit->user->dob)->format('d-m-Y')}}</td>
									<td class="py-1 px-3"></td>
									<td class="py-1 px-3">{{$merit->user->education[0]->obtained_marks}}</td>
									<td class="py-1 px-3">{{$merit->user->education[0]->total_marks}}</td>
									<td class="py-1 px-3">{{$merit->user->education[0]->percentage}}</td>
									<td class="py-1 px-3"></td>
								</tr>

						@endforeach
						</tbody>
					</table>
				</div>
			</div>

			@foreach($districtList as $district)

				@if($districtDataPresence[$district->id])
					<div class="mb-4">
						<h3 class="text-xl mb-5 text-center font-semibold">District: {{$district->name}} : {{$project->diploma->name}}</h3>
						<div class="overflow-x-auto">
							<table class="min-w-full bg-white rounded-lg shadow-xs overflow-hidden" style="font-size: 14px !important;">
								<thead class="bg-gray-800 text-white">
								<tr>
									<th class="py-1 px-3">District Merit #</th>
									<th class="py-1 px-3">Open Merit #</th>
									<th class="py-1 px-3">Name</th>
									<th class="py-1 px-3">Father Name</th>
									<th class="py-1 px-3">District</th>
									<th class="py-1 px-3">DOB</th>
									<th class="py-1 px-3">Hifz Marks</th>
									<th class="py-1 px-3">SSc Marks</th>
									<th class="py-1 px-3">Total Marks</th>
									<th class="py-1 px-3">Percentage</th>
									<th class="py-1 px-3">Remarks</th>
								</tr>
								</thead>
								<tbody class="text-gray-700">
								@php
									$filteredMeritData = $meritData->where('user.userInfo.district_id', $district->id)->sortBy('district_number');
								@endphp

								@foreach($filteredMeritData as $merit)
									@if($merit->user->userInfo->district_id === $district->id)
										<tr>
											<td class="py-1 px-3">{{$merit->district_number}}</td>
											<td class="py-1 px-3">{{$merit->quota_id === 33 ? $merit->merit_number : ''}}</td>
											<td class="py-1 px-3">{{$merit->user->full_name}}</td>
											<td class="py-1 px-3">{{$merit->user->userInfo->father_name}}</td>
											<td class="py-1 px-3">{{$district->name}}</td>
											<td class="py-1 px-3">{{\Carbon\Carbon::parse($merit->user->dob)->format('d-m-Y')}}</td>
											<td class="py-1 px-3"></td>
											<td class="py-1 px-3">{{$merit->user->education[0]->obtained_marks}}</td>
											<td class="py-1 px-3">{{$merit->user->education[0]->total_marks}}</td>
											<td class="py-1 px-3">{{$merit->user->education[0]->percentage}}</td>
											<td class="py-1 px-3"></td>
										</tr>
									@endif
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				@endif
			@endforeach
		@endif

	</div>


</div>



