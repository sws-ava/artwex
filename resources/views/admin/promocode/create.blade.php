@extends('layouts.admin')

@section('title', 'Добавить промокод')

@section('content')
    	{!! Form::open(['route' => 'promocode.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	       @include('admin.promocode._form')
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}
@endsection