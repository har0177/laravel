@include('header')

@include('navbar')
<div class="container-fluid text-center">
	<h3>{{$event->title}}</h3>
	@if($event->type === 'Text')
		<p style="text-align: justify">{{$event->description}}</p>
	@else
		<img src="{{$event->getFirstMediaUrl('events')}}" width="100%"/>
	@endif
</div>
@include('footer')