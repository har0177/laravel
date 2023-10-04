@include('header')

@include('navbar')
<div class="container-fluid pt-2">
	<h3>{{$content->title}}</h3>
	{!! $content->description !!}
</div>
@include('footer')