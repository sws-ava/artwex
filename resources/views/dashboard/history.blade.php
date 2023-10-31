@extends('layouts.master')

@section('content')
<main class="profile_page">
    <div class="cover">	  
		@if (!empty($user->image_cover))
			<img class="cover-img" src="/storage/{{ str_replace('public/', '', $user->image_cover)}}">
		@endif
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="button-cov">
                        <nav class="but-t"><img src="/img/iconscam.svg" alt=""></nav>
                        <h4>@lang('profile.change_cover')</h4>
                    </div>
                </div>
            </div>
        </div> -->
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-3">
                <div class="my-cab">
                    <div class="my-nik">
                        <div class="avatar-holder">
                            <img src="http://127.0.0.1:8000/storage/images/638b37ebb9767.jpg" alt="" class="avatar">
                        </div>
                        <img src="img/Ellipse15.svg" alt="">
                        <h3>{{ $user->name }}</h3>
                    </div>
                    <div class="cab-links-holder">
                        <div class="panel">
                            <a href="{{ route('profile.wishlist') }}">
                                <img src="/img/1circle.svg" alt=""> @lang('profile.wishlist')
                            </a>
                        </div>
                        <div class="panel">
                            <a href="{{ route('profile.history') }}">
                                <img src="/img/2circle.svg" alt=""> @lang('profile.order_history')
                            </a>
                        </div>
                        <div class="panel">
                            <a href="{{ route('profile.settings') }}">
                                <img src="/img/3circle.svg" alt=""> @lang('profile.account_settings')
                            </a>
                        </div>
                        <div><hr></div>
                        <div class="panel">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/img/4circle.svg" alt=""> @lang('profile.logout')</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-9">
                <div class="main-headline main-headline-cab">@lang('profile.order_history')</div>
                {{--<div class="search-page">
                    <div class="search-b"><input type="text" placeholder="Поиск"> <button><img src="/img/search.svg" alt=""></button></div>
                    <div class="sheet">
                        <nav class="numb-pages">60 на странице</nav>
                        <nav class="onwards"><img src="/img/down.svg" alt=""></nav>
                    </div>
                </div>--}}
                <div class="menu-j">
                    <div class="row">
                        <div class="col-12 col-sm-4"><h6>@lang('profile.history_item')</h6></div>
                        <div class="col-12 col-sm-2"><h6>@lang('profile.history_status')</h6></div>
                        <div class="col-12 col-sm-2"><h6>@lang('profile.history_price')</h6></div>
                        <div class="col-12 col-sm-4"><h6>@lang('profile.history_tracknumber')</h6></div>
                    </div>
                </div>
                <div class="menu-j-hr"><hr></div>
                <div class="card-product-min">
                    <div class="">
                        <div class="row">
                            <div class="col-12 col-lg-4 info-span-holder">
                                <div class="title-img">
                                    <div class="title-img-holder">
                                        <img src="http://127.0.0.1:8000/storage/images/638b37ebb9767.jpg" alt="" class="avatar">
                                    </div>
                                    <div class="name-paint-min">
                                        Destellos de Nueva York 15/original artwork (2021)
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_status'):</span> 
                                В пути
                            </div>
                            <div class="col-12 col-lg-2 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_price'):</span> 
                                $1150
                            </div>
                            <div class="col-12 col-lg-4 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_tracknumber'):</span> 
                                <b>Aczxcswfewqwx12343szc</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-product-min">
                    <div class="">
                        <div class="row">
                            <div class="col-12 col-lg-4 info-span-holder">
                                <div class="title-img">
                                    <div class="title-img-holder">
                                        <img src="http://127.0.0.1:8000/storage/images/638b37ebb9767.jpg" alt="" class="avatar">
                                    </div>
                                    <div class="name-paint-min">
                                        Destellos de Nueva York 15/original artwork (2021)
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_status'):</span> 
                                В пути
                            </div>
                            <div class="col-12 col-lg-2 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_price'):</span> 
                                $1150
                            </div>
                            <div class="col-12 col-lg-4 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_tracknumber'):</span> 
                                <b>Aczxcswfewqwx12343szc</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-product-min">
                    <div class="">
                        <div class="row">
                            <div class="col-12 col-lg-4 info-span-holder">
                                <div class="title-img">
                                    <div class="title-img-holder">
                                        <img src="http://127.0.0.1:8000/storage/images/638b37ebb9767.jpg" alt="" class="avatar">
                                    </div>
                                    <div class="name-paint-min">
                                        Destellos de Nueva York 15/original artwork (2021)
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_status'):</span> 
                                В пути
                            </div>
                            <div class="col-12 col-lg-2 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_price'):</span> 
                                $1150
                            </div>
                            <div class="col-12 col-lg-4 info-span-holder"> 
                                <span class="info-span">@lang('profile.history_tracknumber'):</span> 
                                <b>Aczxcswfewqwx12343szc</b>
                            </div>
                        </div>
                    </div>
                </div>
				{{-- $orders->links('layouts.pagination') --}}
					{{--<div class="pages-scroll">
                    <button class="previous"><img src="/img/previous.svg" alt=""></button>
                    <button type="button" class="pages">1</button>
                    <button type="button" class="pages">2</button>
                    <button type="button" class="pages">3</button>
                    <button type="button" class="pages">4</button>
                    <button class="next"><img src="/img/next.svg" alt=""></button>

					</div>--}}
            </div>
        </div>
    </div>
</main>
@endsection