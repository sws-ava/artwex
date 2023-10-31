@extends('layouts.admin')

@section('title', 'Добавить художника')

@section('content')
    	{!! Form::open(['route' => 'shop.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	       @include('admin.shop._form')
            <div class="text-center">{!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-success btn-new']) !!}</div>
        {!! Form::close() !!}
@endsection