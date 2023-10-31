@extends('layouts.admin')

@section('content')

 <div class="d-flex fullscreen-page">
    <div class="add-item-page fullscreen-block">
		<div class="title-block">
			<h2></h2>
		</div>
		<div class="form-block">
    	{!! Form::open(['route' => 'translation.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
	        @include('admin.translation._form')
            {!! Form::submit(trans('form.save'), ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}
		</div>
	</div>
</div>

@endsection
@section('scripts')

@endsection