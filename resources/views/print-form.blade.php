<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="{{asset('form-style.css')}}"/>
	<!-- Link to your CSS file -->
	<title>Admission Form</title>
</head>

<body>
<div class="a4-page">
	<div class="row">
		<img src="{{asset('banner.jpg')}}" style="width: 100%; margin: 0px 10px" alt="logo"/>
		<div class="column col-80">
			<ol>
				<li>Admission Sought in: <b>{{ $application->project->diploma->name }}</b></li>
				<li>Open Merit: <span class="tick-mark"></span></li>
				<li><b>Quota Applied For:</b>
					<ol class="list-disc list-inside" style="margin: 0px">
						@foreach ($application->quotaName as $quotaName)
							@unless(str_contains($quotaName, 'Open'))
								<li>{{ $quotaName }} <span class="tick-mark"></span></li>
							@endunless
						@endforeach
					</ol>
				</li>
			</ol>


		</div>
		<div class="column col-20">
			<img src="{{$user->avatar}}" style="width: 70px" alt="{{$user->full_name}}"/>
		</div>
	</div>
	<hr/>
	<div class="container">
		<h3 class="heading">Domicile</h3>
		<div class="grid-container">
			<div class="grid-item">Province:</div>
			<div class="grid-item underline">{{$user->userInfo->province->name}}</div>
			<div class="grid-item">District/Domicile:</div>
			<div class="grid-item underline">{{$user->userInfo->district->name}}</div>
			<div class="grid-item">Nationality:</div>
			<div class="grid-item underline">Pakistan</div>
		</div>
	</div>
	<div class="container">
		<h3 class="heading">Student</h3>
		<div class="grid-container">
			<div class="grid-item">Name:</div>
			<div class="grid-item underline">{{$user->full_name}}</div>
			<div class="grid-item">Gender:</div>
			<div class="grid-item underline">{{$user->userInfo->gender->name}}</div>
			<div class="grid-item">CNIC:</div>
			<div class="grid-item underline">{{$user->cnic}}</div>
			<div class="grid-item">Date Of Birth:</div>
			<div class="grid-item underline inline-date">{{\Carbon\Carbon::parse($user->userInfo->dob)->format('d-m-Y')}}</div>
			<div class="grid-item">Email:</div>
			<div class="grid-item underline">{{$user->email}}</div>
			<div class="grid-item">Contact No:</div>
			<div class="grid-item underline">{{$user->phone}}</div>
			<div class="grid-item">Religion:</div>
			<div class="grid-item underline">{{$user->userInfo->religion}}</div>
			<div class="grid-item">Hostel Required:</div>
			<div class="grid-item underline">{{$user->userInfo->hostel?'Yes':'No'}}</div>
			<div class="grid-item">Emergency #:</div>
			<div class="grid-item underline">{{$user->userInfo->emegency_contact}}</div>
		</div>
	</div>

	<div class="container">
		<h3 class="heading">Father</h3>
		<div class="grid-container">
			<div class="grid-item">Father's / Guardian Name:</div>
			<div class="grid-item underline">{{$user->userInfo->father_name}}</div>
			<div class="grid-item">Father's / Guardian CNIC:</div>
			<div class="grid-item underline">{{$user->userInfo->father_nic}}</div>
			<div class="grid-item">Father's / Guardian Phone:</div>
			<div class="grid-item underline">{{$user->userInfo->father_contact}}</div>
		</div>
	</div>

	<div class="container">
		<h3 class="heading">Address</h3>
		<div class="grid-container">
			<div class="grid-item">Address:</div>
			<div class="grid-item underline item-1" style="width: 100% !important;">{{$user->userInfo->address}}</div>
			<div class="grid-item">Postal Address:</div>
			<div class="grid-item underline item-1"
			     style="width: 100% !important;">{{$user->userInfo->postal_address ?? $user->userInfo->address}}</div>
		</div>
	</div>


	<div class="row" style="margin-top: 3px !important;">
		<table id="educations">
			<thead>
			<tr>
				<th>Degree/Certificate</th>
				<th>Board Name</th>
				<th>Roll No</th>
				<th>Obtained Marks</th>
				<th>Total Marks</th>
				<th>Percentage</th>
				<th>Result Date</th>
			</tr>

			</thead>
			<tbody>
			@foreach($user->education as $education)
				<tr>
					<td>{{$education->degree->name}}</td>
					<td>{{$education->board}}</td>
					<td>{{$education->roll_number}}</td>
					<td>{{$education->obtained_marks}}</td>
					<td>{{$education->total_marks}}</td>
					<td>{{$education->percentage}}</td>
					<td>{{\Carbon\Carbon::parse($education->result_declaration_date)->format('d-m-Y')}}</td>
				</tr>
			@endforeach
			</tbody>

		</table>

		<p style="font-size: 12px">
			<b>Note:-</b> Form must be accompanied with following attested documents in
			required documents.Incomplete form will not be considered. (&#10003;
			the box)
		</p>
		<div class="document-list" style="margin-top: -20px">
			<div class="column">
				<ol>
					<li>
						1. &nbsp; SSC Provisional Certificate (1 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						2. &nbsp; Detail Marks Certificate (D.M.C) (1 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						3. &nbsp; Recent Photographs of Students (3 No.)
						<div class="checkbox"></div>
					</li>
					<li>
						4. &nbsp; Domicile Certificate (1 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						5. &nbsp; CNIC/Form-B of Student (1 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						6. &nbsp; Father's CNIC (2 copies)
						<div class="checkbox"></div>
					</li>

				</ol>
			</div>
			<div class="column">
				<ol>
					<li>
						7. &nbsp;CNIC of the Guardian (1 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						8. &nbsp; Affidavit on Stamp Paper of Rs. 100/- for selected candidates only
						<div class="checkbox"></div>
					</li>
					<li>
						9. &nbsp; Agreement on Stamp Paper of Rs. 100/- for selected candidates only
						<div class="checkbox"></div>
					</li>
					<li>

						10. &nbsp; Character Certificate from the last attended Institute (1 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						11. &nbsp; Migration Certificate Original (in case of other Board) along with one photocopy
						<div class="checkbox"></div>
					</li>
				</ol>
			</div>
		</div>
	</div>

	<h3 class="text-center">FOR OFFICE USE ONLY</h3>

	<div class="grid-container-office">
		<div class="grid-item">Admission No:</div>
		<div class="grid-item underline"></div>
		<div class="grid-item">Fee Deposited (Rs.)</div>
		<div class="grid-item underline"></div>
		<div class="grid-item">Challan #:</div>
		<div class="grid-item underline"></div>
		<div class="grid-item text-center">Cashier Signature</div>
		<div class="grid-item underline"></div>
		<div class="text-center border item-3"></div>
		<div class="text-center underline"></div>
		<div class="text-center item-3">
			Admission Committee Member's Signature
		</div>
		<div class="text-center">Principal's Signature</div>
	</div>
</div>


{{--<div class="slip">
	<table>
		<tr class="text-center">
			<td>
				<img src="images/logo.png" alt="logo">
			</td>
			<td colspan="2">
				<h3>
					Karachi Institute of Power
					Engineering (KINPOE) <br>
					<span class="bg-color">BANK COPY</span>
				</h3>
			</td>
		</tr>
		<tr class="text-center">
			<td colspan="3"><strong>ONLINE DEPOSIT SLIP</strong></td>
		</tr>
		<tr>
			<td colspan="2">Branch Code:</td>
			<td>Date:</td>
		</tr>
		<tr>
			<td colspan="3">Branch Name:</td>
		</tr>
		<tr>
			<td colspan="3">
				Remote Branch: <br>
				A/C Title: <br>
				A/C No: <br>
			</td>
		</tr>
		<tr>
		<tr>
			<td>Application Ref. No:</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>CNIC/Form B NO:</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>Applicant's Name</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>Father's Name:</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>Mobile No:</td>
			<td colspan="2"></td>
		</tr>
		<tr height="20px">
			<td rowspan="2">Address:</td>
			<td colspan="2"></td>
		</tr>
		<tr height="20px">
			<td colspan="2"></td>
		</tr>
		</tr>
		<tr>
			<td>Training Program Please (&#x2713;)</td>
			<td class="text-center"><strong>PGTP</strong></td>
			<td class="text-center"><strong>PDTP</strong> &#x2713;</td>
		</tr>
		<tr>
		<tr>
			<td>Amount in (Rs.):</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>Amount in Words:</td>
			<td colspan="2"></td>
		</tr>
		</tr>
	</table>
	<small>* No Bank Charges to be paid by student.</small>
	<div class="row">
		<div class="column col-50">
			<span class="text-overline">Applicant's Signature</span>
		</div>
		<div class="column col-25">
			<span class="text-overline">Cashier</span>
		</div>
		<div class="column col-25">
			<span class="text-overline">Officer</span>
		</div>
	</div>
</div>--}}


</body>
</html>
