@extends('layouts.admin')

@section('content')


    	{!! Form::open(['route' => 'page.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	        @include('admin.page._form')
            {!! Form::submit(trans('form.save'), ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}

@endsection
@section('scripts')

@endsection