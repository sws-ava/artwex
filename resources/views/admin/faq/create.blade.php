@extends('layouts.admin')

@section('title', 'Добавить вопрос')

@section('content')
    	{!! Form::open(['route' => 'faq.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	       @include('admin.faq._form')
            {!! Form::submit('Добавить', ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}
@endsection