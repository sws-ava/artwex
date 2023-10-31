@extends('layouts.admin')

@section('title', 'Редактирование промокода')

@section('content')
		{!! Form::model($promocode, ['method' => 'PUT', 'route' => ['promocode.update', $promocode->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            @include('admin.promocode._form')
            {!! Form::submit('Сохранить', ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}	
@endsection