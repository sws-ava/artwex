				<!-- <div class="filter text-center">@lang('filter.filter_header')</div> -->
				
				<div class="accordion filters" id="filterAccordion">
					<div class="clear-filter-mobile-holder">
						<button class="btn-reset clear-filter clear-filter-mobile">@lang('filter.reset_filters')</button>
						<div class="close-mobile-filter" onClick="showFilterHandler()">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.2196 16.631L9.54708 9.00024L17.1794 1.32578C17.33 1.17441 17.3294 0.929655 17.1781 0.779063C17.0267 0.62847 16.7819 0.62905 16.6314 0.780416L9.00056 8.45372L1.32687 0.821385C1.17551 0.670793 0.930754 0.671373 0.780162 0.822738C0.629569 0.974103 0.630149 1.21886 0.781514 1.36945L8.45405 9.00024L0.822484 16.6739C0.671891 16.8253 0.672471 17.0701 0.823837 17.2206C0.975202 17.3712 1.21996 17.3707 1.37055 17.2193L9.00056 9.54676L16.6727 17.1791C16.8241 17.3297 17.0688 17.3291 17.2194 17.1777C17.37 17.0264 17.3694 16.7816 17.2181 16.631H17.2196Z" fill="black"/>
							</svg>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingCat">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCat" aria-expanded="true" aria-controls="collapseCat">
							@lang('filter.category')
						  </button>
						</h2>
						<div id="collapseCat" class="accordion-collapse collapse" aria-labelledby="headingCat" data-bs-parent="#filterAccordion">
							<div class="accordionBody">
								@foreach ($all_categories as $cat)
									<div class="filter-item">
										<a href="{{ route('shop', $cat->slug) }}">{{ $cat->name }}</a>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					  {{-- Attribute --}}
					  @if (isset($category->attrsList))
						@foreach ($category->attrsList as $attribute)
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingAttr{{ $attribute->id }}">
							<button class="accordion-button
							@if (!$attribute->attributeValues->first() && !Request::has('attribute.' . $attribute->attributeValues->first()->id))
							collapsed
						  @endif
							" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAttr{{ $attribute->id }}" aria-expanded="false" aria-controls="collapseAttr{{ $attribute->id }}">
						  {{ $attribute->name }}

						  <!-- @if ($attribute->attributeValues->first() && Request::has('attribute.' . $attribute->attributeValues->first()->id))
							<a href="javascript::void(0)" data-name="attribute[{{ $attribute->attributeValues->first()->id }}]" class="clear-filter small text-lowercase pull-right">@lang('filter.result_clear')</a>
						  @endif -->
						  
						  </button>
						</h2>
						<div id="collapseAttr{{ $attribute->id }}" class="accordion-collapse collapse
						@if ($attribute->attributeValues->first() && Request::has('attribute.' . $attribute->attributeValues->first()->id))
							show
						  @endif
						
						" aria-labelledby="headingAttr{{ $attribute->id }}" data-bs-parent="#filterAccordion">
							<div class="accordionBody">
							@foreach ($attribute->attributeValues as $attributeValue)
							  <div class="checkbox">
								<label class="filter-custom-label">
								  <input 
								  	type="checkbox" 
									value="{{ $attribute->id }}" 
									name="attribute[{{ $attributeValue->id }}]" 
									class="i-check filter_opt_checkbox filter-real-checkbox" 
									{{ Request::has('attribute.' . $attributeValue->id) ? 'checked' : '' }}
									>
									 {{ \Str::title(\Str::limit($attributeValue->value, 30)) }}
									<div class="filter-custom-checkbox">
										@if(Request::has('attribute.' . $attributeValue->id))
											<div class="filter-custom-checkbox-has"></div>
										@endif
									</div>
								</label>
							  </div>
							  <!-- <div class="checkbox">
								<label>
								  <input type="checkbox" value="{{ $attribute->id }}" name="attribute[{{ $attributeValue->id }}]" class="i-check filter_opt_checkbox" {{ Request::has('attribute.' . $attributeValue->id) ? 'checked' : '' }}> {{ \Str::title(\Str::limit($attributeValue->value, 30)) }}
								</label>
							  </div> -->
							@endforeach
							</div>
						</div>
					</div>
						@endforeach
					  @endif
					  {{--<div class="accordion-item">
						<h2 class="accordion-header" id="headingType">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseType" aria-expanded="false" aria-controls="collapseType">
							@lang('filter.paint_type')
						  </button>
						</h2>
						<div id="collapseType" class="accordion-collapse collapse" aria-labelledby="headingType" data-bs-parent="#filterAccordion">
							<div class="accordionBody">
							
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingStyle">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStyle" aria-expanded="false" aria-controls="collapseStyle">
							@lang('filter.style')
						  </button>
						</h2>
						<div id="collapseStyle" class="accordion-collapse collapse" aria-labelledby="headingStyle" data-bs-parent="#filterAccordion">
							<div class="accordionBody">
							
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOr">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOr" aria-expanded="false" aria-controls="collapseOr">
							@lang('filter.orientation')
						  </button>
						</h2>
						<div id="collapseOr" class="accordion-collapse collapse" aria-labelledby="headingOr" data-bs-parent="#filterAccordion">
							<div class="accordionBody">
							
							</div>
						</div>
					  </div>--}}
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingPrice">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
							@lang('filter.price') 
						  </button>
						  <!-- @if(Request::has('price'))
								<a href="#" data-name="price" class="clear-filter small text-lowercase pull-right">@lang('filter.result_clear')</a>
							@endif -->
						</h2>
						<div id="collapsePrice" class="accordion-collapse collapse" aria-labelledby="headingPrice" data-bs-parent="#filterAccordion">
							<div class="accordionBody">
								<input type="text" id="price-slider" />
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingSearch">
						  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
							@lang('filter.search_by_words')
						  </button>
						</h2>
						<div id="collapseSearch" class="accordion-collapse collapse" aria-labelledby="headingSearch" data-bs-parent="#filterAccordion">
							<div class="accordionBody search-word">
								{!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-header-form', 'class' => '', 'role' => 'search']) !!}
								<input class="search-word-input" type="text" name="query" placeholder="@lang('filter.search')" value=""/>
								<button class="search-word-submit" type="submit">
									<img src="/img/search.svg" alt="">
								</button>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
                </div>
                <button class="btn btn-reset clear-filter">@lang('filter.reset_filters')</button>