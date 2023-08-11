<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

				<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
					Online Apply Instructions
				</div>

				<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 lg:gap-8 p-6 lg:p-8">

						<h6 class="black-text">How To Apply :</h6>
						<ol class="list-decimal list-inside">
							<li class="list-disc">Interested candidates may first apply for their desired posts.</li>
							<li class="list-disc">All candidates must apply for the desired posts online through ETEA’s Website. Manual submission of the application form is not admissible.</li>
							<li class="list-disc">Upon successful submission of an online application, a prescribed deposit slip (having token number, project code, and candidates’ personal information) will be generated. Take a printout of the generated deposit slip and deposit the prescribed test fee and service charges if applicable, as per the methods prescribed below:</li>
							<ol class="list-decimal list-inside pl-6">
								<li class="list-disc text-red-600">Any branch of UBL Bank (free of charge)</li>
								<li class="list-disc text-red-600">UBL OMNI Agent on payment, additional charges of Rs. 25</li>
								<li class="list-disc text-red-600">EASYPAISA Mobile App (free of charge)</li>
								<li class="list-disc text-red-600">EASYPAISA Agent on payment, additional charges of Rs. 1.25%</li>
								<li class="list-disc text-red-600">JAZZCASH Mobile App (free of charge)</li>
								<li class="list-disc text-red-600">JAZZCASH Agent on payment, additional charges of Rs. 1.25%</li>
							</ol>
							<li class="list-disc">Upon successful submission of the fee, keep the original deposit slip (candidate copy) duly signed and stamped or message/receipt from the respective digital payment agent, as mentioned above, with yourself. Do not share it with anyone else.</li>
							<li class="list-disc">Do not send documents/testimonials to the ETEA office, if you have not been directed to do so. Copies of the testimonials/documents will, however, be provided by the qualified candidates as and when required by ETEA and/or the Appointing Authority for scrutiny purposes.</li>
							<li class="list-disc">Candidates will be informed through <a href="https://etea.edu.pk/" target="_blank" class="text-red-600">ETEA Website</a>, SMS, <a href="https://www.facebook.com/ETEAOFFICIALKP" target="_blank" class="text-red-600">ETEA Official Facebook page</a>, LinkedIn Page, Twitter Page, and to download and print their Roll No. Slips.</li>
							<li class="list-disc">Candidates must not provide a ported/converted mobile number as their contact number. In case a candidate has converted their mobile SIM to another network or blocked promotional messages on their phone, they may not receive any messages from ETEA. Furthermore, if the mobile phone is powered off or out of network coverage for 3 hours, the message from ETEA will be automatically expired without delivery.</li>
							<li class="list-disc">All candidates should keep following the ETEA official Facebook Page and Website for updates and information.</li>
							<li class="list-disc">Test Date, Time, and Venue will be mentioned on the Roll Number Slip. No Separate Call Letter will be issued to the candidates for the screening test.</li>
						</ol>


				</div>
			</div>
		</div>
	</div>
</x-app-layout>