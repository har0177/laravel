<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('challan.css')}}">
</head>

<body>
<div class="a4-page">
<div class="content">
	<div class="table-container">
		<div style="
    display: flex;
    justify-content: space-evenly;
    font-size: 16px;
    align-items: center;
    text-align: center;
    margin-bottom: 10px;
">
			<div>
				<img src="{{ asset('images/logo.jpg') }}" alt="logo" width="80px">
			</div>
			<div>
				<strong>
					AGRICULTURE SERVICES <br> ACADEMY, PESHAWAR
				</strong>
				<br>
				<br>
				<span class="bg-styling"><strong>BANK COPY</strong></span>
			</div>
		</div>
		<table>


			<tr>
				<td>Branch Code:____________________</td>
				<td>Valid Upto: <strong
						class="underline">{{\Carbon\Carbon::parse($application->project->expiry_date)->format('d-m-Y')}}</strong></td>
			</tr>
			<tr>
				<td colspan="2">Branch Name:________________________________________</td>
			</tr>
			<tr>
				<td colspan="2">Application No: <strong class="underline">{{$application->application_number}}</strong></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"><strong>ONLINE BANK DEPOSIT SLIP</strong></td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" class="table">
						<tr>
							<td colspan="2" class="text-center">
								<img src="{{asset('nbp.png')}}" style="height: 100px" alt="NBP"> <br>
								Remote Branch: University Campus Branch, Peshawar
							</td>
						</tr>
						<tr>
							<td class="text-center">
								Principal Agriculture Training Institute
							</td>
							<td class="text-center">
								PK59NBPA0388003048617735
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" class="table">
						<tr>
							<td>
								Name
							</td>
							<td>
								{{$application->user->full_name}}
							</td>
						</tr>
						<tr>
							<td>
								Father Name
							</td>
							<td>
								{{$application->user->userInfo?->father_name}}
							</td>
						</tr>
						<tr>
							<td>
								Diploma
							</td>
							<td>
								{{$application->project->diploma?->name}}
							</td>
						</tr>
						<tr>
							<td>
								CNIC
							</td>
							<td>
								{{$application->user->cnic}}
							</td>
						</tr>
						<tr>
							<td>
								Contact
							</td>
							<td>
								{{$application->user->phone}}
							</td>
						</tr>
						<tr>
							<td>
								On Account Of
							</td>
							<td>
								<em>Admission Fee
								</em>
							</td>
						</tr>
						<tr>
							<td>
								Fee Amount
							</td>
							<td>
								Rs. {{$application->project->fee}}/-
							</td>
						</tr>
						<tr>
							<td>
								In Words
							</td>
							<td>
								{{\App\Helper\Common::amountToWords($application->project->fee)}}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="signature">
					Bank Officer Signature
				</td>
				<td class="signature">
					Depositor Signature
				</td>
			</tr>
			{{--			<tr>
							<td colspan="2">
								<small>Generated by I.T Department (UMS Office)
								</small>
							</td>
						</tr>--}}
		</table>
	</div>
	<div class="table-container">
		<div style="
    display: flex;
    justify-content: space-evenly;
    font-size: 16px;
    align-items: center;
    text-align: center;
    margin-bottom: 10px;
