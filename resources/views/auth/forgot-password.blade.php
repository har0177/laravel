<x-guest-layout>
	<x-authentication-card>
		<x-slot name="logo">
			<div class="text-center mb-3">
				<h4 style="color: darkgreen;font-weight: 700;font-size: 16px;" class="mr-2">
					Agriculture Services Academy, Peshawar </h4>

			</div>

		</x-slot>

		<div class="mb-4 text-sm text-gray-600">
			Forgot your password? No problem. <br>
			Just let us know your email address and <br>
			we will email you a password reset link<br>
			that will allow you to choose a new one.
		</div>

		@if (session('status'))
			<div class="mb-4 font-medium text-sm text-green-600">
				{{ session('status') }}
			</div>
		@endif

		<x-validation-errors class="mb-4"/>

		<form method="POST" action="{{ route('password.email') }}">
			@csrf

			<div class="block">
				<x-label for="email" value="{{ __('Email') }}"/>
				<x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus
				         autocomplete="username"/>
			</div>

			<div class="flex items-center justify-end mt-4">
				<x-button>
					{{ __('Email Password Reset Link') }}
				</x-button>
			</div>
		</form>
	</x-authentication-card>
</x-guest-layout>
