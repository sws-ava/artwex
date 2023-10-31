@extends('layouts.master')

@section('content')
	<div class="product-item">
    <div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="name-card-name"><a href="{{ route('homepage') }}">@lang('other.main')</a> / <a href="{{ route('shop', $product->categories[0]->slug) }}">@lang('shop.shop_header')</a> / {{ $product->name }}</div>
			</div>
		</div>
        <div class="row">
             <div class="col-12 col-lg-7">
              
              <!-- container-fluid for the image gallery -->
             <div class="slide-container-fluid">
			<!-- Full-width images with number text -->
				<div class="product-slider">
					@if (count($product->images))
						@foreach($product->images as $image)
							<div class="product-slider__item-holder">
								<div class="product-slider__item">
									<div class="product-slider__img-holder">
										<img class="product-slider__img" src="/storage/{{str_replace('public/', '', $image->path)}}" >
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
  
				<!-- Next and previous buttons -->
				<!-- <a class="prev">prev</a>
				<a class="next">next</a> -->
			
				<!-- Thumbnail images -->
				<div class="row">
					<div class="col-12">
						<div class="product-slider-thumbs-holder">
							<div class="product-slider-thumbs">
								@if (count($product->images))
									@foreach($product->images as $image)
									<div class="product-slider-thumbs__item-holder">
										<div class="product-slider-thumbs__item">
											<img class="product-slider-thumbs__img"src="/storage/{{str_replace('public/', '', $image->path)}}" style="width:100%" >
										</div>
									</div>
									@endforeach
								@endif
							</div>
							@if (count($product->images)>4)
								<div class="item-slider__next">
									<svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.26571 23.9941C0.977639 23.9947 0.743703 23.7615 0.743165 23.4735C0.74292 23.3346 0.798079 23.2013 0.896417 23.1032L12.0033 11.9974L0.896417 0.891553C0.692456 0.687592 0.692456 0.356932 0.896417 0.152971C1.10038 -0.0509902 1.43104 -0.0509902 1.635 0.152971L13.1102 11.6281C13.3138 11.8318 13.3138 12.162 13.1102 12.3657L1.635 23.8408C1.5372 23.9389 1.40429 23.9941 1.26571 23.9941Z" fill="white"/>
									</svg>

								</div>
								<div class="item-slider__prev">
									<svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.26571 23.9941C0.977639 23.9947 0.743703 23.7615 0.743165 23.4735C0.74292 23.3346 0.798079 23.2013 0.896417 23.1032L12.0033 11.9974L0.896417 0.891553C0.692456 0.687592 0.692456 0.356932 0.896417 0.152971C1.10038 -0.0509902 1.43104 -0.0509902 1.635 0.152971L13.1102 11.6281C13.3138 11.8318 13.3138 12.162 13.1102 12.3657L1.635 23.8408C1.5372 23.9389 1.40429 23.9941 1.26571 23.9941Z" fill="white"/>
									</svg>
								</div>
							@endif
						</div>
					</div>
				</div>
				
             </div>
			 @if (count($product->tags))
             <div class="tags">@lang('product.tags')</div>
			
				@foreach($product->tags as $tag)
				<button type="button" class="outline-primary">{{ $tag->name }}</button>
				@endforeach
			@endif
             <div class="definition">
				<div class="item-info-holder">
					<h3>@lang('product.descr')</h3>
					{!! $product->description !!}
             	</div>
             </div>
             </div>
        
             
			<div class="col-12 col-lg-5">
				<div class="item-info-holder">
              <!-- <span><img src="/img/Vector.svg" alt=""></span>
              <span><img src="/img/Vector.svg" alt=""></span>
              <span><img src="/img/Vector.svg" alt=""></span>
              <span><img src="/img/Vector.svg" alt=""></span> -->

              <div class="name-cont">
                <h3>{{ $product->name }}</h3>
              </div>
              <div class="price product-price
				@if ($product->oldprice > 0) 
					have-oldprice	
				@endif
				">
				@if ($product->oldprice > 0)
					<span class="old-price">${{ round($product->oldprice,2) }}</span>
				@endif
					${{ round($product->price,2) }}		
				</div>
				<div class="picture-size">
					<h4>Размер картины:</h4>
					<p>00 х 00 х 00см (без рамки) / 00 х 00см</p>
				</div>
				<div class="copy-size">
					<h4>Размер цифровой копии:</h4>
					<p>4000 х 2200px, 300dpi, PDF</p>
				</div>
				<div class="list-pos">
					<ul>
						<li>Готов повесить</li>
						<li>Стиль: <b>Фотореализм</b></li>
					</ul>
				</div>
				<div class="author">
					<img src="/storage/{{$product->shop->image_avatar}}" alt="{{ $product->shop->name }} {{ $product->shop->last_name }}" align="left">
					<div>@lang('product.author')</div>
					<div><h5>{{ isset($product->shop) ? $product->shop->name : '' }}</h5></div>
				</div>
				@if (!$product->is_selled) 
				<a href="{{route('cart.add', ['id' => $product->id, 'type' => 'natural'])}}" class="picture-buy opHover">@lang('product.buy_item')</a>
				@endif
				<a href="{{route('cart.add', ['id' => $product->id, 'type' => 'digital'])}}" class="copy-buy opHover">@lang('product.buy_item_copy')</a>
				
				<div class="shipping">
						<div class="shippingHeader" data-bs-toggle="collapse" href="#shipping_info" role="button" aria-expanded="false" aria-controls="shipping_info">
							<nav class="shipping1">@lang('product.shipping')</nav>
							<nav class="pl"><img src="/img/icons-p.svg" alt=""></nav>
						</div>
					<div class="collapse multi-collapse" id="shipping_info">
						<div class="shipping-info">
						@if (isset($product->categories[0])) {!! $product->categories[0]->shipping_text !!} @endif
						</div>
					</div>
				</div>
              
              <!-- <div class="reviews">
                  <a href="#review-block" style="color: #4F5163;" class="reviews1">@lang('product.reviews')</a>
                  <nav class="reviews1"><img src="/img/Vector.svg" alt=""></nav>
                  <nav class="reviews1"><img src="/img/Vector.svg" alt=""></nav>
                  <nav class="reviews1"><img src="/img/Vector.svg" alt=""></nav>
                  <nav class="reviews1"><img src="/img/Vector.svg" alt=""></nav>
                  <nav class="reviews1">({{ $product->reviews->count() }})</nav>
                  <a href="#review-block" class="pl"><img src="/img/icons-p.svg" alt=""></a>
                </div> -->
				</div>
             </div>
             
        </div>
    </div>
    </div>

    <div class="about">
		@if (isset($product->shop))
        <div class="about-about">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="author-logo">
                    <img src="/storage/{{$product->shop->image_avatar}}" alt="{{ $product->shop->name }} {{ $product->shop->last_name }}">
                    <h1>{{ $product->shop->name }}</h1>
                </div>
                <div class="about-him">
                    <h2>@lang('product.about_artist')</h2>
                    {!! $product->shop->description !!}
                </div>
                <div>
                    <h2>@lang('product.artist_works')</h2>
                </div>
            </div>
        </div>
        </div>
        </div>
		@endif
        <div class="work">
            <div class="container-fluid">
                <div class="row default-block-items-slider same-images">
                @foreach ($more_products as $more_product)
					<div class="col-12 col-sm-3">
						@include('templates.product', ['product' => $more_product])
					</div>
				@endforeach
                </div>
            </div>
        </div>
    </div>
	
	<!-- <div id="review-block" class="review-block">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					@if (Auth::check())
					@if ($product->shop->id != Auth::user()->shop_id)
					<div class="feedback-container-fluid">
						<h3>@lang('reviews.post_feed')</h3>
						<form action="{{ route('review.product.add', $product->slug) }}" method="POST">
							@csrf
							<div class="feedback-form disabled">
								<div class="disabled-text">@lang('reviews.write_feed')</div>
								<div class="stars-container-fluid">
									<span>@lang('reviews.stars_feed')?</span>
									<div class="stars-items">
										<input id="stars-review-1" type="radio" name="review-stars">
										<input id="stars-review-2" type="radio" name="review-stars">
										<input id="stars-review-3" type="radio" name="review-stars">
										<input id="stars-review-4" type="radio" name="review-stars">
										<input id="stars-review-5" type="radio" name="review-stars">
										<label for="stars-review-1" data-count="1"><svg id="Group" xmlns="http://www.w3.org/2000/svg" height="9.904" viewBox="0 0 10.366 9.904">
												<path id="Path_922" data-name="Path 922" d="M9.973,5.735a.716.716,0,0,0,.206.773l1.829,1.777a.315.315,0,0,1,.077.232l-.464,2.5a.671.671,0,0,0,.18.618.782.782,0,0,0,.953.18L15,10.629a.193.193,0,0,1,.232,0l2.241,1.185a.778.778,0,0,0,1.133-.8l-.438-2.5a.415.415,0,0,1,.077-.232l1.829-1.777a.8.8,0,0,0,.206-.773.747.747,0,0,0-.618-.515l-2.55-.386a.194.194,0,0,1-.18-.129L15.795,2.438a.771.771,0,0,0-1.391,0L13.3,4.7a.194.194,0,0,1-.18.129l-2.524.361A.783.783,0,0,0,9.973,5.735Z" transform="translate(-9.94 -2)" fill="#efba0b" />
											</svg></label>
										<label for="stars-review-2" data-count="2"><svg id="Group" xmlns="http://www.w3.org/2000/svg" height="9.904" viewBox="0 0 10.366 9.904">
												<path id="Path_922" data-name="Path 922" d="M9.973,5.735a.716.716,0,0,0,.206.773l1.829,1.777a.315.315,0,0,1,.077.232l-.464,2.5a.671.671,0,0,0,.18.618.782.782,0,0,0,.953.18L15,10.629a.193.193,0,0,1,.232,0l2.241,1.185a.778.778,0,0,0,1.133-.8l-.438-2.5a.415.415,0,0,1,.077-.232l1.829-1.777a.8.8,0,0,0,.206-.773.747.747,0,0,0-.618-.515l-2.55-.386a.194.194,0,0,1-.18-.129L15.795,2.438a.771.771,0,0,0-1.391,0L13.3,4.7a.194.194,0,0,1-.18.129l-2.524.361A.783.783,0,0,0,9.973,5.735Z" transform="translate(-9.94 -2)" fill="#efba0b" />
											</svg></label>
										<label for="stars-review-3" data-count="3"><svg id="Group" xmlns="http://www.w3.org/2000/svg" height="9.904" viewBox="0 0 10.366 9.904">
												<path id="Path_922" data-name="Path 922" d="M9.973,5.735a.716.716,0,0,0,.206.773l1.829,1.777a.315.315,0,0,1,.077.232l-.464,2.5a.671.671,0,0,0,.18.618.782.782,0,0,0,.953.18L15,10.629a.193.193,0,0,1,.232,0l2.241,1.185a.778.778,0,0,0,1.133-.8l-.438-2.5a.415.415,0,0,1,.077-.232l1.829-1.777a.8.8,0,0,0,.206-.773.747.747,0,0,0-.618-.515l-2.55-.386a.194.194,0,0,1-.18-.129L15.795,2.438a.771.771,0,0,0-1.391,0L13.3,4.7a.194.194,0,0,1-.18.129l-2.524.361A.783.783,0,0,0,9.973,5.735Z" transform="translate(-9.94 -2)" fill="#efba0b" />
											</svg></label>
										<label for="stars-review-4" data-count="4"><svg id="Group" xmlns="http://www.w3.org/2000/svg" height="9.904" viewBox="0 0 10.366 9.904">
												<path id="Path_922" data-name="Path 922" d="M9.973,5.735a.716.716,0,0,0,.206.773l1.829,1.777a.315.315,0,0,1,.077.232l-.464,2.5a.671.671,0,0,0,.18.618.782.782,0,0,0,.953.18L15,10.629a.193.193,0,0,1,.232,0l2.241,1.185a.778.778,0,0,0,1.133-.8l-.438-2.5a.415.415,0,0,1,.077-.232l1.829-1.777a.8.8,0,0,0,.206-.773.747.747,0,0,0-.618-.515l-2.55-.386a.194.194,0,0,1-.18-.129L15.795,2.438a.771.771,0,0,0-1.391,0L13.3,4.7a.194.194,0,0,1-.18.129l-2.524.361A.783.783,0,0,0,9.973,5.735Z" transform="translate(-9.94 -2)" fill="#efba0b" />
											</svg></label>
										<label for="stars-review-5" data-count="5"><svg id="Group" xmlns="http://www.w3.org/2000/svg" height="9.904" viewBox="0 0 10.366 9.904">
												<path id="Path_922" data-name="Path 922" d="M9.973,5.735a.716.716,0,0,0,.206.773l1.829,1.777a.315.315,0,0,1,.077.232l-.464,2.5a.671.671,0,0,0,.18.618.782.782,0,0,0,.953.18L15,10.629a.193.193,0,0,1,.232,0l2.241,1.185a.778.778,0,0,0,1.133-.8l-.438-2.5a.415.415,0,0,1,.077-.232l1.829-1.777a.8.8,0,0,0,.206-.773.747.747,0,0,0-.618-.515l-2.55-.386a.194.194,0,0,1-.18-.129L15.795,2.438a.771.771,0,0,0-1.391,0L13.3,4.7a.194.194,0,0,1-.18.129l-2.524.361A.783.783,0,0,0,9.973,5.735Z" transform="translate(-9.94 -2)" fill="#efba0b" />
											</svg></label>
									</div>
									<span id="stars-count"></span>
									<input id="stars-input" type="hidden" name="rating" value="5">
									<input id="parent-input" type="hidden" name="parent_id" value="0">
									<hr>
								</div>
								<textarea name="comment" placeholder="@lang('reviews.add_text')"></textarea>
							</div>
							<button type="submit">@lang('reviews.post_feed_short')</button>
						</form>
					</div>
					@endif
					@endif
					<h4>@lang('reviews.all_feeds')</h4>
					@foreach ($product->reviews as $review)
					@if ($review->parent_id == 0)
					<div class="review-item">
						<div class="review-info">
							<div class="image-container-fluid">
								<div class="image-wrapper">
								@if ($review->user->shop_id > 0)
									@if (!empty($review->user->shop->image_avatar))
									<img src="/storage/{{ str_replace('public/', '', $review->user->shop->image_avatar)}}" style="height: 100%;">
									@else
									<img src="/img/no-avatar.png" alt="">
									@endif
								@else
									@if (!empty($review->user->image_avatar))
									<img src="/storage/{{ str_replace('public/', '', $review->user->image_avatar)}}" style="height: 100%;">
									@else
									<img src="/img/no-avatar.png" alt="">
									@endif
								@endif
								</div>
								<div class="review-status status-green">
									<svg id="noun_Heart_1814275" xmlns="http://www.w3.org/2000/svg" width="9.073" height="8.354" viewBox="0 0 9.073 8.354">
										<g id="Group_15" data-name="Group 15">
											<path id="Path_937" data-name="Path 937" d="M13.442,966.416a2.4,2.4,0,0,0-1.761.77,2.731,2.731,0,0,0,0,3.686l3.479,3.752a.465.465,0,0,0,.679,0l3.483-3.748a2.73,2.73,0,0,0,0-3.686,2.394,2.394,0,0,0-3.519,0l-.3.323-.3-.327A2.389,2.389,0,0,0,13.442,966.416Zm0,.9a1.464,1.464,0,0,1,1.075.5l.646.694a.465.465,0,0,0,.679,0l.643-.686a1.414,1.414,0,0,1,2.154,0,1.813,1.813,0,0,1,0,2.419L15.5,973.625l-3.134-3.385a1.818,1.818,0,0,1,0-2.422A1.471,1.471,0,0,1,13.442,967.32Z" transform="translate(-10.965 -966.416)" fill="#fff" />
										</g>
									</svg>
								</div>
							</div>
							<div class="info-container-fluid">
								<div class="info-title">
									<h3>{{$review->user->name}}</h3>
									@if ($review->parent_id == 0)
									<div class="review-rating">
									@for ($i = 0; $i < $review->rating; $i++)
										<svg id="Group" xmlns="http://www.w3.org/2000/svg" height="9.904" viewBox="0 0 10.366 9.904">
											<path id="Path_922" data-name="Path 922" d="M9.973,5.735a.716.716,0,0,0,.206.773l1.829,1.777a.315.315,0,0,1,.077.232l-.464,2.5a.671.671,0,0,0,.18.618.782.782,0,0,0,.953.18L15,10.629a.193.193,0,0,1,.232,0l2.241,1.185a.778.778,0,0,0,1.133-.8l-.438-2.5a.415.415,0,0,1,.077-.232l1.829-1.777a.8.8,0,0,0,.206-.773.747.747,0,0,0-.618-.515l-2.55-.386a.194.194,0,0,1-.18-.129L15.795,2.438a.771.771,0,0,0-1.391,0L13.3,4.7a.194.194,0,0,1-.18.129l-2.524.361A.783.783,0,0,0,9.973,5.735Z" transform="translate(-9.94 -2)" fill="#efba0b" />
										</svg>
										@endfor
										{{--<span>{{$review->rating}}</span>--}}
									</div>
									@endif
								</div>
								<p>{{$review->comment}}</p>
								<p style="text-align: left;">{{implode('-',array_reverse(explode('-',mb_substr($review->created_at, 0,10))))}}</p>
							</div>
						</div>
					</div>
					@endif
						@foreach ($product->reviews as $preview)
							@if ($preview->parent_id == $review->id)
								<div class="review-item" style="background: #f0f0f0; padding-left: 20px">
									<div class="review-info">
										<div class="image-container-fluid">
											<div class="image-wrapper">
											@if ($preview->user->shop_id > 0)
												@if (!empty($preview->user->shop->image_avatar))
												<img src="/storage/{{ str_replace('public/', '', $preview->user->shop->image_avatar)}}" style="height: 100%;">
												@else
												<img src="/img/no-avatar.png" alt="">
												@endif
											@else
												@if (!empty($preview->user->image_avatar))
												<img src="/storage/{{ str_replace('public/', '', $preview->user->image_avatar)}}" style="height: 100%;">
												@else
												<img src="/img/no-avatar.png" alt="">
												@endif
											@endif
											</div>
											<div class="review-status status-green">
												<svg id="noun_Heart_1814275" xmlns="http://www.w3.org/2000/svg" width="9.073" height="8.354" viewBox="0 0 9.073 8.354">
													<g id="Group_15" data-name="Group 15">
														<path id="Path_937" data-name="Path 937" d="M13.442,966.416a2.4,2.4,0,0,0-1.761.77,2.731,2.731,0,0,0,0,3.686l3.479,3.752a.465.465,0,0,0,.679,0l3.483-3.748a2.73,2.73,0,0,0,0-3.686,2.394,2.394,0,0,0-3.519,0l-.3.323-.3-.327A2.389,2.389,0,0,0,13.442,966.416Zm0,.9a1.464,1.464,0,0,1,1.075.5l.646.694a.465.465,0,0,0,.679,0l.643-.686a1.414,1.414,0,0,1,2.154,0,1.813,1.813,0,0,1,0,2.419L15.5,973.625l-3.134-3.385a1.818,1.818,0,0,1,0-2.422A1.471,1.471,0,0,1,13.442,967.32Z" transform="translate(-10.965 -966.416)" fill="#fff" />
													</g>
												</svg>
											</div>
										</div>
										<div class="info-container-fluid">
											<div class="info-title">
												<h3>{{$preview->user->name}}</h3>
											</div>
											<p>{{$preview->comment}}</p>
											 <p style="text-align: left;">{{implode('-',array_reverse(explode('-',mb_substr($preview->created_at, 0,10))))}}</p>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					@endforeach
					@if ($product->reviews->count() > 20) 
					<div class="button-container-fluid">
						<a href="#">@lang('reviews.see_more') ({{$product->reviews->count()}})</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div> -->

    <div class="recent">
        <div class="container-fluid ">
			<div class="row">
                <h2>@lang('product.recently_viewed')</h2>
			</div>
            <div class="row default-block-items-slider same-images">
				@foreach ($recently_viewed_items as $recent_product)
				<div class="col-12 col-sm-3">
					@include('templates.product', ['product' => $recent_product])
				</div>
				@endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
 <script>
	$(document).ready(function() {

		$(window).resize(function() {
			$('.default-block-items-slider').slick('resize');
		});

        $('.default-block-items-slider').slick({
     		mobileFirst: true,
			arrows: false,
			autoplay: false,
			infinite: false,
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
						infinite: false,
						slidesToShow: 3.2,
						// centerMode: true,
						// centerPadding: '15px'
					}
				},
				{
					breakpoint: 500,
					settings: {
						infinite: false,
						slidesToShow: 2.2,
						// centerMode: true,
						// centerPadding: '15px'
					}
				},
				{
					breakpoint: 300,
					settings: {
						infinite: false,
						slidesToShow: 1.1,
						// centerMode: true,
						// centerPadding: '15px'
					}
				}
			]
        });
	})
	

	$('.product-slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		asNavFor: '.product-slider-thumbs',
		dots: false,
		centerMode: false,
		arrows: true,
		infinite: false,
		nextArrow: '.item-slider__next',
        prevArrow: '.item-slider__prev'
	});

	$('.product-slider-thumbs').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: false,
		infinite: false,
		focusOnSelect: true,
		asNavFor: '.product-slider'
	});

 </script>
@endsection