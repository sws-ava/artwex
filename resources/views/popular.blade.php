@extends('layouts.master')

@section('content') 
	<div class="cover cover-yellow">
        <h2>@lang('shop.popular')</h2>
    </div>   
	<div class="but-page-buttons">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
					<div class="dropdown-left">
						<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							@lang('shop.sort_by')
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item" href="#">@lang('shop.last_name')/@lang('shop.by_login')</a></li>
						  <li><a class="dropdown-item {{ Request::get('sort_by') == 'best_match' ? 'selected' : '' }}" href="?sort_by=best_match">@lang('shop.by_popular')</a></li>
						  <li><a class="dropdown-item {{ Request::get('sort_by') == 'newest' ? 'selected' : '' }}" href="?sort_by=newest">@lang('shop.by_new')</a></li>
						  <li><a class="dropdown-item {{ Request::get('sort_by') == 'oldest' ? 'selected' : '' }}" href="?sort_by=oldest">@lang('shop.by_old')</a></li>
						  <li><a class="dropdown-item {{ Request::get('sort_by') == 'price_acs' ? 'selected' : '' }}" href="?sort_by=price_acs">@lang('shop.increase_price')</a></li>
						  <li><a class="dropdown-item {{ Request::get('sort_by') == 'price_desc' ? 'selected' : '' }}" href="?sort_by=price_desc">@lang('shop.decrease_price')</a></li>
						</ul>
					</div>
                </div>
                <div class="col-sm-6">
                    <div class="dropdown-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            60 @lang('shop.per_page')
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">15</a></li>
                          <li><a class="dropdown-item" href="#">30</a></li>
                          <li><a class="dropdown-item" href="#">60</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="container-fluid">
		<div class="row">
			@foreach ($populars as $popular)
				<div class="col-12 col-sm-6 col-lg-3">
					@include('templates.product', ['product' => $popular])
				</div>
			@endforeach
		</div>
	</div>
@endsection