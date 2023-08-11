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
					Declarations
				</div>

				<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
					<p class="col-span-2">
						I <strong class="underline">{{auth()->user()->full_name}}</strong> D/S/W of
						<strong class="underline">{{auth()->user()->father_name}}</strong> having CNIC #
						<strong class="underline">{{auth()->user()->cnic}}</strong> and Phone No
						<strong class="underline">{{auth()->user()->phone}}</strong>, do hereby solemnly affirm &amp; declare that:
					</p>
					<ol class="col-span-2 list-decimal list-inside pl-4">
						<li>
							All the information given/provided by me in this Profile before going to apply for any post for government
							employment and all additional Particulars/Documents/Certificates furnished along with it are correct and
							true to the best of my knowledge and belief &amp; nothing has been concealed.
						</li>
						<li>
							I have never been dismissed/removed from any Government service under any Provincial/Federal
							Government/autonomous &amp; Semi-autonomous or any statutory body or state enterprise.
						</li>
						<li>
							I have never been involved in any criminal case or activities not only in Pakistan but also in any other
							country.
						</li>
						<li>
							To avoid impersonation &amp; Zero Tolerance Merit Transparency, I agree with ETA Policy and steps for
							examinations like (Biometric verification, eyes lens matching and Picture matching) at any stage before or
							after the test.
						</li>
						<li>
							I also confirm that this declaration is only for my job recruitment purpose.
						</li>
					</ol>
					<p class="col-span-2">
						If any declaration or information and/ or details provided by me is found incorrect/false at any stage, I
						shall be liable to legal action(s), Including but not limited to cancellation of my candidature and/ or
						termination from service. <br>
						<strong class="text-red"> Note:-</strong> If you are not agree with this declaration then kindly do not apply
						via the Elegant Testing Agency (ETA) for your desired post.
					</p>
					<div class="my-1 ml-1 mr-1 text-green-600 font-bold">
						<i class="fa fa-check"></i> &nbsp;
						I accept the above declarations willingly.
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>