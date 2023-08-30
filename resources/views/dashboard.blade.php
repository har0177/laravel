<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
					<div class="block rounded-lg bg-white shadow-md p-6">
						<h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
							Total Students
						</h5>
						<p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
							{{$students}}
						</p>
					</div>

					<div class="block rounded-lg bg-white shadow-md p-6">
						<h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
							Total Applications
						</h5>
						<p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
							{{$applications}}
						</p>
					</div>

				</div>

			</div>
		</div>
	</div>
</x-app-layout>