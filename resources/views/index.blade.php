@extends('layouts.master')

@section('content')
	<div class="home-slider"@if (!empty($sliders[0]->background_color)) style="background: {{$sliders[0]->background_color}}"@endif>
        <div class="home-header">
            <div class="container-fluid">
                <div class="row">
					<div class="col-12">
						<div id="artMainCarousel" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-indicators">
								@foreach ($sliders as $slider)
									<div class="slider-button-holder">
										<span data-bs-target="#artMainCarousel" data-bs-slide-to="{{ $loop->iteration-1 }}"@if ( $loop->iteration == 1 ) class="active" aria-current="true"@endif aria-label="Slide {{ $slider->id }}">
											<div class="slider-button-line"></div>
										</span>
									</div>
								@endforeach
							</div>
							<div class="carousel-inner">
								@foreach ($sliders as $slider)	
								<div
									@if ( $loop->iteration == 1 ) 
										class="carousel-item active"
									@else 
										class="carousel-item"
									@endif
									@if (!empty($slider->background_color))
										data-background="{{$slider->background_color}}"
									@endif
									>
									<div class="row">
										<div class="col-12 col-md-6">
											<div class="hd-home-header">
												<h3 class="heading-home-header"@if (!empty($slider->title_color)) style="color: {{$slider->title_color}}" @endif>{{ $slider->title }}</h3>
												<h4 class="description-home-header"@if (!empty($slider->sub_title_color)) style="color: {{$slider->sub_title_color}}" @endif>{{ $slider->sub_title }}</h4>
												@if (!is_null($slider->link))
												<button class=" opHover" onclick="window.location.href='{{$slider->link}}'"@if (!empty($slider->button_color)) style="background: {{$slider->button_color}}"@endif>@lang('landing.buy_now')</button>
												@endif
											</div>
										</div>
										<div class="col-12 col-md-6 text-center">
											<img class="home-slide__img" src="/storage/{{$slider->image}}" alt="{{ $slider->title }}">
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<button class="carousel-control-prev" type="button" data-bs-target="#artMainCarousel" data-bs-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#artMainCarousel" data-bs-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Next</span>
							</button>
						  </div>
					</div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-shop-by-category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-8 col-xl-6">
                    <h3 class="arthome-page-headers">@lang('landing.block_one_header')</h3>
                </div>
                <div class="col-12 col-sm-4 col-xl-6">
                    <a href="{{ route('categories') }}" class="but-arthome-page-headers">@lang('landing.show_all') <img src="/img/arrow1.svg" alt=""></a>
                </div>
            </div>
            <div class="row">
				@foreach($categories as $category)
					<div class="col-6 col-md-3 shop-by-category">
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
	<div class="home-popular-paintings">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-8 col-xl-6">
					<h3 class="arthome-page-headers">@lang('landing.block_two_header')</h3>
				</div>
				<div class="col-12 col-sm-4 col-xl-6">
					<a href="{{ route('popular') }}" class="but-arthome-page-headers">@lang('landing.show_all') <img src="/img/arrow1.svg" alt=""></a>
				</div>
				<div class="col-12">
					<div id="home-popular-paintings">
						<div class="row home-popular-paintings-slider">
							@foreach ($paintings as $painting)
								<div class="
									@if($loop->index +1 == 1 || $loop->index +1 == 6)
										col-12 col-sm-6 col-md-4 col-lg-6
									@else
										col-12 col-sm-6 col-md-4 col-lg-3
									@endif
								">
									@include('templates.product', ['product' => $painting])
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="home-featured-artists">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="arthome-page-headers">@lang('landing.block_three_header')</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="{{ route('artists') }}" class="but-arthome-page-headers">@lang('landing.show_all') <img src="/img/arrow1.svg" alt=""></a>
                </div>
            </div>
            <div class="row">
				<div class="col-12 artistsBlock">
					<div class="artistRow">
						@foreach ($shops as $shop) 
						<div class="artistItem">
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
					<div class="customLeftArrow"><img src="/img/leftArrow.svg" /></div>
					<div class="customRightArrow"><img src="/img/rightArrow.svg" /></div>
				</div>
            </div>
        </div>
    </div>

    <div class="home-selected-sculptures">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="arthome-page-headers">@lang('landing.block_four_header')</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="{{ route('popular') }}" class="but-arthome-page-headers">@lang('landing.show_all') <img src="/img/arrow1.svg" alt=""></a>
                </div>
            </div>
			<div class="row">
				<div class="row home-selected-sculptures-slider">
					@foreach ($sculptures as $sculpture)
						<div class="col-12 col-sm-6 col-lg-3">
							@include('templates.product', ['product' => $sculpture])
						</div>
					@endforeach
				</div>
			</div>
        </div>
    </div>

    <div class="home-on-sale-discount">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="home-s-discoun">
                        <h3>@lang('landing.block_five_header')</h3>
                        <a href="{{ route('sale') }}" class="btn btn-website">@lang('landing.more')</a>
                    </div>
                </div>
				<div class="col-12 col-lg-9">
					<div class="position-relative">
						<div class="saleRow">
						@foreach ($sales as $sale)
							<div class="saleItem">
								@include('templates.product', ['product' => $sale])
							</div>
						@endforeach
						</div>
						<div class="customSaleLeftArrow"><img src="/img/leftArrow.svg" /></div>
						<div class="customSaleRightArrow"><img src="/img/rightArrow.svg" /></div>
					</div>
				</div>
            </div>
        </div>
    </div>

	@if (count($recently_viewed_items))
    <div class="home-recently-watched">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3 class="arthome-page-headers">@lang('landing.block_six_header')</h3>
                </div>
            </div>
			<div class="row">
				<div class="row home-selected-sculptures-slider">
					@foreach ($recently_viewed_items as $recent_product)
						@if ($loop->index < 4)
						<div class="col-12 col-sm-6 col-lg-3">
							@include('templates.product', ['product' => $recent_product])
						</div>
						@endif
					@endforeach
				</div>
			</div>
        </div>
    </div>
	@endif
