@extends('layouts.master')

@section('content')
    <div class="cover">
		<h6><a href="{{ route('homepage') }}">@lang('other.main')</a> / <a href="{{ route('cart') }}">@lang('cart.cartheader')</a> / @lang('checkout.checkoutheader')</h6>
        <h2>@lang('checkout.checkoutheader')</h2>
    </div>
	
	<div class="checkout">
        <div class="container-fluid">
			@if ($messageErrorPromocode)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>{{ $messageErrorPromocode }}</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" area-label="Close"></button>
			</div>
			@endif
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-8">
                    <div class="ad">
                        <h3>@lang('checkout.delivery_address')</h3>
                    </div>
					<div class="row">
						<div class="col-12 col-md-6">
							<input type="text" id="fn" name="firstname" placeholder="@lang('checkout.name')*">
							<input type="text" id="fname" name="lastname" placeholder="@lang('checkout.lastname')*">
						</div>
						<div class="col-12 col-md-6">
							<input type="text" id="fn" name="phone" placeholder="@lang('checkout.phonenumber')*">
							<input type="text" id="fname" name="email" placeholder="@lang('checkout.checkoutemail')*">
						</div>
					</div>
                    <div class="line-1"><hr></div>
					<div class="row">
						<div class="col-12 col-md-6">
							<input type="text" id="fn" name="country" placeholder="@lang('checkout.country')*">
							<input type="text" id="fname" name="region" placeholder="@lang('checkout.region')*">
						</div>
						<div class="col-12 col-md-6">
							<input type="text" id="fn" name="city" placeholder="@lang('checkout.city')*">
							<input type="text" id="fname" name="zipcode" placeholder="@lang('checkout.zipcode')*">
						</div>
                    </div>
					<div class="row">
						<div class="col-12">
							<input type="text" id="address" name="address" placeholder="@lang('checkout.address')*">
						</div>
                    </div>
                    <div>
                        <h3>@lang('checkout.address_bill')</h3>
                    </div>
                    <div class="avs">
                        <label for="myCheck">
                            <input class="avs__input" type="checkbox" id="myCheck">
                            @lang('checkout.explain')
                        </label>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4">
                    <div class="total">
                        <div class="total-h">
                            <h2>@lang('cart.summary')</h2>
                        </div>
                        <div class="total-hh">
                            <h3>@lang('cart.subtotal')</h3><span class="amount">${{ $subTotal }}</span>
                        </div>
                        <div class="total-hh">
                            <h3>@lang('checkout.delivery_amount')</h3><span class="amount">$0</span>
                        </div>
                        <div class="total-hh">
                            <h3>@lang('checkout.sale')</h3><span class="amount">@if ($is_promocode)${{ $conditionCalculatedValue }}@else $0 @endif</span>
                        </div>
                        <div class="line-2"><hr></div>
                        <div class="total-hh">
                            <h3>@lang('checkout.total')</h3><span class="amount">@if ($is_promocode)${{ $subTotal - $conditionCalculatedValue }}@else $0 @endif</span>
                        </div>
						@if ($is_promocode)
                        <div class="prom-kod">
                            <h4>@lang('checkout.apply_promocode'): {{ $promocode->promocode }}</h4>
                            <h5>@lang('checkout.sale_goods') {{ $promocode->sale }}%</h5>
                        </div>
						@else
						<form action="{{ route('set_promocode') }}" method="post" class="promocode-form">
							@csrf
                            <input class="inp" id="inp" type="text" name="promocode" placeholder="@lang('cart.cartpromocode')">
                            <button class="but" type="submit">@lang('cart.apply')</button>
                        </form>
						@endif
                        <a class="checkout_btn" type="submit">@lang('checkout.gotopay')</a>
                        <!-- <button class="kript" type="submit"><img src="/img/iconsbtc.svg" alt="">@lang('checkout.pay_crypto')</button> -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection