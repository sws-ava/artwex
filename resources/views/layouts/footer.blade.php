    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer_logo"><img src="/img/artwex_logo.svg" style="width:100px;"></div>
					<div class="footer_social">@lang('footer.follow_us') <a href=""><img src="/img/icons/facebook-f.svg" alt="" /></a><a href=""><img src="/img/icons/instagram.svg" alt="" /></a><a href=""><img src="/img/icons/pinterest-p.svg" alt="" /></a></div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <h5>@lang('footer.settings')</h5>
                    <ul>
                        <li>@lang('footer.country'): Україна</li>
                        <li>@lang('footer.language'): Українська</li>
                        <li>@lang('footer.currency'): ГРН</li>
                        <li>@lang('footer.units'): СМ</li>
						@foreach ($pages->where('position', 'footer_1st_column') as $page)
                        <li>
                          <a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">
                            {{ $page->title }}
                          </a>
                        </li>						
						@endforeach
                    </ul>
                    <button type="button" class="btn-change" data-bs-toggle="modal" data-bs-target="#footerModal">@lang('footer.change_settings')</button>                 
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <h5>@lang('footer.for_client')</h5>
                    <ul>
                        <li><a href="@if (Auth::check()){{ route('profile') }}@else{{ route('login') }}@endif">@lang('footer.my_profile')</a></li>
                        <li><a href="{{ route('contact') }}">@lang('footer.contactus')</a></li>
                        <li><a href="{{ route('order_art') }}">@lang('footer.orderart')</a></li>
						@foreach ($pages->where('position', 'footer_2nd_column') as $page)
                        <li>
                          <a href="{{ get_page_url($page->slug) }}" target="_blank">
                            {{ $page->title }}
                          </a>
                        </li>
						@endforeach
                    </ul>                   
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <h5>@lang('footer.who_we_are')?</h5>
                    <ul>
                        <li><a href="{{ route('about') }}">@lang('footer.aboutus')</a></li>
                        <li><a href="{{ route('inspiration') }}">@lang('footer.inspir')</a></li>
						@foreach ($all_categories as $category)
                        <li><a href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a></li>
						@endforeach
                        <li><a href="{{ route('artists') }}">@lang('footer.allartists')</a></li>
                        <li><a href="{{ route('contact') }}">@lang('footer.contacts')</a></li>
                        <li><a href="{{ route('order_art') }}">FAQ</a></li>
						@foreach ($pages->where('position', 'footer_3rd_column') as $page)
                        <li>
                          <a href="{{ get_page_url($page->slug) }}" target="_blank">
                            {{ $page->title }}
                          </a>
                        </li>
						@endforeach
                    </ul>                   
                </div>
            </div>
			<div class="footer_line"></div>
			<div class="row">
				<div class="col-12 col-sm-6">
					<div class="footer_logos">
						<img src="/img/visa_logo.svg" alt="" />
						<img src="/img/mastercard_logo.svg" alt="" />
						<img src="/img/AmEx_logo.svg" alt="" />
						<img src="/img/Paypal_logo.svg" alt="" />
						<img src="/img/bitcoin_logo.svg" alt="" />
						<img src="/img/ethereum_logo.svg" alt="" />
					</div>
			   </div>              
			   <div class="col-12 col-sm-3">
				<div class="footer-links">
					@foreach ($pages->where('position', 'copyright_area') as $page)
						<a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">{{ $page->title }}</a> | 
					@endforeach
					<a href="">@lang('footer.sitemap')</a>
				</div>
			   </div>
			   <div class="col-12 col-sm-3">
				<div class="footer_copy">&copy; {{date('Y')}} ARTWEX</div>
				</div>
			</div>
        </div>
    </footer>
	
	<div class="modal fade" id="footerModal" tabindex="-1" aria-labelledby="footerModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title-custom" id="footerModalLabel">
					@lang('footer.settings')
				</h1>
				<button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- <p>@lang('footer.enter_data')</p> -->
				<form>
					<div class="mb-3">
						<label class="modalLabel" for="footerCountry">@lang('footer.country')</label>
						<select class="modalSelect" name="footerCountry">
							@foreach ($footer_countries as $footer_country)
							<option value="{{ $footer_country->id }}">{{ $footer_country->name }}</option>
							@endforeach
						</select>
					</div>					
					<div class="mb-3">
						<label class="modalLabel" for="footerLanguage">@lang('footer.language')</label>
						<select class="modalSelect" name="footerLanguage">
							@foreach ($footer_languages as $footer_language)
							<option value="{{ $footer_language->id }}">{{ $footer_language->language_name }}</option>
							@endforeach
						</select>
					</div>					
					<div class="mb-3">
						<label class="modalLabel" for="footerCurrency">@lang('footer.currency')</label>
						<select class="modalSelect" name="footerCurrency">
							@foreach ($footer_currencies as $footer_currency)
							<option value="{{ $footer_currency->id }}">{{ $footer_currency->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-3">
						<label class="modalLabel" for="footerUnits">@lang('footer.units')</label>
						<select class="modalSelect" name="footerUnits">
							@foreach ($footer_units as $footer_unit)
							<option value="{{ $footer_unit->id }}">{{ $footer_unit->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-3">
						<button class="btn btn-website w-100">@lang('footer.modal_save')</button>
					</div>
				</form>
			</div>
		</div>
	  </div>
	</div>