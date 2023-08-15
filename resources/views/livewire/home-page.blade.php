<div>

@if(count($projects) > 0)
	<!-- Button trigger modal -->
	<div class="modal fade"
	     id="eventModel" tabindex="-1" role="dialog" aria-labelledby="eventModelLabel"
	     aria-hidden="true">
		<div class="modal-dialog modal-md mt-4 modal-dialog-centered modal-dialog-scrollable" role="document">
			<div class="modal-content border-0">
				<div class="modal-header bg-gray">
					<h5 class="modal-title"><i class="fas fa-newspaper"></i> News & Events</h5>
					<button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
					        aria-label="Close"></button>
				</div>
				<div class="modal-body bg-white">
					<div class="list-group">
						@foreach($projects as $project)
							<a href="{{ route('apply') }}" class="list-group-item list-group-item-action">
								<div class="d-flex justify-content-between align-items-center">
									<h6 class="mb-1"><b>Apply for {{$project->diploma->name}}</b></h6>
									<small style="color: red">Expiry
										date: {{\Carbon\Carbon::parse($project->expiry_date)->format('d-M-Y')}}</small>
								</div>
								<p class="mb-1">{{ substr($project->description, 0, 100) }}...</p>
							</a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

@if(count($carouselItems) > 0)
	<!-- Slide -->
		<div id="carouselExampleAutoplaying" class="carousel slide bg-color" data-bs-ride="carousel">
			<div class="carousel-inner">
				@foreach ($carouselItems as $index => $item)
					<div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
						@if ($item['type'] === 'video')
							<iframe width="100%" height="485" src="{{ $item['url'] }}"
							        title="YouTube video player" frameborder="0" allowfullscreen=""></iframe>
						@elseif ($item['type'] === 'image')
							<img src="{{ $item['url'] }}" width="100%" height="485" alt="...">
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

