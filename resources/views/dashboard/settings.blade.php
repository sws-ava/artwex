@extends('layouts.master')

@section('content')
<main class="profile_page">
    <div class="cover">			  
		@if (!empty($user->image_cover))
			<img class="cover-img" src="/storage/{{ str_replace('public/', '', $user->image_cover)}}">
		@endif
        <div class="button-cov">
              <nav class="but-t"><img src="/img/iconscam.svg" alt=""></nav>
				<a id="upload_cover" class="upload-cover" href="#">@lang('profile.change_cover')</a>
				<input type="file" id="upload_cover_input">
        </div>
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
				<div class="main-headline  main-headline-cab">@lang('profile.account_settings')</div>
				<div class="settingsInfo">
					<ul class="nav mb-3" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<div class="nav-link active" id="regional-tab" data-bs-toggle="tab" data-bs-target="#regional-tab-pane" type="button" role="tab" aria-controls="regional-tab-pane" aria-selected="true">@lang('profile.settings_tab_regional')</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">@lang('profile.settings_tab_main_info')</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane" type="button" role="tab" aria-controls="login-tab-pane" aria-selected="false">@lang('profile.settings_tab_social')</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link" id="passw-tab" data-bs-toggle="tab" data-bs-target="#passw-tab-pane" type="button" role="tab" aria-controls="passw-tab-pane" aria-selected="false">@lang('profile.settings_tab_password')</div>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade fade show active" id="regional-tab-pane" role="tabpanel" aria-labelledby="regional-tab" tabindex="0">
							<div class="reg-set">
								<form action="{{ route('profile.edit.submit') }}" method="POST">
									@csrf
									<div class="mb-4 row align-items-center">
                                        <label for="profileName" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('footer.country')</label>
                                        <div class="col-12 col-sm-8 col-md-5 col-lg-5">
											<select id="profileCountry" name="country_id" class="brandInput">
												<option value="0">@lang('profile.settings_placecountry')</option>
											@foreach ($countries as $country)
												<option value="{{ $country->id }}"
													@if ($user->country_id == $country->id)
														selected="selected"
													@endif
												>{{ $country->name }}</option>
											@endforeach
											</select>
                                        </div>
                                    </div>									
									<div class="mb-4 row align-items-center">
                                        <label for="profileLang" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('footer.language')</label>
                                        <div class="col-12 col-sm-8 col-md-5 col-lg-5">
											<select id="profileLang" name="language_id" class="brandInput">
												<option value="0">@lang('profile.settings_placelanguage')</option>
												@foreach ($languages as $language)
													<option value="{{ $language->id }}"
														@if ($user->language_id == $language->id)
															selected="selected"
														@endif
													>{{ $language->language_name }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>									
									<div class="mb-4 row align-items-center">
                                        <label for="profileCurrency" class="col-12 offset-0m-1 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('footer.currency')</label>
                                        <div class="col-12 col-sm-8 col-md-5 col-lg-5">
											<select id="profileCurrency" name="currency_id" class="brandInput">
												<option value="0">@lang('profile.settings_placecurrency')</option>
											@foreach ($currencies as $currency)
												<option value="{{ $currency->id }}"
													@if ($user->currency_id == $currency->id)
														selected="selected"
													@endif
												>{{ $currency->name }} ({{ $currency->symbol }})</option>
											@endforeach
											</select>
                                        </div>
                                    </div>									
									<div class="mb-4 row align-items-center">
                                        <label for="profileUnits" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('footer.units')</label>
                                        <div class="col-12 col-sm-8 col-md-5  col-lg-5">
                                            <input id="profileUnits" name="units" type="text" class="brandInput" value="" placeholder="@lang('profile.settings_placeunits')">
                                        </div>
                                    </div>
									<div class="mb-4 row align-items-center">
										<div class="col-12 offset-md-2 col-md-8 offset-lg-5 offset-xl-4 col-lg-5">
											<button type="submit" class="btn btn-website w-100">
												@lang('profile.settings_save')
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
							<div class="gen-information">
                                <div class="inf-name mb-4">@lang('profile.settings_main_info')</div>
                                <form action="{{ route('profile.edit.submit') }}" method="POST" enctype="multipart/form-data">
									@csrf 
                                    <div class="mb-4 row align-items-center">
                                        <label for="profileName" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.settings_name')</label>
                                        <div class="col-12 col-sm-8 col-md-5  col-lg-5">
                                            <input id="profileName" name="name" type="text" class="brandInput" value="{{ $user->name }}" placeholder="@lang('profile.settings_placename')">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label for="profileLastname" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.settings_lastname')</label>
                                        <div class="col-12 col-sm-8 col-md-5  col-lg-5">
                                            <input id="profileLastname" name="last_name" type="text" class="brandInput" value="{{ $user->last_name }}" placeholder="@lang('profile.settings_placelastname')">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label for="profileLogin" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.settings_login')</label>
                                        <div class="col-12 col-sm-8 col-md-5  col-lg-5">
                                            <input id="profileLogin" name="login" type="text" class="brandInput" value="{{ $user->login }}" placeholder="@lang('profile.settings_placelogin')">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label for="profileAvatar" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.settings_avatar')</label>
                                        <div class="col-12 col-sm-8 col-md-5  col-lg-5">
                                            <input id="profileAvatar" name="avatar_image" type="file" class="brandInput" value="">
                                        </div>
                                    </div>
                                    <div class="mb-4 row justify-content-center">
										<div class="col-12 offset-md-0 col-md-8 offset-lg-3 offset-xl-1 col-lg-5">
											<button type="submit"  class="btn btn-website w-100 save" >@lang('profile.settings_save')</button>
										</div>
                                    </div>
                                </form>
							</div>
						</div>						
						<div class="tab-pane fade" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
							<div class="login-det">
								<form action="" method="POST" enctype="multipart/form-data">
									@csrf 
									<div class="inf-name mb-4">@lang('profile.settings_enter')</div>
									<div class="mb-4 row align-items-center">
										<label for="profileEmail" class="col-sm-12 col-md-4 col-lg-4 mb-2">E-mail</label>
										<div class="col-sm-12 col-md-4 col-lg-4 mb-2">
											<input id="profileEmail" type="text" class="brandInput" value="" placeholder="">
										</div>
										<div class="col-sm-12 col-md-4 col-lg-4 mb-2">
											<button class="change">@lang('profile.settings_change')</button>
										</div>
									</div>
									<div class="mb-4 row align-items-center">
										<div class="col-sm-12 col-md-4 text-center text-md-start"><h3>@lang('profile.settings_status')</h3></div>
										<div class="col-sm-12 col-md-4 text-center text-md-start">
											<h4>@lang('profile.settings_noaccept')</h4>
										</div>
										<div class="col-sm-12 col-md-4 text-center text-md-start">
											<button class="confirm">@lang('profile.settings_accept')</button>
										</div>
									</div>
								</form>
							</div>
							<hr style="color: #A9A9C1; margin: 50px 0;">
							<div class="con-soc-networks">
							    <div class="">
									<div class="inf-name mb-4 mt-4">@lang('profile.settings_social')</div>
									<div class="mb-4 row align-items-center">
										<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
											<button class="but-facebook"><img src="/img/fb-logo.svg" alt=""> Facebook</button>
										</div>
										<div class="col-sm-12 col-md-5 col-lg-4  text-center text-md-start mb-4">
											<h4>@lang('profile.settings_noaccept')</h4>
										</div>
									</div>
								</div>
							</div>
						</div>						
						<div class="tab-pane fade" id="passw-tab-pane" role="tabpanel" aria-labelledby="passw-tab" tabindex="0">
							<form method="POST" action="{{ route('profile.updatepassword') }}">
								@csrf 
		   
								 @foreach ($errors->all() as $error)
									<p class="text-danger">{{ $error }}</p>
								 @endforeach 
		  
								<div class="mb-4 row align-items-center">
									<label for="password" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.current_password')</label>
		  
									<div class="col-12 col-sm-8 col-md-5  col-lg-5">
										<input id="password" type="password" class="brandInput" name="current_password" autocomplete="current-password">
									</div>
								</div>
		  
								<div class="mb-4 row align-items-center">
									<label for="password" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.password')</label>
		  
									<div class="col-12 col-sm-8 col-md-5  col-lg-5">
										<input id="new_password" type="password" class="brandInput" name="password" autocomplete="current-password">
									</div>
								</div>
		  
								<div class="mb-4 row align-items-center">
									<label for="password" class="col-12 offset-sm-0 col-sm-4 col-md-3 offset-md-2 offset-lg-2 col-lg-3 offset-xl-0 col-xl-4 colFormLabel">@lang('profile.confirm_password')</label>
			
									<div class="col-12 col-sm-8 col-md-5  col-lg-5">
										<input id="new_confirm_password" type="password" class="brandInput" name="password_confirmation" autocomplete="current-password">
									</div>
								</div>
		   
								<div class="mb-4 row align-items-center">
									<div class="col-12 offset-md-2 col-md-8 offset-lg-5 offset-xl-4 col-lg-5">
										<button type="submit" class="btn btn-website w-100">
											@lang('profile.settings_save')
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="coverModal" tabindex="-1" aria-labelledby="coverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="coverModalLabel">Upload Cover</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="upload-cover" style="width:350px"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-success upload-result-cover">Upload</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<style>
#upload_cover_input, #upload_avatar_input {
    display:none
}
.profile_page .cover {
	padding-top: 0;
	padding-left: 0;
	padding:0;
}
</style>
  <script src="/js/croppie.js"></script>
  <link rel="stylesheet" href="/css/croppie.css">
