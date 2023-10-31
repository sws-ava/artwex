@extends('layouts.admin')

@section('title', 'Добавить слайд')

@section('content')
    	{!! Form::open(['route' => 'slider.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	       @include('admin.slider._form')
            {!! Form::submit('Добавить', ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}
@endsection