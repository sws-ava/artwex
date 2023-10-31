@extends('layouts.master')

@section('content')
<div class="loginPage">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 mb-3">
				<div class="registr-text">РЕГИСТРАЦИЯ</div>
				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="row mb-3">
						<div class="col-12">
							<input id="name" type="text" class="form-control brandInput @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Имя" required autocomplete="name" autofocus>

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<input id="email" type="email" class="form-control brandInput @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Адрес электронной почты" required autocomplete="email">

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<input id="password" type="password" class="form-control brandInput @error('password') is-invalid @enderror" name="password" placeholder="Пароль" required autocomplete="new-password">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<input id="password-confirm" type="password" class="form-control brandInput" name="password_confirmation" placeholder="Повторите Пароль" required autocomplete="new-password">
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-12">
							<button type="submit" class="btn to-come-in">
								{{ __('Register') }}
							</button>
						</div>
					</div>
					<div class="roger">
                        <input type="checkbox" id="myCheck" onclick="myFunction()">
                        Я согласен на обработку персональных 
данных согласно Политике конфиденциальности
                    </div>
					<div class="row mb-0">
						<div class="col-12">
							<button class="google-but" type="submit">С ПОМОЩЬЮ GOOGLE</button>
						</div>
					</div>
					<div class="row mb-0">
						<div class="col-12">
							<button class="facebook-but" type="submit">С ПОМОЩЬЮ FACEBOOK</button> 
						</div>
					</div>
				</form>

			</div>
			<div class="col-12 col-md-6 mb-3 d-none d-lg-block">
				<img class="loginRegisterImg" src="/img/rectangle45.svg">
			</div>
		</div>
	</div>
</div>
@endsection
