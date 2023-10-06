<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<link href="{{asset('css/general.css')}}" rel="stylesheet">

	<style>

     body {
         color: #000 !important;
     }

     @media print {

         .hidden-print {
             display: none;
         }
     }


     div {
         height: auto;
     }

     div img {
         width: 98%;
     }

     .image {
         position: absolute;
         margin-top: 9%;
         left: 5%;
         border-radius: 10px;
         height: 120px;
         width: 100px;
     }


     .name {
         position: absolute;
         margin-top: -14%;
         left: 17%;
         font-size: 18px;
         font-weight: bolder;
     }

     .designation {

         position: absolute;
         margin-top: -12%;
         left: 18%;
         color: darkblue;
         font-size: 12px;
         font-weight: bolder;
     }

     .personal {

         position: absolute;
         margin-top: -26.3%;
         left: 66%;
         font-size: 12px;
         font-weight: bolder;
     }

     .fname {
         position: absolute;
         margin-top: -23.5%;
         left: 66%;
         font-size: 12px;
         font-weight: bolder;
     }

     .nic {
         position: absolute;
         margin-top: -20.5%;
         left: 66%;
         font-size: 12px;
         font-weight: bolder;
     }

     .phone {
         position: absolute;
         margin-top: -26.3%;
         left: 85.7%;
         font-size: 12px;
         font-weight: bolder;
     }

     .dob {
         position: absolute;
         margin-top: -20.6%;
         left: 85.7%;
         font-size: 12px;
         font-weight: bolder;
     }


     .designation2 {
         position: absolute;
         margin-top: -17.7%;
         left: 66%;
         font-size: 12px;
         font-weight: bolder;
     }

     .bps {
         position: absolute;
         margin-top: -17.7%;
         left: 85.7%;
         font-size: 12px;
         font-weight: bolder;
     }

     .address {
         position: absolute;
         margin-top: -15.2%;
         left: 65%;
         line-height: 14.5px;
         font-size: 14px;
         font-weight: bolder;
     }

     .emergency {
         position: absolute;
         margin-top: -10.9%;
         left: 66%;
         line-height: 14.5px;
         font-size: 14px;
         font-weight: bolder;
     }

     .bgroup {
         position: absolute;
         margin-top: -10.9%;
         left: 85.7%;
         line-height: 14.5px;
         font-size: 14px;
         font-weight: bolder;
     }


     .image2 {

         position: absolute;
         margin-top: 18.5%;
         left: 7%;
         height: 60px;
         width: 65px;
     }


	</style>
	<!-- Link to your CSS file -->
	<title>Employee ID Cards</title>

</head>

<body>
<div class="content">
	<div class="card" id="section-overview" style="border: none">
		<div class="card-body">

			@foreach($employees as $employee)

				<img src="{{asset('employee-card.jpg')}}" class="idcard"/>

				<img class="image img-rounded" alt="{{$employee->full_name}}"
				     src="{{$employee->getFirstMediaUrl( 'avatars' )}}">
				<img class="image2" src="{{asset('sign.png')}}">
				<p class="name">{{ucwords(strtoupper($employee->full_name))}}</p>
				<p class="designation">{{ucwords(strtoupper($employee->designation))}}</p>
				<p class="personal">{{$employee->personal_number}}</p>
				<p class="phone">{{$employee->contact_number}}</p>
				<p class="fname">{{ucfirst($employee->father_name)}}</p>
				<p class="nic">{{$employee->nic}}</p>
				<p class="dob">{{$employee->dob}}</p>
				<p class="designation2">{{$employee->designation}}</p>
				<p class="bps">{{$employee->bps}}</p>
				<p class="address">{!! wordwrap(ucfirst($employee->address),36,"<br>\n") !!}</p>
				<p class="emergency">{{$employee->emergency_number}}</p>
				<p class="bgroup">{{$employee->bloodGroup->name}}</p>

			@endforeach
		</div>
	</div>
</div>
</body>
</html>