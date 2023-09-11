<x-guest-layout>
	<style>
     @media print {
         table {
             font-size: 12px !important;
         }

         @page {
             size: A4 landscape;
             page-break-before: always;
         }
     }
	</style>
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
						return !empty($merit->quota_id);
		})->sortBy('merit_number');
	@endphp


	<div class="mb-4">
		<h3 class="text-xl mb-5 text-center font-semibold">Open Merit: {{$project->diploma->name}}</h3>
		<div class="overflow-x-auto">
			<table class="min-w-full whitespace-no-wrap">
				<thead class="bg-gray-800 text-white">
				<tr>
					<th class=" border">Open Merit #</th>
					<th class=" border">Name</th>
					<th class=" border">Father Name</th>
					<th class=" border">District</th>
					<th class=" border">DOB</th>
					<th class=" border">Hifz Marks</th>
					<th class=" border">SSc Marks</th>
					<th class=" border">Total Marks</th>
					<th class=" border">Percentage</th>
					<th class=" border">Remarks</th>
				</tr>
				</thead>
				<tbody class="text-gray-700">
				@foreach($filteredMeritData as $merit)
					@if($merit->quota_id === 33)
						<tr class="hover:bg-gray-200">
							<td class=" border">{{$merit->merit_number}}</td>
							<td class=" border">{{$merit->user->full_name}}</td>
							<td class=" border">{{$merit->user->student->father_name}}</td>
							<td class=" border">{{$district->name}}</td>
							<td class=" border">{{\Carbon\Carbon::parse($merit->user->dob)->format('d-m-Y')}}</td>
							<td class=" border"></td>
							<td class=" border">{{$merit->user->education[0]->obtained_marks}}</td>
							<td class=" border">{{$merit->user->education[0]->total_marks}}</td>
							<td class=" border">{{$merit->user->education[0]->percentage}}</td>
							<td class=" border"></td>
						</tr>
					@endif
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div style="break-after:page"></div>


	@foreach($districtList as $district)
		@if($districtDataPresence[$district->id])
			<div class="mb-4">
				<h3 class="text-xl mb-5 text-center font-semibold">District: {{$district->name}} : {{$project->diploma->name}}</h3>
				<div class="overflow-x-auto">
					<table class="min-w-full whitespace-no-wrap">
						<thead class="bg-gray-800 text-white">
						<tr>
							<th class=" border">District Merit #</th>
							<th class=" border">Open Merit #</th>
							<th class=" border">Name</th>
							<th class=" border">Father Name</th>
							<th class=" border">District</th>
							<th class=" border">DOB</th>
							<th class=" border">Hifz Marks</th>
							<th class=" border">SSc Marks</th>
							<th class=" border">Total Marks</th>
							<th class=" border">Percentage</th>
							<th class=" border">Remarks</th>
						</tr>
						</thead>
						<tbody class="text-gray-700">
						@php
							$filteredMeritData = $meritData->where('user.student.district_id', $district->id)->sortBy('district_number');
						@endphp

						@foreach($filteredMeritData as $merit)
							@if($merit->user->student->district_id === $district->id && !empty($merit->district_number))
								<tr class="hover:bg-gray-200">
									<td class=" border">{{$merit->district_number}}</td>
									<td class=" border">{{$merit->quota_id === 33 ? $merit->merit_number : ''}}</td>
									<td class=" border">{{$merit->user->full_name}}</td>
									<td class=" border">{{$merit->user->student->father_name}}</td>
									<td class=" border">{{$district->name}}</td>
									<td class=" border">{{\Carbon\Carbon::parse($merit->user->dob)->format('d-m-Y')}}</td>
									<td class=" border"></td>
									<td class=" border">{{$merit->user->education[0]->obtained_marks}}</td>
									<td class=" border">{{$merit->user->education[0]->total_marks}}</td>
									<td class=" border">{{$merit->user->education[0]->percentage}}</td>
									<td class=" border"></td>
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div style="break-after:page"></div>
		@endif

	@endforeach

	@foreach($quotaList as $quota)
		<div class="mb-4">
			<h3 class="text-xl mb-5 text-center font-semibold">Quota: {{$quota->name}} : {{$project->diploma->name}}</h3>
			<div class="overflow-x-auto">
				<table class="min-w-full whitespace-no-wrap">
					<thead class="bg-gray-800 text-white">
					<tr>
						<th class=" border">Merit #</th>
						<th class=" border">Name</th>
						<th class=" border">Father Name</th>
						<th class=" border">District</th>
						<th class=" border">DOB</th>
						<th class=" border">Hifz Marks</th>
						<th class=" border">SSc Marks</th>
						<th class=" border">Total Marks</th>
						<th class=" border">Percentage</th>
						<th class=" border">Remarks</th>
					</tr>
					</thead>
					<tbody class="text-gray-700">
					@php
						$filteredMeritData = $meritData->where('quota_id', $quota->id)->sortBy('merit_number');
					@endphp

					@foreach($filteredMeritData as $merit)
						<tr>
							<td class=" border">{{$merit->merit_number}}</td>
							<td class=" border">{{$merit->user->full_name}}</td>
							<td class=" border">{{$merit->user->student->father_name}}</td>
							<td class=" border">{{$district->name}}</td>
							<td class=" border">{{\Carbon\Carbon::parse($merit->user->dob)->format('d-m-Y')}}</td>
							<td class=" border"></td>
							<td class=" border">{{$merit->user->education[0]->obtained_marks}}</td>
							<td class=" border">{{$merit->user->education[0]->total_marks}}</td>
							<td class=" border">{{$merit->user->education[0]->percentage}}</td>
							<td class=" border"></td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div style="break-after:page"></div>
	@endforeach

</x-guest-layout>