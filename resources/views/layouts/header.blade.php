<style>
.dd-select {
    border-radius: 2px;
    border: none !important;
    position: relative;
    cursor: pointer;
    background-color: transparent !important;
}
.dd-selected {
	font-weight: normal;
}
.dd-selected-text {
	display: inline;
    margin-right: 10px;
    font-size: 14px;
    line-height: 16px;
    color: #4F5163;
}
.art-catalog-logo img {
    border-radius: 100%;
}
/* iCheck */
.icheckbox_minimal,
.iradio_minimal {
  display: inline-block;
  *display: inline;
  vertical-align: middle;
  margin: 0;
  padding: 0;
  width: 18px;
  height: 18px;
  background: url(/img/icheck/minimal.png) no-repeat;
  border: none;
  cursor: pointer;
}
.icheckbox_minimal {
  background-position: 0 0;
}
.icheckbox_minimal.hover {
  background-position: -20px 0;
}
.icheckbox_minimal.checked {
  background-position: -40px 0;
}
.icheckbox_minimal.disabled {
  background-position: -60px 0;
  cursor: default;
}
.icheckbox_minimal.checked.disabled {
  background-position: -80px 0;
}
.iradio_minimal {
  background-position: -100px 0;
}
.iradio_minimal.hover {
  background-position: -120px 0;
}
.iradio_minimal.checked {
  background-position: -140px 0;
}
.iradio_minimal.disabled {
  background-position: -160px 0;
  cursor: default;
}
.iradio_minimal.checked.disabled {
  background-position: -180px 0;
}
/* HiDPI support */
@media (-o-min-device-pixel-ratio: 5/4),
  (-webkit-min-device-pixel-ratio: 1.25),
  (min-resolution: 120dpi),
  (min-resolution: 1.25dppx) {
  .icheckbox_minimal,
  .iradio_minimal {
    background-image: url(/img/icheck/minimal@2x.png);
    -webkit-background-size: 200px 20px;
    background-size: 200px 20px;
  }
}

/* iCheck plugin Minimal skin, blue
----------------------------------- */
.icheckbox_minimal-blue,
.iradio_minimal-blue {
  display: inline-block;
  *display: inline;
  vertical-align: middle;
  margin: 0;
  padding: 0;
  width: 18px;
  height: 18px;
  background: url(/img/icheck/blue.png) no-repeat;
  border: none;
  cursor: pointer;
}
.icheckbox_minimal-blue {
  background-position: 0 0;
}
.icheckbox_minimal-blue.hover {
  background-position: -20px 0;
}
.icheckbox_minimal-blue.checked {
  background-position: -40px 0;
}
.icheckbox_minimal-blue.disabled {
  background-position: -60px 0;
  cursor: default;
}
.icheckbox_minimal-blue.checked.disabled {
  background-position: -80px 0;
}
.iradio_minimal-blue {
  background-position: -100px 0;
}
.iradio_minimal-blue.hover {
  background-position: -120px 0;
}
.iradio_minimal-blue.checked {
  background-position: -140px 0;
}
.iradio_minimal-blue.disabled {
  background-position: -160px 0;
  cursor: default;
}
.iradio_minimal-blue.checked.disabled {
  background-position: -180px 0;
}

img.img-tiny {
  max-width: 30px;
  max-height: 30px;
}
img.img-mini {
  max-width: 60px;
  max-height: 60px;
}
img.img-small {
  max-width: 100px;
  max-height: 100px;
}
img.img-medium {
  max-width: 250px;
  max-height: 250px;
}

img.verified-badge {
  margin-left: 5px;
  margin-bottom: 3px;
  margin-right: 5px !important;
}

