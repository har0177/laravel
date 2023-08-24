<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

			<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
				Online Apply Instructions
			</div>
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">

				<div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex-1">
					<div class="space-y-2">
						<ol class="list-decimal list-inside">
							<!-- List items here -->


						<li class="mb-2">Interested candidates may first apply for their desired discipline.</li>
						<li class="mb-2">All candidates must apply for the disciplines online through ASA Website. Manual submission of the application form is not admissible.</li>
						<li class="mb-2">Upon successful submission of an online application, a prescribed deposit slip (having challan number and candidates’ personal information) will be generated.</li>
						<li class="mb-2">Take a printout of the generated deposit slip and deposit the application fee as per the methods prescribed below:
							<ul class="list-disc list-inside ml-4">
								<li>Any branch of NBP Bank (free of charge)</li>
							</ul>
						</li>
						<li class="mb-2">Upon successful submission of the fee 	keep the original deposit slip (candidate copy) duly signed and stamped.
							<ul class="list-disc list-inside ml-4">
								<li>Enter computer generated challan number printed on slip to get application form.</li>
								<li>ASA challan copy in original along with the documents mentioned in the application form should be sent to the address of <br> <strong>Principal, Agriculture Services Academy Peshawar within the due date.</strong></li>
							</ul>

						</li>
						<li class="mb-2">List of candidates will be uploaded on ASA Website (<a href="http://www.asap.edu.pk" class="text-blue-500 hover:underline">www.asap.edu.pk</a>) and ASA Official Facebook page within stipulated time.</li>
						<li class="mb-2">All candidates should keep ASA official Facebook Page and Website (<a href="http://www.asap.edu.pk" class="text-blue-500 hover:underline">www.asap.edu.pk</a>) for updates and information.</li>
						</ol>
					</div>
				</div>

				<div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8 w-96">
					<img src="{{asset('instruction.png')}}" alt="Instruction Image">
				</div>
			</div>
		</div>
	</div>
</x-app-layout>