<div>

	<!-- Carousel and Marquee -->
	<div class="row py-2">
		<div class="col-md-12 col-lg-8">
			<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner">
					@foreach ($carouselItems as $index => $item)
						<div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
							@if ($item['type'] === 'video')
								<iframe width="100%" height="365" src="{{ $item['url'] }}"
								        title="YouTube video player" frameborder="0" allowfullscreen=""></iframe>
							@elseif ($item['type'] === 'image')
								<img src="{{ $item['url'] }}" width="100%" height="365" alt="...">
							@endif
						</div>
					@endforeach
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
				        data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
				        data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>
		<div class="d-none d-lg-block col-lg-4 bg-gray">
			<h3 class="p-2" style="text-decoration: underline">News and Events</h3>
			<marquee onmouseover="this.stop();"
			         style="BORDER-RIGHT: #fff 1px solid; PADDING-RIGHT: 3px; BORDER-TOP: #fff 1px solid; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 0px; BORDER-LEFT: #fff 1px solid; PADDING-TOP: 3px; BORDER-BOTTOM: #fff 1px solid; HEIGHT: 290px;"
			         onmouseout="this.start();" scrollamount="1" scrolldelay="60" direction="up">
				<div>
					@foreach($projects as $project)
						<div style="display: inline-flex">
							<img src="images/newicon.gif" alt="...">
							<a href="{{ route('apply') }}" class="list-group-item list-group-item-action">
								<div class="d-flex justify-content-between align-items-center">
									<h6 class="mb-1"><b>Apply for {{$project->diploma->name}}</b></h6>
									<small style="color: red">Expiry
										date: {{\Carbon\Carbon::parse($project->expiry_date)->format('d-M-Y')}}</small>
								</div>
							</a>
						</div>

					@endforeach
				</div>
			</marquee>
		</div>
	</div>
	<div class="container-fluid">
		<h3 class="p-2">Principal's Message</h3>
		<div class="row">
			<div class="col-lg-2">
				<img src="{{asset('principal.jpg')}}" alt="Principal" width="150px">
			</div>
			<div class="col-lg-10">
				<p class="justify">
					Agriculture is the first profession necessarily adopted by human and its extension taught by the
					Almighty to Noah the apostle of God before Deluge.
					The profession that has the responsibility of food production not only for mankind but for the
					cattle as well, is a continuous worship, blessed by Almighty.
					The people involved in this auspicious profession are fighters; fighters against the hunger and
					poverty which are mother of all evils.
					Each Extension Worker have massive responsibility to adopt the four paradigms to cope with the
					global challenge of food insecurity. <br>
				<ul>
					<li>Technology Transfer (persuasive + paternalistic).</li>
					<li>Advisory work (persuasive + participatory).</li>
					<li>Human resource development (educational + paternalistic).</li>
					<li>Facilitation for empowerment (educational + participatory).</li>
				</ul>
				<br>
				Khyber Pakhtunkhwa is blessed with favourable environment for all crops so be matched with the blessings
				of Almighty, develop strong linkages with producers i.e. main stake holder and the agricultural
				scientists and pave the agricultural extension on a revolutionary gate way which leads to fetch highest
				economical yield.
				</p>
			</div>
		</div>
	</div>


</div>
