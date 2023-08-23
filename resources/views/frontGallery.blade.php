@include('header')
<style>
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        aspect-ratio: 1; /* Forces a square aspect ratio */
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintain image aspect ratio and cover entire container */
        transition: transform 0.2s;
    }

    .image-container:hover img {
        transform: scale(1.1);
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
	<div class="gallery">
		@foreach ($images as $image)
			<div class="image-container">
				<img  class="rounded shadow-md" src="{{ $image->getFirstMediaUrl('gallery') }}" alt="Image">
			</div>
		@endforeach
	</div>
	<div class="pagination">
		@if ($images->onFirstPage())
			<span class="disabled">&laquo; Previous</span>
		@else
			<a href="{{ $images->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
		@endif

		@if ($images->hasMorePages())
			<a href="{{ $images->nextPageUrl() }}" rel="next">Next &raquo;</a>
		@else
			<span class="disabled">Next &raquo;</span>
		@endif
	</div>
	<br>
	<br>
</div>
@include('footer')