@extends('layouts.admin')

@section('title', 'Редактирование вопрос')

@section('content')
		{!! Form::model($faq, ['method' => 'PUT', 'route' => ['faq.update', $faq->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            @include('admin.faq._form')
            {!! Form::submit('Сохранить', ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}	
@endsection