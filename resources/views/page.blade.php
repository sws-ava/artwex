@extends('layouts.master')

@section('content')
    <div class="cover">
        <h2>{{ $page->title }}</h2>
    </div>
    <div class="container-fluid">
		<div class="row">
			<div class="col-12">
			{!! $page->content !!}
			</div>
		</div>
	</div>
@endsection