@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="cover">
        <h6><a href="{{ route('homepage') }}">@lang('other.main')</a> / @lang('cart.cartheader')</h6>
        <h2>@lang('cart.cartheader')</h2>
    </div>

    <div class="shopping-list">
		<div class="container-fluid-fluid">
			@if ($messageErrorPromocode)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>{{ $messageErrorPromocode }}</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" area-label="Close"></button>
			</div>
			@endif
			<div class="row">
				@if (count($products))
				<div class="col-12 col-lg-7 col-xl-8">
					@foreach($products as $product)
					<div class="product">
						<div class="d-flex">
							<div class="product-image">
								@if (count($product->associatedModel->images))
									<img src="/storage/{{str_replace("public/", "", $product->associatedModel->images[0]->path)}}">
								@else
									<img src="/img/placeholder-100x100.png">
								@endif
							</div>
							<div class="product-info">
								<div class="name-paint"><h5>{{ $product->name }} @if($product->attributes->has('type')) {{ $product->attributes['type'] }} @else @endif</h5>
									<div class="product-price
										@if ($product->oldprice > 0) 
											have-oldprice	
										@endif
										">
										@if ($product->oldprice > 0)
											<span class="old-price">${{ round($product->oldprice,2) }}</span>
										@endif
										${{ round($product->price,2) }}		
									</div>
								</div>
								<div class="craftsman"><h4>{{ isset($product->associatedModel->shop) ? $product->associatedModel->shop->name : '' }}</h4></div>
								<div class="proportions"><h3>Размер:</h3><h2>101.6 x 76.2 x 3.81cm</h2></div>
								<div>
									<h3>Размер цифровой:</h3>
									<h2>4000 х 2200px, 300dpi, PDF</h2>
									
									<div class="name-paint name-paint-mobile">
										<div class="product-price
											@if ($product->oldprice > 0) 
												have-oldprice	
											@endif
											">
											@if ($product->oldprice > 0)
												<span class="old-price">${{ round($product->oldprice,2) }}</span>
											@endif
											${{ round($product->price,2) }}		
										</div>
									</div>
									<a 
										href="{{route('cart.delete', ['id' => $product->id])}}" 
										class="delete">
											<img id="backet" src="/img/iconsbasket.svg" alt="">
											@lang('cart.delete')
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="col-12 col-lg-5 col-xl-4">
					<div class="total">
						<div class="total-h">
							<h2>@lang('cart.summary')</h2>
						</div>
						<div class="total-hh">
							<h3>@lang('cart.subtotal')</h3><span class="amount">${{ $subTotal }}</span>
						</div>
						@if ($is_promocode) 
						<div class="total-hh">
							<h3>@lang('cart.cartpromocode'):</h3><span class="amount">{{ $promocode->promocode }}</span>
						</div>
						<div class="total-hh">
							<h3>@lang('cart.totalpromocode')</h3><span class="amount">{{ $subTotal - $conditionCalculatedValue }}</span>
						</div>
						@else
						<form action="{{ route('set_promocode') }}" method="post" class="promocode-form">
							@csrf
							<input class="inp" type="text" name="promocode" placeholder="@lang('cart.cartpromocode')">
							<button class="but" type="submit">@lang('cart.apply')</button>
						</form>
						@endif
						<a class="checkout_btn" href="{{ route('checkout') }}">@lang('cart.checkout')</a>
					</div>
				</div>
				@else 
					<div class="col-12">
						<div class="d-flex justify-content-center"><h3>@lang('cart.empty_cart')</h3></div>
					</div>
				@endif
			</div>
		</div>
    </div>
</div>
@endsection