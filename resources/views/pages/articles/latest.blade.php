@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<div class="jumbotron">
	        	@if (!empty($title))
	        		<h1>{{$title}}</h1>
	        	@endif
	        	<p>This is the articles page</p>
	        	<a href="/articles/all" class="btn btn-primary">View All Articles</a>
        	</div>
        </div>
    </div>
    <div class="row">
        <latest-articles-component></latest-articles-component>
    </div>
</div>
@endsection