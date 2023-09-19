@include('header')

@include('navbar')

<div class="container-fluid pt-2 mb-5">
	<div class="row pt-4 contact-info">
		<div class="col-lg-6 my-6 mb-5">
			<h3>Downloads</h3>
			<div class="row my-6">
				<div class="mb-4">
					<div class="overflow-x-auto">
						<table class="table">
							<tr>
								<th class=" border">Admission Challan First Year</th>
								<td class=" border"><a href="{{asset('AdmissionChallanFirstYear.pdf')}}">Download</a></td>
							</tr>
							<tr>
								<th class=" border">Admission Challan Second / Third Year</th>
								<td class=" border"><a href="{{asset('AdmissionChallanSecondThirdYear.pdf')}}">Download</a></td>
							</tr>
							<tr>
								<th class=" border">ASA Hostel Fee First Year</th>
								<td class=" border"><a href="{{asset('ASAHostelFeeFirstYear.pdf')}}">Download</a></td>
							</tr>
							<tr>
								<th class=" border">ASA Hostel Fee Second / Third Year</th>
								<td class=" border"><a href="{{asset('ASAHostelFeeSecondThirdYear.pdf')}}">Download</a></td>
							</tr>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@include('footer')