/* HiDPI support */
@media (-o-min-device-pixel-ratio: 5/4),
  (-webkit-min-device-pixel-ratio: 1.25),
  (min-resolution: 120dpi),
  (min-resolution: 1.25dppx) {
  .icheckbox_minimal-blue,
  .iradio_minimal-blue {
    background-image: url(/img/icheck/blue@2x.png);
    -webkit-background-size: 200px 20px;
    background-size: 200px 20px;
  }
}
.icheckbox_minimal,
.iradio_minimal,
.iradio_minimal-blue,
.icheckbox_minimal-blue {
  margin-right: 2px !important;
}
.footer .footer_logos img, .footer .footer_social img {
	width: inherit;
	height:22px;
}
.footer .footer_social img:hover {
	filter: blur(1px);
}
.mySlides {
	text-align: center;
    background-color: #EBEBF4;
    padding: 30px;
	margin-bottom: 10px;
}
.footer li {
    color: #9396A9;
    font-size: 16px;
}
.footer a:hover {
    color: #abaebf;
    font-size: 16px;
}
.artistItem {
	padding: 0 10px;
}
.artistsBlock {
	position:relative;
}
.customLeftArrow, .customRightArrow, .customSaleLeftArrow, .customSaleRightArrow{
	position: absolute;
	top: 35%;
	cursor: pointer;
}
.customLeftArrow, .customSaleLeftArrow {
	left: 0;
}
.customRightArrow, .customSaleRightArrow {
	right: 0;
}
.saleItem {
	padding: 0 30px;
}
.btn-website {
	border-radius: 0;
}
.btn-website:hover {
    background: #ba1518;
    border: 0.5px solid #ba1518;
    margin-bottom: 20px;
    font-size: 18px;
    color: #FFFFFF;
}
</style>
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 header-block">
                    <div class="logo opHover"><a href="/"><img src="/img/artwex_logo.svg" style="width: 160px;"></a></div>
                    <div class="search d-none d-lg-block">
						{!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-header-form', 'class' => '', 'role' => 'search']) !!}
                        <input type="text" name="query" placeholder="@lang('header.search_placeholder')" value=""/>
                        <button type="submit"><img src="/img/search.svg" alt=""></button>
						{!! Form::close() !!}
                    </div>
                    <div class="languages d-none d-lg-block">
					{{--<div class="lang-1"><a href="#">Укр</a></div>
					<div class="lang-2"><img src="/img/down.svg" alt=""></div>--}}
					  <select name="lang" id="languageChange">

						@foreach ($footer_languages as $lang)
						  <option dd-link="{{ route('locale.change', $lang->slug) }}" value="11{{ $lang->slug }}" {{ $lang->slug == \App::getLocale() ? 'selected' : '' }}>
                {{ $lang->language_name }} 
                
							  {{ '<img src="/img/flags/'}}{{$lang->slug}}{{'.png" alt="">' }}
						  </option>
						@endforeach
					  </select>
                    </div>
                    <div class="icons">
                        <div class="cart-l opHover"><a href="{{ route('cart') }}"><img src="/img/cart.svg"></a> 
						@if (\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()>0)
						({{ \Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity() }})
						@endif
						</div>
                        <div class="heart-l opHover"><a href="@if (Auth::check()){{ route('profile.wishlist') }}@else{{ route('login') }}@endif"><img src="/img/heart.svg"></a></div>                 
					@if (Auth::check())
                        <a href="{{ route('profile') }}" title="@lang('header.profile')" class="d-none d-lg-block"><img src="/img/avatar_icon.svg" alt="@lang('header.profile')" /></a>
					</div> 
					@else
					</div> 
					<div class="buttons d-none d-lg-block">
						<button class="btn-enter opHover"><a href="{{ route('login') }}">@lang('header.login')</a></button>
                        <button class="btn-register opHover"><a href="{{ route('register') }}">@lang('header.register')</a></button>
					</div>
					@endif
                    
					<div class="burgerToggle"><svg class="ham hamRotate ham8" viewBox="0 0 100 100" width="65"><path class="line top" d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path class="line middle" d="m 30,50 h 40"></path><path class="line bottom" d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg></div>
                </div>
                <div class="col-12">
                    <nav class="topmenu">
						<div class="d-none search">
							{!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-header-form', 'class' => '', 'role' => 'search']) !!}
							<input type="text" name="query" placeholder="@lang('header.search_placeholder')" value=""/>
							<button type="submit"><img src="/img/search.svg" alt=""></button>
							{!! Form::close() !!}
						</div>					
					    <div class="d-none buttons">
						@if (Auth::check())
							<button class="btn-enter"><a href="{{ route('profile') }}">@lang('header.profile')</a></button>
						@else
							<button class="btn-enter"><a href="{{ route('login') }}">@lang('header.login')</a></button>
							<button class="btn-register"><a href="{{ route('register') }}">@lang('header.register')</a></button>
						@endif
						</div>
                        <ul class="navList">
                            <li>
								<a href="#">@lang('header_navigation.shop')</a><img src="/img/down.svg" alt="">
								<ul>
									@foreach ($all_categories as $category)
									<li><a href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a></li>
									@endforeach
									<li><a href="{{ route('order_art') }}">@lang('header_navigation.order_art')</a></li>
								</ul>
							</li>
                            <li>
								<a href="{{ route('inspiration') }}">@lang('header_navigation.inspiration')</a><img src="/img/down.svg" alt="">
								<ul>
									<li><a href="{{ route('sale') }}">@lang('sales.sale_header')</a></li>
									<li><a href="{{ route('popular') }}">@lang('header_navigation.top_popular')</a></li>
									<li><a href="{{ route('artists') }}">@lang('header_navigation.artists')</a></li>
									<li><a href="{{ route('inspiration') }}">@lang('header_navigation.ideas')</a></li>
								</ul>
							</li>
                            <li><a href="{{ route('about') }}">@lang('header_navigation.about')</a></li>
							@foreach ($pages->where('position', 'main_nav') as $page)
							<li>
							  <a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">
								{{ $page->title }}
							  </a>
							</li>
							@endforeach
                            <li><a href="{{ route('contact') }}">@lang('header_navigation.contact_us')</a></li>
                        </ul>
                    </nav>





                    <div class="mobileMenu">
                      <div class="mobileMenu__inner">
                        <nav class="topmenu">
                          <div class="search">
                            {!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-header-form', 'class' => '', 'role' => 'search']) !!}
                            <input type="text" name="query" placeholder="@lang('header.search_placeholder')" value=""/>
                            <button type="submit"><img src="/img/search.svg" alt=""></button>
                            {!! Form::close() !!}
                          </div>
                          <div class="languages">
                            <select name="lang" id="languageChange">
                            @foreach ($footer_languages as $lang)
                              <option dd-link="{{ route('locale.change', $lang->slug) }}" value="11{{ $lang->slug }}" {{ $lang->slug == \App::getLocale() ? 'selected' : '' }}>
                                {{ $lang->language_name }} 
                                
                                {{ '<img src="/img/flags/'}}{{$lang->slug}}{{'.png" alt="">' }}
                              </option>
                            @endforeach
                            </select>
                          </div>
                          <div class="buttons">
                          @if (Auth::check())
                            <button class="btn-enter"><a href="{{ route('profile') }}">@lang('header.profile')</a></button>
                          @else
                            <button class="btn-enter"><a href="{{ route('login') }}">@lang('header.login')</a></button>
                            <button class="btn-register"><a href="{{ route('register') }}">@lang('header.register')</a></button>
                          @endif
                          </div>


                          <div class="accordion accordion-flush" id="accordionMobileMenu">
                            <div class="accordion-item">
                              <a class="accHeader collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                @lang('header_navigation.shop')
                                <img class="accArrow" src="/img/down.svg" alt="">
                              </a>
                              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionMobileMenu">
                                
                              <ul class="accLinks">
                                  @foreach ($all_categories as $category)
                                  <li><a href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a></li>
                                  @endforeach
                                  <li><a href="{{ route('order_art') }}">@lang('header_navigation.order_art')</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <a class="accHeader collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                                @lang('header_navigation.inspiration')
                                <img class="accArrow" src="/img/down.svg" alt="">
                              </a>
                              <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionMobileMenu">
                                
                              <ul class="accLinks">
                                <li><a href="{{ route('sale') }}">@lang('sales.sale_header')</a></li>
                                <li><a href="{{ route('popular') }}">@lang('header_navigation.top_popular')</a></li>
                                <li><a href="{{ route('artists') }}">@lang('header_navigation.artists')</a></li>
                                <li><a href="{{ route('inspiration') }}">@lang('header_navigation.ideas')</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                            <div class="accordion-item">
                              <a class="accHeader" href="{{ route('about') }}">@lang('header_navigation.about')</a>
                            </div>
                            <div class="accordion-item">
                              <a class="accHeader" href="{{ route('contact') }}">@lang('header_navigation.contact_us')</a>
                            </div>
                          </div>




                          <!-- <ul class="navList">
                            <li>
                              <a href="{{ route('about') }}">@lang('header_navigation.about')</a>
                            </li>
                            @foreach ($pages->where('position', 'main_nav') as $page)
                            <li>
                              <a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">
                              {{ $page->title }}
                              </a>
                            </li>
                            @endforeach
                              <li><a href="{{ route('contact') }}">@lang('header_navigation.contact_us')</a></li>
                          </ul> -->
                        </nav>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </header>