@endif
<!-- News & Updates -->
	<div class="container-fluid bg-gray p-4">
		<div class="row">
			<div class="col-lg-9">
				<h4 class="text-main text-uppercase">
					<i class="fas fa-newspaper"></i> News &amp; Updates
				</h4>
			</div>
			<div class="col-lg-3"><a href="#" class="btn btn-primary button float-end">View All</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="owl-carousel owl-theme">
				@foreach($projects as $project)
					<div class="item">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Apply for {{$project->diploma->name}}</h5>
								<h6 class="card-subtitle mb-2 text-muted" style="color: red">Expiry
									date: {{\Carbon\Carbon::parse($project->expiry_date)->format('d-M-Y')}}</h6>
								<p class="mb-1">{{ substr($project->description, 0, 100) }}...</p>
								<a href="{{ route('apply') }}" class="btn btn-primary button">Apply Now</a>
							</div>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	</div>
	<!-- Accordian -->
	<div class="container-fluid text-white bg-color p-4" id="accordion">
		<div class="row">
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-3 icon-section col-3">
						<i class="fas fa-book-open" aria-hidden="true"></i>
					</div>
					<div class="section-detail col-lg-9  col-9">
						<h3><a href="#" data-toggle="collapse" aria-expanded="true">UVAS </a></h3>
						<p>About UVAS
						</p>
						<ul id="uvas" class="collapse" data-parent="#accordion">
							<li><a href="#">About</a></li>
							<li><a href="#">Chancellor's Message</a></li>
							<li><a href="#">Pro - Chancellor's Message</a></li>
							<li><a href="#">Vice Chancellor's Message</a></li>
							<li><a href="#">Former Vice Chancellors</a></li>
						</ul>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-3 icon-section pr-3 col-3">
						<i class="fas fa-check-double" aria-hidden="true"></i>
					</div>
					<div class="col-lg-9 section-detail col-9">
						<h3><a href="#">QEC</a></h3>
						<p><a href="#">Quality Enhancement Cell&nbsp;</a></p>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-3 icon-section pr-3 col-3">
						<i class="fas fa-user-graduate" aria-hidden="true"></i>
					</div>
					<div class="section-detail col-lg-9  col-9">
						<h3><a href="#">Alumni</a></h3>
						<p>UVAS Alumni Association
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-3 icon-section pr-3 col-3">
						<i class="fas fa-chart-pie" aria-hidden="true"></i>
					</div>
					<div class="section-detail col-lg-9  col-9">
						<h3><a href="#" data-toggle="collapse">ORIC</a></h3>
						<p>Office of Research, Innovation &amp; Commercialization
						</p>
						<ul id="oric" class="collapse" data-parent="#accordion">
							<li><a href="#">ORIC</a></li>
							<li><a href="#">Staff Position</a></li>
							<li><a href="#">Functions</a></li>
							<li><a href="#">TISC</a>
								<ul>
									<li><a href="#">Industrial Linkages</a>
									</li>
									<li><a href="#">Picture Gallery</a></li>
									<li><a href="#" target="_blank">Guidelines for filing Patent Application in
											Pakistan</a></li>
								</ul>
							</li>
							<li><a href="#">Ethical Review Committee</a></li>
							<li><a href="#">Intellectual Property
									Rights</a></li>
							<li><a href="#">ORIC Advisory Committee</a></li>
							<li><a href="#">ORIC Steering Committee</a></li>
							<li><a href="#">Future Plans</a></li>
							<li><a href="#">Activities</a></li>
							<li><a href="#">Vision</a></li>
							<li><a href="#">Faculty
									Member Participation in International Events</a></li>
							<li><a href="#" target="_blank">Success Stories</a>
							</li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-3 icon-section pr-3 col-3">
						<i class="fab fa-audible" aria-hidden="true"></i>
					</div>
					<div class="section-detail col-lg-9 col-9 ">
						<h3><a href="#">ICE&amp;E </a></h3>
						<p>Institute of Continuing Education &amp; Extension
						</p>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-3 icon-section pr-3 col-3">
						<i class="fas fa-coins" aria-hidden="true"></i>
					</div>
					<div class="section-detail col-lg-9  col-9">
						<h3><a href="#">OUAFA</a></h3>
						<p>Office of University Advancement &amp; Financial Aid
						</p>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- Facts -->
	<div class="container-fluid parallax bg-color p-0" data-speed="0.3" data-img-src="images/facts-bg.jpg">
		<h1 class="text-white text-center p-lg-5 display-1">UVAS FACTS</h1>
		<div class="facts">
			<div class="row">
				<div class="col-lg-3 m-0 p-0 fc9 col-sm-6">
					<div class="title mt-4">
						<h4 class="text-white text-center">137 Yrs</h4>
						<p class="text-white text-center">Glorious Years of Professional Legacy </p>
						<h4 class="text-white text-center">79+ </h4>
						<p class="text-white text-center">Professional Degree Programs</p>
					</div>
				</div>
				<div class="col-lg-3 m-0 p-0 fc6 col-sm-6">
					<div class="title mt-4">
						<h4 class="text-white text-center">175+</h4>
						<p class="text-white text-center">Ph.D Faculty Members</p>
						<h4 class="text-white text-center">7000+</h4>
						<p class="text-white text-center">Students</p>
					</div>
				</div>
				<div class="col-lg-6 m-0 p-0 fc8 col-sm-12">
					<div class="title mt-3">
						<div class="row">
							<div class="col-lg-6">
								<h4 class="text-white text-center">Top-10</h4>
								<p class="text-white text-center small">Among Top-10 in General Universities of
									Pakistan. <br>
									<strong>HEC Ranking-2015 &amp; 2016</strong>
								</p>
								<h4 class="text-white text-center">2<span class="superscript">nd</span></h4>
								<p class="text-white text-center small"> Best University in Agriculture / Veterinary
									Category </p>
							</div>
							<div class="col-lg-6">
								<h4 class="text-white text-center">W Category</h4>
								<p class="text-white text-center">
									(QEC Ranking by HEC Pakistan)</p>
								<h4 class="text-white text-center">3<span class="superscript">rd</span></h4>
								<p class="text-white text-center">Among Top 3 in public Sector Universities <br>
									<strong>HEC Sports Ranking-2018 </strong>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 m-0 p-0 fc2 col-sm-12">
					<div class="title mt-4">
						<div class="row">
							<div class="col-lg-6 p-2 col-sm-6">
								<h4 class="text-white text-center">QS</h4>
								<p class="text-white text-center"><strong> QS Asia University Ranking</strong></p>
								<p class="text-white text-center">Among Top 401-450 Asian Universities <br>(
									QS Asia University Ranking 2020) </p>
							</div>
							<div class="col-lg-6 p-2">
								<h4 class="text-white text-center">THE </h4>
								<p class="text-white text-center"><strong> Times Higher Education World University
									</strong></p>
								<p class="text-white text-center">Emerging Economies: (2020) 401-500 <br>
									Impact Rankings: (2020) 101-200 <br>
									Asia University Rankings: (2019) 351-400 </p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 m-0 p-0 fc10 col-sm-6">
					<div class="title mt-5">
						<h4 class="text-white text-center">1<sup>st</sup></h4>
						<p class="text-white text-center">Drug &amp; Poison Information Centre in Pakistan</p>
					</div>
				</div>
				<div class="col-lg-3 m-0 p-0 fc7 col-sm-6">
					<div class="title mt-5">
						<h4 class="text-white text-center">lSO </h4>
						<p class="text-white text-center">Accredited University Diagnostic and Research Labs</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
