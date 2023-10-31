@extends('layouts.master')

@section('content')
    <div class="cover">
        <h2>@lang('about.about_us')</h2>
    </div>

    <div class="order-of-art">
        <div class="container-fluid">
            <div class="about-of-art">
                <div class="row">
					<div class="col-12 col-md-6">
						<h2>@lang('about.header1')</h2>
						@lang('about.p1')
					</div>
					<div class="col-12 col-md-6">
						<img src="img/about/photo1.jpg" alt="">
					</div>
                </div>
            </div>
            <div class="about-of-art">
                <div class="row">
                <div class="col-12 col-md-6">
                    <img src="img/about/photo2.jpg" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h2>@lang('about.header2')</h2>
                    @lang('about.p2')
                </div>
                </div>
            </div>
            <div class="about-of-art">
                <div class="row">
                <div class="col-12 col-md-6">
                    <h2>@lang('about.header3')</h2>
                    @lang('about.p3')
                </div>
                <div class="col-12 col-md-6">
                    <img src="img/about/photo3.jpg" alt="">
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cover-2">
        <div class="container-fluid">
            <div class="row">
                <h2>@lang('about.header4')</h2>
                <div class="cover-2-text">
                    @lang('about.p4')
                </div>
            </div>
        </div>
    </div>
    
    <div class="altogether">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 altogether-text">
                    <div><img src="img/ci_double-quotes-l.svg" alt=""></div>
                    @lang('about.p5')
                </div>
                <div class="col altogether-am">
                    <h3>1200+</h3>
                    <p>@lang('about.p6')</p>
                </div>
                <div class="col altogether-am">
                    <h3>96+</h3>
                    <p>@lang('about.p7')</p>
                </div>
                <div class="col altogether-am">
                    <h3>124</h3>
                    <p>@lang('about.p8')</p>
                </div>
            </div>
        </div>
    </div>
@endsection