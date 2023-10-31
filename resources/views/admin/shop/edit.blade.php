@extends('layouts.admin')

@section('title', 'Редактирование художника')

@section('content')
		{!! Form::model($shop, ['method' => 'PUT', 'route' => ['shop.update', $shop->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            @include('admin.shop._form')
            {!! Form::submit('Сохранить', ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}	
@endsection