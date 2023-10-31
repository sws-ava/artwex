@extends('layouts.admin')

@section('title', 'Добавить товар')

@section('content')
					
	{!! Form::open(['route' => 'product.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
	@include('admin.product._form')
	{!! Form::close() !!}
                    
@endsection

@section('page-script')
  @include('plugins.dropzone-upload')
@endsection