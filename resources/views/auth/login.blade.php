@extends('layouts.master')

@section('content')
<div class="loginPage">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 mb-3">
				<div class="registr-text">@lang('login.sign_in')</div>
				<form method="POST" action="{{ route('login') }}">
					@csrf

					<div class="row mb-3">
						<div class="col-12">
							<input id="email" type="email" class="form-control brandInput @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<input id="password" type="password" class="form-control brandInput @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<div class="roger">
								<div>
									@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										@lang('login.forgot_pass')
									</a>
									@endif
								</div>
								<div>
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

									<label class="form-check-label" for="remember">
										@lang('login.remember')
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<button type="submit" class="btn to-come-in">
								@lang('login.enterlogin')
							</button>
						</div>
					</div>

					<div class="row mb-0">
						<div class="col-12">
							<button class="google-but" type="submit">@lang('login.with_google')</button>
						</div>
					</div>
					<div class="row mb-0">
						<div class="col-12">
							<button class="facebook-but" type="submit">@lang('login.with_facebook')</button> 
						</div>
					</div>
				</form>
			
			</div>
			<div class="col-12 col-md-6 mb-3 d-none d-lg-block">
				<img class="loginRegisterImg" src="/img/rectangle45.svg" alt="" style="width:100%;">
			</div>
		</div>
	</div>
</div>
@endsection
