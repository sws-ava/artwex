@extends('layouts.master')

@section('content')
    <div class="cover">
        <h2>@lang('orderart.order_header')</h2>
    </div>

    <div class="order-of-art">
        <div class="container-fluid">
            <div class="about-of-art">
                <div class="row">
                <div class="col-12 col-md-6">
                    <h2>@lang('orderart.header_1')</h2>
                    @lang('orderart.p_1')
                </div>
                <div class="col-12 col-md-6">
                    <img src="img/order/01.png" alt="">
                </div>
                </div>
            </div>
            <div class="about-of-art">
                <div class="row">
                <div class="col-12 col-md-6">
                    <img src="img/order/02.png" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h2>@lang('orderart.header_2')</h2>
                    @lang('orderart.p_2')
                </div>
                </div>
            </div>
            <div class="about-of-art">
                <div class="row">
                <div class="col-12 col-md-6">
                    <h2>@lang('orderart.header_3')</h2>
                    @lang('orderart.p_3')
                </div>
                <div class="col-12 col-md-6">
                    <img src="img/order/03.png" alt="">
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cover-2">
        <div class="container-fluid">
            <div class="row">
				<div class="col-12">
					<h2>@lang('orderart.header_4')</h2>
					<div class="cover-2-text">
						@lang('orderart.p_4')
					</div>
					<div class="m-3"><a href="#" class="btn btn-website" data-bs-toggle="modal" data-bs-target="#orderModal">@lang('orderart.order_button')</a></div>
				</div>
			</div>
        </div>
    </div>
    
    <div class="faq">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
					<h2 class="text-center">@lang('orderart.faq')</h2>
                    <div class="accordion" id="faqAccordion">
						@foreach ($faqs as $faq)
					  <div class="accordionItem">
						<div class="accordionHeader" id="heading{{ $faq->id }}">
						  <a class="accordionButton collapsed"
								type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" 
								aria-expanded="false"
								aria-controls="collapse{{ $faq->id }}">
							{{ $faq->question }}
							<div>
								<img src="/img/faq-cross.svg" alt="">
							</div>
						  </a>
						</div>
						<div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
						  <div class="accordionBody">
							{{ $faq->answer }}
						  </div>
						</div>
					  </div>
						@endforeach
					</div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade orderModal" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h1 class="modal-title" id="orderModalLabel">@lang('orderart.order_header')</h1>

				<p class="orderModal__desc">Заполните форму заявки и мы свяжемся с Вами для уточнения деталей заказа</p>
				<form>
					<div class="mb-3">
						<input type="text" name="name" class="modalInput" placeholder="Имя">
					</div>					
					<div class="mb-3">
						<input type="text" name="phone" class="modalInput" placeholder="Телефон">
					</div>					
					<div class="mb-3">
						<input type="email" name="email" class="modalInput" placeholder="Email">
					</div>
					<div class="mb-3">
						<textarea name="comment" class="modalInput" rows="3"></textarea>
					</div>
					<div class="mb-3">
						<button class="btn btn-website w-100">Отправить заявку</button>
					</div>
					<div class="mb-3">
						<label class="form-check-label" for="agreeCheck">
							<div class="customCheckBox-holder">
								<input type="checkbox" class="form-check-input" id="agreeCheck">
								<div class="customCheckBox">
									<img src="/img/custom-checkbox.svg" alt="">
								</div>
								<span>
									Я согласен на обработку персональных данных согласно 
									<a href="#">Политике конфиденциальности</a>
								</span>
							</div>
						</label>
					</div>
				</form>
			</div>
		</div>
	  </div>
	</div>



	<div class="mt-4 text-center" data-bs-toggle="modal" data-bs-target="#orderModal1">
		thnx modal
	</div>

	
	<div class="modal fade orderModal" id="orderModal1" tabindex="-1" aria-labelledby="orderModal1Label" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h1 class="modal-title" id="orderModa1lLabel">
					Спасибо за заявку!	
					<!-- @lang('orderart.order_header') -->
				</h1>
				<p class="orderModal__desc">
					Скоро мы вернемся свяжемся с Вами для уточнения деталей заказа
				</p>
				<div class="">
					<button class="btn btn-website thnx" data-bs-dismiss="modal" aria-label="Close">Закрыть</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
@endsection