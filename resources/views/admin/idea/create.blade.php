@extends('layouts.admin')

@section('title', 'Добавить идею')

@section('content')
    	{!! Form::open(['route' => 'idea.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	       @include('admin.idea._form')
            {!! Form::submit('Добавить', ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}
@endsection