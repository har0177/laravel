<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="{{asset('form-style.css')}}"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!-- Link to your CSS file -->
	<title>Admission Form</title>
</head>

<body>
<div class="a4-page">
	<div class="row">
		<img src="{{asset('banner.png')}}" style="width: 100%;" alt="logo"/>
		<div class="column col-80" style="margin-top: -30px;margin-right: -139px;">
			<h1 style="text-align: center">ADMISSION FORM {{date('Y')}}</h1>
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
			<img src="{{$user->avatar}}" style="width: 135px;margin-top: -30px;border: 1px solid;border-radius: 10px;"
			     alt="{{$user->full_name}}"/>
			<br>
			<span style="font-size: 12px">	Application # {{{$application->application_number}}}<br>
			Challan # {{{$application->challan_number}}}</span>
		</div>
	</div>
	<hr/>
	<div class="container">
		<h3 class="heading">Domicile</h3>
		<div class="grid-container">
			<div class="grid-item">District/Domicile:</div>
			<div class="grid-item underline">{{$user->userInfo->district->name}}</div>
			<div class="grid-item">Province:</div>
			<div class="grid-item underline">{{$user->userInfo->province->name}}</div>
			<div class="grid-item"></div>
			<div class="grid-item"></div>
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
			<div class="grid-item">Hafiz Quran:</div>
			<div class="grid-item underline">{{$user->userInfo->hafiz_quran?'Yes':'No'}}</div>
			<div class="grid-item">Emergency #:</div>
			<div class="grid-item underline">{{$user->userInfo->emegency_contact}}</div>
		</div>
	</div>

	<div class="container">
		<h3 class="heading">Father</h3>
		<div class="grid-container">
			<div class="grid-item" style="font-size: 12px">Father's / Guardian Name:</div>
			<div class="grid-item underline">{{$user->userInfo->father_name}}</div>
			<div class="grid-item" style="font-size: 12px">Father's / Guardian Phone:</div>
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
						1. &nbsp;Documents (2 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						2. &nbsp; Recent Picture of Student (4 No.)
						<div class="checkbox"></div>
					</li>

				</ol>
			</div>
			<div class="column">
				<ol>
					<li>
						3. &nbsp; Domicile Certificate (2 copy)
						<div class="checkbox"></div>
					</li>
					<li>
						4. &nbsp; CNIC/Form-B of Student (2 copy)
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
		<div class="grid-item">Cashier Signature</div>
		<div class="grid-item underline"></div>
		<div class="text-center border item-3"></div>
		<div class="text-center underline"></div>
		<div class="text-center item-3">
			Admission Committee Member's Signature
		</div>
		<div class="text-center">Principal's Signature</div>
	</div>
</div>
</body>
<script type="text/javascript">
	//--kiosk-printing
	'use strict'

	window.print()
	var beforePrint = function () {
		console.log('Functionality to run before printing.')
	}

	var afterPrint = function () {
		console.log('Functionality to run after printing')
	}

	if (window.matchMedia) {
		var mediaQueryList = window.matchMedia('print')
		mediaQueryList.addListener(function (mql) {
			if (mql.matches) {
				beforePrint()
			} else {
				afterPrint()
			}
		})
	}

	window.onbeforeprint = beforePrint
	window.onafterprint = afterPrint


</script>
</html>
