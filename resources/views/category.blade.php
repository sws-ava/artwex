@extends('layouts.master')

@section('content')
	<div class="cover">
        <h2>@lang('landing.block_one_header')</h2>
    </div>  
    <div class="home-shop-by-category">
        <div class="container-fluid">
            <div class="row">
				@foreach($categories as $category)
                <div class="col-12 col-md-3 shop-by-category">
                    <div class="shop-by-category-card">
						<a href="{{ route('shop', $category->slug) }}">
						<img src="/storage/{{$category->picture}}" alt="{{ $category->name }}">
                        {{-- <h4>Irini Karpikioti/Acrylic painting</h4> --}}
                        <h5>{{ $category->name }}</h5>
						</a>
                    </div>
                </div>
				@endforeach
            </div>
        </div>
    </div>
@endsection