@extends('layouts.master')

@section('content')
<style>
.page404 {
	background: url('/img/bg404.jpg') no-repeat;
    background-size: contain;
    min-height: 100vh;
    background-position: center;
	display: flex;
    justify-content: center;
    align-items: center;
}
.inner404 {
	text-align: center;
}
.inner404 img {
	width: 100%;
}
</style>
    <div class="page404">
		<div class="inner404">
			<img src="/img/text404.svg">
			<p>@lang('404.notfound')</p>
			<a href="/" class="btn btn-website">@lang('404.button_text')</a>
		</div>
	</div>
@endsection