<script>
	$(document).ready(function() {
		
		$.ajaxSetup ({
		    cache: false,
		    headers: {
		        'X-CSRF-TOKEN': "{{ csrf_token() }}"
		    }
	  	});
		
		var myModal = new bootstrap.Modal(document.getElementById('coverModal'), {
		  keyboard: false
		})

		$('#upload_cover_input:hidden').on('change', function () { 
			myModal.show();
			
			var reader = new FileReader();
			reader.onload = function (e) {
				$uploadCropCover.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(this.files[0]);
		});
		
		$uploadCropCover = $('#upload-cover').croppie({
			enableExif: true,
			viewport: { width: 300, height: 35 }
		});		
		
		$('.upload-result-cover').on('click', function (ev) {
			$uploadCropCover.croppie('result', {
				type: 'canvas',
				size: 'original'
			}).then(function (resp) {
				var fd = new FormData(); 
				fd.append('cover_image', dataURLtoFile(resp,'cover.jpg')); 			
				fd.append('model_id', {{$user->id}});
				fd.append('model_name', 'App\Models\User');
				$.ajax({
					url: "{{ route('image.upload.cover') }}",
					type: 'POST',
					datatype: "json",
					data: fd,
					processData: false,
					contentType: false,
				}).done(function(result) {
					window.location.reload();
				});
			});
		});
		$("#upload_cover").on('click', function(e){
			e.preventDefault();
			$("#upload_cover_input:hidden").trigger('click');
		});
		function dataURLtoFile(dataurl, filename) {
			var arr = dataurl.split(','),
				mime = arr[0].match(/:(.*?);/)[1],
				bstr = atob(arr[1]), 
				n = bstr.length, 
				u8arr = new Uint8Array(n);
			while(n--){
				u8arr[n] = bstr.charCodeAt(n);
			}
			return new File([u8arr], filename, {type:mime});
		}
	 });
</script>	 
@endsection