@extends('layouts.admin')

@section('title', 'Редактирование товары')

@section('content')

	{!! Form::model($product, ['route' => ['product.update', $product->id], 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
	@include('admin.product._form')

	{!! Form::close() !!}
					  
@endsection

@section('page-script')
  @include('plugins.dropzone-upload')
@endsection
