<x-guest-layout>
	<x-authentication-card>
		<x-slot name="logo">
			<div class="text-center mb-3">
				<h4 style="color: darkgreen;font-weight: 700;font-size: 16px;" class="mr-2">
					Agriculture Services Academy, Peshawar </h4>

			</div>

		</x-slot>

		<x-validation-errors class="mb-4"/>

		@if (session('status'))
			<div class="mb-4 font-medium text-sm text-green-600">
				{{ session('status') }}
			</div>
		@endif

		<form method="POST" action="{{ route('login') }}">
			@csrf

			<div>
				<x-label for="username" value="{{ __('Email or UserName or Phone Number') }}"/>
				<x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
				         required
				         autofocus autocomplete="username"/>
			</div>

			<div class="mt-4">
				<x-label for="password" value="{{ __('Password') }}"/>
				<x-input id="password" class="block mt-1 w-full" type="password" name="password" required
				         autocomplete="current-password"/>
			</div>

			<div class="block mt-4">
				<label for="remember_me" class="flex items-center">
					<x-checkbox id="remember_me" name="remember"/>
					<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
				</label>
			</div>

			<div class="flex items-center justify-end mt-4">
				@if (Route::has('password.request'))
					<a
						class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
						href="{{ route('password.request') }}">
						{{ __('Forgot your password?') }}
					</a>
				@endif

				<x-button class="ml-4">
					{{ __('Log in') }}
				</x-button>
			</div>
		</form>

		@if($projects)
			<div class="mt-4">
				<p class="text-sm text-gray-600">
					{{ __("Don't have an account?") }}
					<a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
						{{ __('Register now') }}
					</a>
				</p>
			</div>
		@endif
	</x-authentication-card>
</x-guest-layout>
