@include('header')
<style>
				*{
				 text-transform: uppercase;
				}
    .staff-member {
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
    }

    .staff-member img {
        width: 350px;
        height: 400px;
        margin-bottom: 20px;
        border-radius: 5%;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 16px;
        margin: 0 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }

    .pagination span.disabled {
        color: #ccc;
        cursor: not-allowed;
    }

    .pagination a[rel="prev"]:before {
        content: "\00AB\00A0"; /* Left-pointing double angle quotation mark */
    }

    .pagination a[rel="next"]:after {
        content: "\00A0\00BB"; /* Right-pointing double angle quotation mark */
    }
</style>

@include('navbar')
<div class="container-fluid pt-2">

	<div class="row">
		@foreach($staff as $st)
			<div class="col-md-4">
				<div class="staff-member">
					<img src="{{$st->avatar}}" alt="Staff 1">
					<h3>{{$st->full_name}}</h3>
					<p>{{$st->designation . ' ('.$st->bps.')'}}</p>
				</div>
			</div>
		@endforeach
	</div>


	<div class="pagination">
		@if ($staff->onFirstPage())
			<span class="disabled">&laquo; Previous</span>
		@else
			<a href="{{ $staff->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
		@endif

		@if ($staff->hasMorePages())
			<a href="{{ $staff->nextPageUrl() }}" rel="next">Next &raquo;</a>
		@else
			<span class="disabled">Next &raquo;</span>
		@endif
	</div>
	<br>
	<br>
</div>
@include('footer')