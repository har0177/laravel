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
		<img src="{{asset('banner.jpg')}}" style="width: 98%;" alt="logo"/>
		<div class="column col-80" style="margin-top: -95px;margin-right: -139px;">
			<h1 style="text-align: center">ADMISSION FORM {{date('Y')}}</h1>
			<ol>
				<li>Admission Sought in: <b>{{ $application->project->diploma->name }}</b></li>
				<li>Open Merit: <span class="tick-mark"></span></li>
				<li><b>Quota Applied For:</b>
					<ol class="list-disc list-inside"
					    style="margin: 0px; display: flex; flex-wrap: wrap;">      @foreach ($application->quotaName as $quotaName)
							@unless(str_contains($quotaName, 'Open'))
								<li style="flex-basis: 40%; padding-right: 20px;">{{ $quotaName }} <span class="tick-mark"></span></li>
							@endunless
						@endforeach
					</ol>
				</li>
			</ol>


		</div>
		<div class="column col-20">
			<img src="{{$user->avatar}}" style="width: 135px;margin-top: -159px;border: 1px solid;border-radius: 10px;"
			     alt="{{$user->full_name}}"/>
			<br>
			<span style="font-size: 12px">	Application # {{{strtoupper($application->application_number)}}}<br>
			Challan # {{{strtoupper($application->challan_number)}}}</span>
		</div>
	</div>
	<hr/>
	<div class="container">
		<h3 class="heading">Domicile</h3>
		<div class="grid-container">
			<div class="grid-item">District/Domicile:</div>
			<div class="grid-item underline">{{strtoupper($user->userInfo->district->name)}}</div>
			<div class="grid-item">Province:</div>
			<div class="grid-item underline">{{strtoupper($user->userInfo->province->name)}}</div>
			<div class="grid-item"></div>
			<div class="grid-item"></div>
			<div class="grid-item">Nationality:</div>
			<div class="grid-item underline">PAKISTAN</div>
		</div>
	</div>
	<div class="container">
		<h3 class="heading">Student</h3>
		<div class="grid-container">
			<div class="grid-item">Name:</div>
			<div class="grid-item underline">{{strtoupper($user->full_name)}}</div>
			<div class="grid-item">Gender:</div>
			<div class="grid-item underline">{{strtoupper($user->userInfo->gender->name)}}</div>
			<div class="grid-item">CNIC:</div>
			<div class="grid-item underline">{{$user->cnic}}</div>
			<div class="grid-item">Date Of Birth:</div>
			<div class="grid-item underline inline-date">{{\Carbon\Carbon::parse($user->userInfo->dob)->format('d-m-Y')}}</div>
			<div class="grid-item">Email:</div>
			<div class="grid-item underline">{{strtoupper($user->email)}}</div>
			<div class="grid-item">Contact No:</div>
			<div class="grid-item underline">{{$user->phone}}</div>
			<div class="grid-item">Religion:</div>
			<div class="grid-item underline">{{$user->userInfo->religion}}</div>
			<div class="grid-item">Hostel Required:</div>
			<div class="grid-item underline">{{$user->userInfo->hostel?'YES':'NO'}}</div>
			<div class="grid-item">Hafiz Quran:</div>
			<div class="grid-item underline">{{$user->userInfo->hafiz_quran?'YES':'NO'}}</div>
			<div class="grid-item">Emergency #:</div>
			<div class="grid-item underline">{{$user->userInfo->emegency_contact}}</div>
		</div>
	</div>

	<div class="container">
		<h3 class="heading">Father</h3>
		<div class="grid-container">
			<div class="grid-item" style="font-size: 12px">Father's / Guardian Name:</div>
			<div class="grid-item underline">{{strtoupper($user->userInfo->father_name)}}</div>
			<div class="grid-item" style="font-size: 12px">Father's / Guardian Phone:</div>
			<div class="grid-item underline">{{$user->userInfo->father_contact}}</div>
		</div>
	</div>

	<div class="container">
		<h3 class="heading">Address</h3>
		<div class="grid-container">
			<div class="grid-item">Address:</div>
			<div class="grid-item underline item-1"
			     style="width: 100% !important;">{{strtoupper($user->userInfo->address)}}</div>
			<div class="grid-item">Postal Address:</div>
			<div class="grid-item underline item-1"
			     style="width: 100% !important;">{{strtoupper($user->userInfo->postal_address ?? $user->userInfo->address)}}</div>
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
			number.Incomplete form will not be considered. (&#10003;
			the box)
		</p>
		<div class="document-list">
			<div class="column">
				<ol>
					<li>
						<input type="checkbox">
						SSC provisional Certificate / DMC (2 copies)
					</li>
					<li>
						<input type="checkbox">
						Recent Picture of Student (3 No.)
					</li>
					<li>
						<input type="checkbox">
						Domicile Certificate (2 copies)
					</li>
					<li>
						<input type="checkbox">
						Agreement on Stamp paper of Rs. 200/- for selected candidates only.
					</li>
				</ol>
			</div>
			<div class="column">
				<ol>
					<li>
						<input type="checkbox">
						CNIC/Form-B of Student (1 copy)
					</li>
					<li>
						<input type="checkbox">
						Affidavit on Stamp paper of Rs. 200/- for selected candidate only.
					</li>
					<li>
						<input type="checkbox">
						Hafiz e Quran Certificate (1 Copy). Additional 20 Marks will be added.
					</li>
					<li>
						<input type="checkbox">
						Migration Certificate Original for selected candidate within 1 Month after admission.
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
