<nav class="navbar navbar-expand-lg navbar-light bg-color">
	<div class="container-fluid">
		<a class="navbar-brand d-lg-none" href="#">
			<img src="{{asset('images/logo-sm.png')}}" alt="logo-sm" height="40px">
		</a>
		<div class="d-lg-none">
			<img src="{{asset('images/100-years.png')}}" alt="100-years" height="40px">
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
		        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		        aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				@if (Route::has('login'))
					@auth
						<li class="nav-item">
							<a class="nav-link d-lg-none"
							   href="{{ auth()->user()->role_name === 'Admin' ? route('dashboard')  : route('student-dashboard')}}">Dashboard</a>
						</li>
					@else
						<li class="nav-item">
							<a class="nav-link d-lg-none" href="{{ route('login') }}">Login</a>
						</li>
						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link d-lg-none" href="{{ route('register') }}">Online Admission</a>
							</li>
						@endif
					@endauth

				@endif
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('about')}}">About</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
					   data-bs-toggle="dropdown" aria-expanded="false">
						Diplomas
					</a>
					<ul class="dropdown-menu bg-color" aria-labelledby="navbarScrollingDropdown">
						<li><a class="dropdown-item" href="{{route('agriculture-science')}}">Diploma in Agriculture Services</a></li>
						<li><a class="dropdown-item" href="{{route('veterinary-science')}}">Diploma in Veterinary Science</a></li>
					</ul>
				</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('fee-structure')}}">Fee Structure</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('front-gallery')}}">Gallery</a>
					</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('contact')}}">Contact Us</a>
				</li>
			</ul>
			<div class="d-none d-lg-block">

				@if (Route::has('login'))
					@auth
						<a class="btn btn-sm btn-dark btn-style" href="{{ auth()->user()->role_name === 'Admin' ? route('dashboard')  : route('student-dashboard')}}">Dashboard</a>
					@else
						<a class="btn btn-sm btn-dark btn-style" href="{{ route('login') }}">Login</a>
						@if (Route::has('register'))
							<a class="btn btn-sm btn-dark btn-style" href="{{ route('register') }}">Online Admission</a>
						@endif
					@endauth

				@endif
			</div>
		</div>
	</div>
</nav>