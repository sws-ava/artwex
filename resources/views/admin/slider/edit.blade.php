@extends('layouts.admin')

@section('title', 'Редактирование слайда')

@section('content')
		{!! Form::model($slider, ['method' => 'PUT', 'route' => ['slider.update', $slider->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            @include('admin.slider._form')
            {!! Form::submit('Сохранить', ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}	
@endsection