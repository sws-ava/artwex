@extends('layouts.master')

@section('content')

    <div class="artist">
        <div class="cover-card">
            <div><img src="/storage/{{$artist->image_cover}}" alt="" class="cover-card-fon"></div>
            <div class="cover-card-profile">
                <div class="art-catalog-logo"><img src="/storage/{{$artist->image_avatar}}" alt="{{ $artist->name }} {{ $artist->last_name }}"></div>
                <h3>{{ $artist->name }} {{ $artist->last_name }}</h3>
                <h4>@lang('artist.joined'): {{ date('M Y', strtotime($artist->created_at)) }}</h4>
                <h4>@lang('artist.artsale'): {{count($artist->products)}}</h4>
            </div>
        </div>

        <div class="artists-work-art">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="work-painter-art">
                            <h3>@lang('artist.artworks')</h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <ul class="nav" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-artred active" id="actual-tab" data-bs-toggle="tab" data-bs-target="#actual-tab-pane" type="button" role="tab" aria-controls="actual-tab-pane" aria-selected="true">@lang('artist.actual')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-artred" id="pastsold-tab" data-bs-toggle="tab" data-bs-target="#pastsold-tab-pane" type="button" role="tab" aria-controls="pastsold-tab-pane" aria-selected="false">@lang('artist.pastsold')</button>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="actual-tab-pane" role="tabpanel" aria-labelledby="actual-tab" tabindex="0">
                                    <div class="row artist-products">
                                        @foreach ($artist->products as $product)
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            @include('templates.product', ['product' => $product])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pastsold-tab-pane" role="tabpanel" aria-labelledby="pastsold-tab" tabindex="0">
                                    <div class="row artist-products">
                                        @foreach ($artist->products as $product)
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            @include('templates.product', ['product' => $product])
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        <!-- <div class="col-12 col-md-6 d-flex">
                            <div class="dropdown-left">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @lang('shop.sort_by')
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">1</a></li>
                                <li><a class="dropdown-item" href="#">2</a></li>
                                <li><a class="dropdown-item" href="#">3</a></li>
                                </ul>
                            </div>
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

                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection