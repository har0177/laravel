@extends('layouts.app')
@section('header', 'Users Management')
@section('buttons')
	<button wire:click="create()"
	        class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
		Create User
	</button>
@endsection

@section('body')
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				@livewire('userList')
			</div>
		</div>
	</div>
@endsection
