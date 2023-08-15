<div class="bg-white border border-gray-200 rounded-lg shadow-lg">
	<div class="mt-4 mb-4 text-center">
		@if (session()->has('success'))
			<span class="px-3  py-1 bg-green-600 text-white rounded">{{ session('success') }}</span>
		@endif


		@if (session()->has('error'))
			<span class="px-3 mt-4 mb-4 text-center py-1 bg-red-600 text-white rounded">{{ session('error') }}</span>
		@endif
	</div>


		<div class="bg-indigo-600 py-4 px-6 flex items-center justify-between">
			<h1 class="text-xl text-white font-semibold">Online Apply</h1>
		</div>


</div>