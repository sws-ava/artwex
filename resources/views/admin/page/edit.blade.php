@extends('layouts.admin')

@section('content')

			{!! Form::model($page, ['method' => 'PUT', 'route' => ['page.update', $page], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
				@include('admin.page._form')
				{!! Form::submit(trans('form.update'), ['class' => 'btn btn-success btn-new']) !!}
			{!! Form::close() !!}


@endsection
@section('scripts')

@endsection