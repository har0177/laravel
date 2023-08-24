<div>

	<!-- Carousel and Marquee -->
	<div class="row py-2 px-3">
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
		<div class="col-md-12 col-lg-4 bg-gray">
			<h3 class="p-2" style="text-decoration: underline">News and Events</h3>
			<marquee onmouseover="this.stop();"
			         style="BORDER-RIGHT: #fff 1px solid; PADDING-RIGHT: 3px; BORDER-TOP: #fff 1px solid; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 0px; BORDER-LEFT: #fff 1px solid; PADDING-TOP: 3px; BORDER-BOTTOM: #fff 1px solid; HEIGHT: 290px;"
			         onmouseout="this.start();" scrollamount="1" scrolldelay="60" direction="up">
				<div>
					@forelse($events as $event)
						<div class="flex items-center mb-4">
							<div style="display: flex">
								<img src="{{ asset('images/newicon.gif') }}" alt="Event Icon" style="width: 10%">
								<a href="{{ route('event.show', ['event' => $event->slug]) }}" class="text-blue-500 hover:underline">
									{{ $event->title }}
								</a>
							</div>
							<div style="text-align: right; color: red; font-size: 12px">
								({{ $event->expiry_date }})
							</div>
						</div>
					@empty
						<p>No events available</p>
					@endforelse


				</div>
			</marquee>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<h3 class="p-2 underline">Principal's Message</h3>
				<div class="message-container">
					<img src="{{asset('principal.jpg')}}" alt="Principal" width="120px">
					<p class=" justify">
					Agriculture is the first profession necessarily adopted by human and its extension taught by the
					Almighty to Noah the apostle of God before Deluge.
					The profession that has the responsibility of food production not only for mankind but for the
					cattle as well, is a continuous worship, blessed by Almighty.
					The people involved in this auspicious profession are fighters; fighters against the hunger and
					poverty which are mother of all evils.
					Each Extension Worker have massive responsibility to adopt the four paradigms to cope with the
					global challenge of food insecurity.
				<ul>
					<li>Technology Transfer (persuasive + paternalistic).</li>
					<li>Advisory work (persuasive + participatory).</li>
					<li>Human resource development (educational + paternalistic).</li>
					<li>Facilitation for empowerment (educational + participatory).</li>
				</ul>
				Khyber Pakhtunkhwa is blessed with favourable environment for all crops so be matched with the blessings
				of Almighty, develop strong linkages with producers i.e. main stake holder and the agricultural
				scientists and pave the agricultural extension on a revolutionary gate way which leads to fetch highest
				economical yield.
				</p>
				</div>
			</div>
			<div class="col-lg-6">
				<h3 class="p-2 underline">Secretary Message</h3>
				<div class="message-container">
					<img src="{{asset('secretary.jpeg')}}" alt="Secretary" width="120px">
					<p class="justify">
					Indeed it is a great honor and privileged for me to share few words.
					Agriculture employing above 40 percent of the labour force and contributing
					more than 20 percent to provincial GDP, is one of the key drivers of growth
					and an excellent opportunity to practice the diversification into areas with
					comparative advantages of climate. <br>
					The role of Agriculture Department is to
					ensure food security, poverty alleviation and to generate employment
					opportunities through achieving higher growth rate in this vital sector of the
					economy. The Department is striving for achieving the future vision i.e. to
					meet the challenges of 21st century and to develop a vibrant agriculture
					sector that promotes value addition and helps taps international market for
					agriculture produce.
					<br>
					The line departments of Agriculture include Agriculture
					Extension, Agriculture Research System, Livestock and Dairy Development,
					Livestock Research and Development Department, Veterinary Research
					Institute, On-Farm Water Management, Soil Conservation, Agricultural
					Engineering, Cooperatives, Crop Reporting Services and Fisheries
					Department. The line departments are all mandated for ensuring effective
					service delivery at the farmers doorsteps and provide all out support for the
					promotion of agriculture sector in the province.
				</p>
				</div>
			</div>
		</div>
	</div>


</div>
