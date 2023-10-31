@extends('layouts.master')

@section('content') 
	<div class="cover cover-yellow">
        <h2>@lang('artist.art_header')</h2>
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
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dropdown-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            9 @lang('shop.per_page')
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">12</a></li>
                          <li><a class="dropdown-item" href="#">15</a></li>
                          <li><a class="dropdown-item" href="#">18</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="artist-profiles-gr">
        <div class="container-fluid">
            <div class="row">
				@foreach ($shops as $shop) 
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="art-catalog-of-works" style="cursor:pointer;" onclick="window.location='{{ route('show.artist', $shop->slug) }}'">
                        <div class="avatar-art-catalog">
                            <div class="art-catalog-images">
								@if (count($shop->products))									
									@foreach ($shop->products as $p)
										@if (count($p->images))
									<div class="art-catalog-image" style="background-image: url(/storage/{{str_replace("public/", "", $p->images[0]->path)}})"></div>
										@endif
									@endforeach
								@endif
								@if ((3-count($shop->products)) > 0)
									@for ($i = 0; $i < 3-count($shop->products); $i++)
									<div class="art-catalog-image" style="background-image: url(/img/no_art.svg)"></div>
									@endfor
								@endif
                            </div>
                            <div class="art-catalog-logo"><img src="/storage/{{$shop->image_avatar}}" alt="{{ $shop->name }} {{ $shop->last_name }}"></div>
                        </div>
                        <div>
                            <h3><a href="{{ route('show.artist', $shop->slug) }}" class="default-link">{{ $shop->name }} {{ $shop->last_name }}</a></h3>
                            <h4>{{ $shop->country->name }} / {{ count($shop->products) }} @lang('landing.works')</h4>
                        </div>
                    </div>
                </div>
				@endforeach
            </div>
        </div>
    </div>

    <div>@if (count($shops) > 9)<button class="but-show-more">@lang('ideas.show_more')</button>@endif</div>
@endsection