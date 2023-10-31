@extends('layouts.master')

@section('content')
<main class="profile_page">
    <div class="cover">			  
		@if (!empty($user->image_cover))
			<img class="cover-img" src="/storage/{{ str_replace('public/', '', $user->image_cover)}}">
		@endif
        <!-- <div class="button-cov">
              <nav class="but-t"><img src="/img/iconscam.svg" alt=""></nav>
              <h4>@lang('profile.change_cover')</h4>
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
                <div class="main-headline main-headline-cab">@lang('profile.wishlist')</div>
                <div class="wishlist-items items">
					@foreach ($wishlist as $item)
						<div class="item">
							@include('templates.product', ['product' => $item->product])
						</div>
					@endforeach
                </div>
            </div>
        </div>
    </div>
</main>
    

@endsection
@section('scripts')
<script>
$('.wishlist-items .favorites a').click(function() {
	$(this).parent().parent().parent().parent().remove();
});
</script>
@endsection