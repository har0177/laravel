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
		<div class="col-md-12 col-lg-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">News and Events</h4>
				</div>
				<div class="card-body">

					<marquee onmouseover="this.stop();"
					         style="BORDER-RIGHT: #fff 1px solid; PADDING-RIGHT: 3px; BORDER-TOP: #fff 1px solid; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 0px; BORDER-LEFT: #fff 1px solid; PADDING-TOP: 3px; BORDER-BOTTOM: #fff 1px solid; HEIGHT: 290px;"
					         onmouseout="this.start();" scrollamount="1" scrolldelay="60" direction="up">

						@forelse($events as $event)
								<div class="flex items-center mb-2">
									<div style="display: flex">
										<img src="{{ asset('images/newicon.gif') }}" alt="Event Icon" style="width: 10%">
										@php( $extension = \Illuminate\Support\Str::lower(pathinfo($event->getFirstMediaUrl('events'), PATHINFO_EXTENSION)))
										@if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) || $event->type === 'Text')
											<a href="{{ route('event.show', ['event' => $event->slug]) }}" class="text-blue-500 hover:underline">
												{{ $event->title }}
											</a>
										@else
											<a href="{{$event->getFirstMediaUrl('events')}}" class="text-blue-500 hover:underline">
												{{ $event->title }}
											</a>
										@endif

									</div>

								</div>

						@empty
							<p>No events available</p>
						@endforelse


					</marquee>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 mb-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Secretary Agriculture Message</h4>
					</div>
					<div class="card-body">
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
			<div class="col-lg-6 mb-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Director General Message</h4>
					</div>
					<div class="card-body">
						<div class="message-container">
							<img src="{{asset('dg.jpg')}}" alt="Principal" width="120px">
							<p class=" justify">
								It is not an exaggeration to say that agriculture is the oldest profession in the world.The human life
								purely depends on Agriculture. Besides provision of food for human beings, our Agro-based industries
								also depends on the raw materials of Agriculture sector. Thus, it shows that Agriculture has a unique
								place among all professions of the world. Pakistan is an agriculture based country and its 70%
								population depends on farming but neither visible changes are made so far in the villages nor has
								poverty of the farming communities been elevated. <br>
								On the other hand, Agriculture has become a least attractive profession in Pakistan. In the present
								circumstances, the rural population has not only flow towards the big cities but also makes efforts to
								migrate abroad/overseas. But those who are attached with the profession of Agriculture are
								compelled to work. In such a situation, the Agriculture Services Academy Peshawar is a ray of hope
								for the farmers which disseminate a beam of knowledge related to Agriculture among the farmers
								community since long. In this academy, Agriculture is taught on such line which attracts farmers
								toward itself and their coming generation will feel proud to take admission in Agriculture education.
								The subjects taught here are related to Agriculture including new technologies, invented by
								Agricultural research and also recommend those to farmers for application on their fields.
								In this academy, besides increase in Crop Production, the subjects related to Animal Health
								and their look-after are also taught.<br>
								These days, our population is rapidly increasing wherein about 50% of our population is
								female. Thus it is necessary to include females in this race of development. Therefore , it has been
								decided by the academy this year that besides males, females either rural or from urban areas areas
								will be trained in field of Agriculture.<br>
								We will try and pray to God to succeed us in our this sacred aim, Ameen
							</p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row">

			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Principal's Message</h4>
				</div>
				<div class="card-body">
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
			</div>
		</div>
	</div>


</div>
