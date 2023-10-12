<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="{{asset('css/general.css')}}" rel="stylesheet">

	<style>

     @media print {

         .hidden-print {
             display: none;
         }

         @page {
             size: landscape
         }

         .content {
             background-color: white;
         }
     }

     .table td, .table th {
         padding: 0.75rem 0.20rem;
         text-align: center;
         border-top: 1px solid #ddd;
     }

	</style>
<body>
<div class="content">
	<div class="card" id="section-overview" style="border: none">
		<div class="card-body">

			@foreach($sections as $section)
						<?php
						$students = \App\Models\UserInfo::where( 'status', 'Active' )->where( 'section_id',
								$section->id )->orderByRaw( 'LENGTH(reg_no) asc' )->orderBy( 'reg_no', 'ASC' )->get();

						if(count( $students ) > 0){
						?>
				<table class="table table-bordered table-condensed" id="table-overview">
					<thead>
					<tr class="text-center">
						<th colspan="34"><h3>Attendance Sheet of {{$section->parent->name . ' - ('. $section->name.')'}}</h3></th>
					</tr>
					<tr>
						<th>Sr #</th>
						<th>Reg #</th>
						<th>Name</th>
							<?php
							for($i = 1; $i <= 31; $i++){
							?>
						<th>{{$i}}</th>

							<?php } ?>
					</tr>
					</thead>
						<?php
						$sr = 1;
						foreach($students as $student){
						?>
					<tbody>
					<td>{{$sr}}</td>
					<td>{{$student->reg_no}}</td>
					<td>{{strtoupper($student->user->full_name)}}</td>
					<?php
					for($i = 1; $i <= 31; $i++){
					?>
					<th>p</th>

					<?php
					} ?>
					</tbody>
						<?php
						$sr++;
						}
						?>
				</table>



				<DIV style="page-break-after:always"></DIV>
						<?php } ?>
			@endforeach
		</div>
	</div>
</div>
</body>
</html>
