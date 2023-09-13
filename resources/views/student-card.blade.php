<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="{{asset('css/id-card.css')}}"/>

	<!-- Link to your CSS file -->
	<title>Student ID Card</title>

</head>

<body>


<div class="card" id="section-overview" style="border: none">


	<img src="{{asset('idcard.jpg')}}" class="idcard"/>
	<img class="image img-rounded" alt="{{$user->full_name}}"
	     src="{{$user->getFirstMediaUrl( 'avatars' )}}">
	<img class="image2" src="{{asset('sign.png')}}">
	<p class="name">{{strtoupper($user->full_name)}}</p>
	<p class="designation">{{strtoupper($user->student->diploma->name)}}</p>
	<p class="section">{{ucwords($user->student->section->name).' ('.$user->student->class_no.')'}}</p>
	<p class="fname">{{ucwords($user->student->father_name)}}</p>
	<p class="nic">{{$user->cnic}}</p>
	<p class="dob">{{\Carbon\Carbon::parse($user->student->dob)->format('d-M-Y')}}</p>
	<p class="section2">{{ucwords($user->student->section->name).' ('.$user->student->class_no.')'}}</p>
	<p class="mobile">{{$user->phone}}</p>
	<p class="emergency">{{$user->student->emergency_contact}}</p>
	<p class="bgroup">{{$user->student->bloodGroup->name}}</p>
	<p class="address">{!! wordwrap(ucfirst($user->student->address),36,"<br>\n") !!}</p>

</div>


</body>
</html>
