<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agriculture Services Academy, Peshawar</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet"
	      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="{{asset('styles.css')}}">
</head>


<body>
<!-- Header -->
<div class="page-header d-none d-lg-block">
	<div class="logo"><a href="#"></a></div>
	<div class="header-building"></div>
</div>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-color">
	<div class="container-fluid">
		<a class="navbar-brand d-lg-none" href="#">
			<img src="{{asset('images/logo-sm.svg')}}" alt="logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
		        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		        aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item d-lg-none">
					@if (Route::has('login'))
						@auth
							<a class="nav-link text-white" href="{{ url('/dashboard') }}">Dashboard</a>
						@else
							<a class="nav-link text-white" href="{{ route('login') }}">Log in</a>
							@if (Route::has('register'))
								<a class="nav-link text-white" href="{{ route('register') }}">Register</a>
							@endif
						@endauth

					@endif
				</li>
				<li class="nav-item">
					<a class="nav-link active text-white" aria-current="page" href="#">Home</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
					   aria-expanded="false">
						About
					</a>
					<ul class="dropdown-menu border-0">
						<li><a class="dropdown-item text-white" href="vision.html">Our Vision</a></li>
						<li><a class="dropdown-item text-white" href="mission.html">Our Mission</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#">Gallery</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
					   aria-expanded="false">
						Departments
					</a>
					<ul class="dropdown-menu border-0">
						<li><a class="dropdown-item text-white" href="#">Faculty Members</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#">Downloads</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#">Contact Us</a>
				</li>
			</ul>
			@if (Route::has('login'))

				@auth
					<button class="d-none d-lg-block btn btn-outline-light">
						<a class="nav-link text-white" href="{{ url('/dashboard') }}">Dashboard</a>
					</button>
				@else
					<button class="d-none d-lg-block btn btn-outline-light">
						<a class="nav-link text-white" href="{{ route('login') }}">Log in</a>
					</button> &nbsp;
					@if (Route::has('register'))
						<button class="d-none d-lg-block btn btn-outline-light">
							<a class="nav-link text-white" href="{{ route('register') }}">Register</a>
						</button>
					@endif
				@endauth

			@endif
		</div>
	</div>
</nav>
@livewire('home-page')

<!-- Footer -->
<footer class="container-fluid p-4 bg-color">
	<div>
		<h2 class="text-white">General Links</h2>
		<div class="row">
			<div class="col-lg-3 pt-4">
				<ul class="nav navbar-nav">
					<li><a href="#">Novel Corona Virus Info</a></li>
					<li><a href="#">UVAS Rest House</a></li>
				</ul>
			</div>
			<div class="col-lg-3 pt-4 text-white">
				<ul class="nav navbar-nav">
					<li><a href="#"> UVAS Panel Hospitals and Labs</a></li>
					<li class="hide-menu"><a href="#"> Today's UVAS AQI</a></li>
				</ul>
			</div>
			<div class="col-lg-6 pt-4 text-white">
				<img src="images/logo.svg" width="1086" height="636">
				<div class="col-f-4">
					<p>For further queries, feel free to contact</p>
					<p><i class="fas fa-mail-bulk"></i><a href="mailto:webmaster@uvas.edu.pk">
							webmaster@uvas.edu.pk</a></p>
					<p><i class="fas fa-location-arrow"></i> University of Veterinary and Animal Sciences - UVAS<br>
						Syed Abdul Qadir Jillani (Out Fall) Road, Lahore - Pakistan</p>
					<p><i class="fas fa-phone"></i> Tel: 92-42-99211374, 99211449</p>
				</div>
				<div class="social">
					<ul>
						<li><a href="https://www.facebook.com"><i class="fab fa-facebook-square"
						                                          aria-hidden="true"></i></a></li>
						<li><a href="https://twitter.com"> <i class="fab fa-twitter-square"
						                                      aria-hidden="true"></i></a></li>
						<li><a href="https://www.youtube.com"> <i class="fab fa-youtube-square"
						                                          aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<p class="copyright clearfix">© Designed and Maintained by <a href="#">Information
			Technology Center</a></p>
</footer>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/2ab307e440.js" crossorigin="anonymous"></script>
<script>


	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 10,
		dots: false,
		navText: [' ', ' '],
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 2,
			},
			1000: {
				items: 3,
				nav: true,
			},
			1600: {
				items: 4,
				nav: true,
			},
			2000: {
				items: 5,
				nav: true,
			},
			2600: {
				items: 6,
				nav: true,
			},
			3000: {
				items: 7,
				nav: true,
				loop: true
			}
		}
	})
</script>
</body>

</html>