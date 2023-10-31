@extends('layouts.master')

@section('content')
	<div class="connect-with-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="connect-our-contacts">
                        <h3>@lang('contact.header')</h3>
                        <h4>@lang('contact.phone')</h4>
                        <h5>+1-973-826-6970</h5>
                        <h4>@lang('contact.email')</h4>
                        <h5>example@art.com</h5>
                        <h4>@lang('contact.socials')</h4>
                        <div class="socs">
                            <a href="" target="_blank"><img src="img/instl.svg" alt=""></a>
                            <a href="" target="_blank"><img src="img/fbl.svg" alt=""></a>
                            <a href="" target="_blank"><img src="img/tvitl.svg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <div class="ask-a-question">
                        <h2>@lang('contact.answer_que')</h2>
                        <div class="mb-2">
                            <label for="titleContact" class="form-label"></label>
                            <input type="text" name="title" class="brandInput" id="titleContact" placeholder="@lang('contact.your_name')">
                        </div>
                        <div class="mb-2">
                            <label for="emailContact" class="form-label"></label>
                            <input type="email" name="email" class="brandInput" id="emailContact" placeholder="@lang('contact.your_email')">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label"></label>
                            <textarea class="brandTextArea" name="question" id="exampleFormControlTextarea1" rows="3" placeholder="@lang('contact.your_que')"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">@lang('contact.agree') <a href="" class="default-link underline">@lang('contact.privacy_policy')</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-website w-100">@lang('contact.send')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection