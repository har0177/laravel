<x-guest-layout>
	<x-authentication-card>
		<x-slot name="logo">
			<x-authentication-card-logo/>
		</x-slot>

		<x-validation-errors class="mb-4"/>

		<form method="POST" action="{{ route('register') }}">
			@csrf
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<x-label for="first_name" value="{{ __('First Name') }}" required />
					<x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
					         required
					         autofocus autocomplete="first_name"/>
				</div>

				<div>
					<x-label for="last_name" value="{{ __('Last Name') }}" required/>
					<x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required
					         autofocus autocomplete="last_name"/>
				</div>

				<div>
					<x-label for="father_name" value="{{ __('Father Name') }}" required/>
					<x-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name')" required
					         autofocus autocomplete="father_name"/>
				</div>

				<div>
					<x-label for="email" value="{{ __('Email') }}"/>
					<x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
					         autocomplete="email"/>
				</div>

				<div>
					<x-label for="username" value="{{ __('UserName') }}" required/>
					<x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
					         autocomplete="username"/>
				</div>

				<div>
					<x-label for="cnic" value="{{ __('CNIC/FormB') }}" required/>
					<x-input id="cnic" class="block mt-1 w-full" type="text" name="cnic" :value="old('cnic')" required
					         autocomplete="cnic"/>
				</div>

				<div>
					<x-label for="phone" value="{{ __('Phone Number') }}" required/>
					<x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
					         autocomplete="phone"/>
				</div>

				<div>
					<x-label for="password" value="{{ __('Password') }}" required/>
					<x-input id="password" class="block mt-1 w-full" type="password" name="password" required
					         autocomplete="new-password"/>
				</div>

				<div>
					<x-label for="password_confirmation" value="{{ __('Confirm Password') }}" required/>
					<x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required
					         autocomplete="new-password"/>
				</div>


				<div class="flex items-center justify-end mt-4">
					<a
						class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
						href="{{ route('login') }}">
						{{ __('Already registered?') }}
					</a>

					<x-button class="ml-4">
						{{ __('Register') }}
					</x-button>
				</div>
			</div>
		</form>
	</x-authentication-card>
</x-guest-layout>
