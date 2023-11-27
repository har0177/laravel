<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="{{asset('css/general.css')}}"/>

    <!-- Link to your CSS file -->
    <title>Student ID Card</title>
    <style>
        body {
            color: #000 !important;
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
            left: 6%;
            border-radius: 10px;
            height: 120px;
            width: 100px;
        }


        .name {
            position: absolute;
            margin-top: -16.4%;
            left: 17%;
            font-size: 20px;
            font-weight: bolder;
        }

        .designation {

            position: absolute;
            margin-top: -14%;
            left: 17%;
            color: darkblue;
            font-size: 12px;
            font-weight: bolder;
        }

        .section {

            position: absolute;
            margin-top: -12%;
            left: 21%;
            color: darkblue;
            font-size: 14px;
            font-weight: bolder;
        }


        .fname {
            position: absolute;
            margin-top: -25%;
            left: 66%;
            font-size: 12px;
            font-weight: bolder;
        }

        .nic {
            position: absolute;
            margin-top: -22.8%;
            left: 66%;
            font-size: 12px;
            font-weight: bolder;
        }


        .dob {
            position: absolute;
            margin-top: -20.6%;
            left: 66%;
            font-size: 12px;
            font-weight: bolder;
        }


        .section2 {
            position: absolute;
            margin-top: -18.6%;
            left: 66%;
            font-size: 12px;
            font-weight: bolder;
        }

        .mobile {
            position: absolute;
            margin-top: -16.2%;
            left: 66%;
            font-size: 12px;
            font-weight: bolder
        }

        .address {
            position: absolute;
            margin-top: -9.5%;
            left: 66%;
            line-height: 14.5px;
            font-size: 14px;
            font-weight: bolder;
        }

        .emergency {
            position: absolute;
            margin-top: -14%;
            left: 66%;
            line-height: 14.5px;
            font-size: 12px;
            font-weight: bolder;
        }

        .bgroup {
            position: absolute;
            margin-top: -11.8%;
            left: 66%;
            line-height: 14.5px;
            font-size: 12px;
            font-weight: bolder;
        }


        .image2 {

            position: absolute;
            margin-top: 20%;
            left: 8%;
            width: 65px;
            height: 20px;
        }

    </style>
</head>

<body>
<div class="content">
    <div class="card" id="section-overview" style="border: none">
        <div class="card-body">
            @foreach($students as $user)
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
            @endforeach
        </div>
    </div>
</div>

</body>
</html>