@endsection

@section('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function() {
		$('.saleRow').slick({			
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            autoplay: false,
			// centerMode: true,
			// centerMode: true,
			// centerPadding: '50px',
            prevArrow: $('.customSaleLeftArrow'),
            nextArrow: $('.customSaleRightArrow'),
            responsive: [
				{
					breakpoint: 1400,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 1250,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 993,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 870,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
					}
				}
			]
        });	
		$(window).resize(function() {
			$('.artistRow').slick('resize');
			$('.home-popular-paintings-slider').slick('resize');
			$('.home-selected-sculptures-slider').slick('resize');
			
		});

		
        $('.home-selected-sculptures-slider').slick({
     		mobileFirst: true,
			arrows: false,
			autoplay: false,
            responsive: [
				{
					breakpoint: 991,
					settings: "unslick"
				},
				{
					breakpoint: 990.98,
					settings: {
						
						infinite: false,
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 750,
					settings: {
						infinite: true,
						slidesToShow: 3,
						centerMode: true,
						centerPadding: '15px'
					}
				},
				{
					breakpoint: 500,
					settings: {
						infinite: true,
						slidesToShow: 2,
						centerMode: true,
						centerPadding: '15px'
					}
				},
				{
					breakpoint: 300,
					settings: {
						infinite: false,
						slidesToShow: 1,
						centerMode: true,
						centerPadding: '15px'
					}
				}
			]
        });

        $('.home-popular-paintings-slider').slick({
     		mobileFirst: true,
			arrows: false,
			autoplay: false,
            responsive: [
				{
					breakpoint: 991,
					settings: "unslick"
				},
				{
					breakpoint: 990.98,
					settings: {
						
						infinite: false,
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 750,
					settings: {
						infinite: true,
						slidesToShow: 3,
						centerMode: true,
						centerPadding: '15px'
					}
				},
				{
					breakpoint: 500,
					settings: {
						infinite: true,
						slidesToShow: 2,
						centerMode: true,
						centerPadding: '15px'
					}
				},
				{
					breakpoint: 300,
					settings: {
						infinite: false,
						slidesToShow: 1,
						centerMode: true,
						centerPadding: '15px'
					}
				}
			]
        });

        $('.artistRow').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true    ,
            autoplay: false,
            prevArrow: $('.customLeftArrow'),
            nextArrow: $('.customRightArrow'),
            responsive: [
				{
					breakpoint: 1400,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 1250,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 993,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 870,
					settings: {
						slidesToShow: 1,
					}
				},
				{
					breakpoint: 600,
					settings: "unslick"
					// settings: {
					// 	slidesToShow: 1,
					// }
				}
			]
        });
    });
	  var myCarousel = document.getElementById('artMainCarousel')

		myCarousel.addEventListener('slid.bs.carousel', function (e) {
			let background = $(this).find(".carousel-item.active").data('background');
			
			$('.home-slider').css("background", background);
		})
		
		/*let height = 0;
		
		$.each($('#home-popular-paintings').children('div'), function(idx, itm) {
			let o = checkOrientation($(itm).find('.itemImage'));	
			$(itm).addClass(o);
			let tmpheight = $(itm).find('.itemImage').height();
			if (tmpheight > height) {
				height = tmpheight;
			}
		});
		
		$.each($('#home-popular-paintings').children('div'), function(idx, itm) {
			$(itm).find('.itemImage').css('height', height);
			$(itm).find('.itemImage').css('width', 'inherit');
		});

		var listitems = $('#home-popular-paintings').children('div').get();
		
		listitems.sort(function(a, b) {
			console.log(a.className.replace('col-12 col-sm-6 col-lg-4 ',''));
		   return a.className.replace('col-12 col-sm-6 col-lg-4 ','') > b.className.replace('col-12 col-sm-6 col-lg-4 ','');
		})
		$.each(listitems, function(idx, itm) { 

			$('#home-popular-paintings').append(itm); 
		});

		function checkOrientation(myImg) {
			if (myImg.width() > myImg.height()){
				return 'landscape';
			} else if (myImg.width() < myImg.height()){
				return 'portrait';
			} else {
				return 'square';
			}
		}*/
</script>
@endsection