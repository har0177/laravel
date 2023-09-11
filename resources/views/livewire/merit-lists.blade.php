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


	</div>


</div>