">
			<div>
				<img src="{{ asset('images/logo.jpg') }}" alt="logo" width="80px">
			</div>
			<div>
				<strong>
					AGRICULTURE SERVICES <br> ACADEMY, PESHAWAR
				</strong>
				<br>
				<br>
				<span class="bg-styling"><strong>ACCOUNT COPY</strong></span>
			</div>
		</div>
		<table>


			<tr>
				<td>Branch Code:____________________</td>
				<td>Valid Upto: <strong
						class="underline">{{\Carbon\Carbon::parse($application->project->expiry_date)->format('d-m-Y')}}</strong></td>
			</tr>
			<tr>
				<td colspan="2">Branch Name:________________________________________</td>
			</tr>
			<tr>
				<td colspan="2">Application No: <strong class="underline">{{$application->application_number}}</strong></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"><strong>ONLINE BANK DEPOSIT SLIP</strong></td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" class="table">
						<tr>
							<td colspan="2" class="text-center">
								<img src="{{asset('nbp.png')}}" style="height: 100px" alt="NBP"> <br>
								Remote Branch: University Campus Branch, Peshawar
							</td>
						</tr>
						<tr>
							<td class="text-center">
								Principal Agriculture Training Institute
							</td>
							<td class="text-center">
								PK59NBPA0388003048617735
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" class="table">
						<tr>
							<td>
								Name
							</td>
							<td>
								{{$application->user->full_name}}
							</td>
						</tr>
						<tr>
							<td>
								Father Name
							</td>
							<td>
								{{$application->user->userInfo?->father_name}}
							</td>
						</tr>
						<tr>
							<td>
								Diploma
							</td>
							<td>
								{{$application->project->diploma?->name}}
							</td>
						</tr>
						<tr>
							<td>
								CNIC
							</td>
							<td>
								{{$application->user->cnic}}
							</td>
						</tr>
						<tr>
							<td>
								Contact
							</td>
							<td>
								{{$application->user->phone}}
							</td>
						</tr>
						<tr>
							<td>
								On Account Of
							</td>
							<td>
								<em>Admission Fee
								</em>
							</td>
						</tr>
						<tr>
							<td>
								Fee Amount
							</td>
							<td>
								Rs. {{$application->project->fee}}/-
							</td>
						</tr>
						<tr>
							<td>
								In Words
							</td>
							<td>
								{{\App\Helper\Common::amountToWords($application->project->fee)}}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="signature">
					Bank Officer Signature
				</td>
				<td class="signature">
					Depositor Signature
				</td>
			</tr>
			{{--			<tr>
							<td colspan="2">
								<small>Generated by I.T Department (UMS Office)
								</small>
							</td>
						</tr>--}}
		</table>
	</div>
	<div class="table-container">
		<div style="
    display: flex;
    justify-content: space-evenly;
    font-size: 16px;
    align-items: center;
    text-align: center;
    margin-bottom: 10px;
">
			<div>
				<img src="{{ asset('images/logo.jpg') }}" alt="logo" width="80px">
			</div>
			<div>
				<strong>
					AGRICULTURE SERVICES <br> ACADEMY, PESHAWAR
				</strong>
				<br>
				<br>
				<span class="bg-styling"><strong>STUDENT COPY</strong></span>
			</div>
		</div>
		<table>


			<tr>
				<td>Branch Code:____________________</td>
				<td>Valid Upto: <strong
						class="underline">{{\Carbon\Carbon::parse($application->project->expiry_date)->format('d-m-Y')}}</strong></td>
			</tr>
			<tr>
				<td colspan="2">Branch Name:________________________________________</td>
			</tr>
			<tr>
				<td colspan="2">Application No: <strong class="underline">{{$application->application_number}}</strong></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center"><strong>ONLINE BANK DEPOSIT SLIP</strong></td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" class="table">
						<tr>
							<td colspan="2" class="text-center">
								<img src="{{asset('nbp.png')}}" style="height: 100px" alt="NBP"> <br>
								Remote Branch: University Campus Branch, Peshawar
							</td>
						</tr>
						<tr>
							<td class="text-center">
								Principal Agriculture Training Institute
							</td>
							<td class="text-center">
								PK59NBPA0388003048617735
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" class="table">
						<tr>
							<td>
								Name
							</td>
							<td>
								{{$application->user->full_name}}
							</td>
						</tr>
						<tr>
							<td>
								Father Name
							</td>
							<td>
								{{$application->user->userInfo?->father_name}}
							</td>
						</tr>
						<tr>
							<td>
								Diploma
							</td>
							<td>
								{{$application->project->diploma?->name}}
							</td>
						</tr>
						<tr>
							<td>
								CNIC
							</td>
							<td>
								{{$application->user->cnic}}
							</td>
						</tr>
						<tr>
							<td>
								Contact
							</td>
							<td>
								{{$application->user->phone}}
							</td>
						</tr>
						<tr>
							<td>
								On Account Of
							</td>
							<td>
								<em>Admission Fee
								</em>
							</td>
						</tr>
						<tr>
							<td>
								Fee Amount
							</td>
							<td>
								Rs. {{$application->project->fee}}/-
							</td>
						</tr>
						<tr>
							<td>
								In Words
							</td>
							<td>
								{{\App\Helper\Common::amountToWords($application->project->fee)}}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="signature">
					Bank Officer Signature
				</td>
				<td class="signature">
					Depositor Signature
				</td>
			</tr>
			{{--			<tr>
							<td colspan="2">
								<small>Generated by I.T Department (UMS Office)
								</small>
							</td>
						</tr>--}}
		</table>
	</div>


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