@extends('layouts.admin')

@section('title', 'Добавить категорию')

@section('content')
    	{!! Form::open(['route' => 'category.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	       @include('admin.category._form')
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}
@endsection