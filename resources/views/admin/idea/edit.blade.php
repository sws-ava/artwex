@extends('layouts.admin')

@section('title', 'Редактирование идеи')

@section('content')
		{!! Form::model($idea, ['method' => 'PUT', 'route' => ['idea.update', $idea->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            @include('admin.idea._form')
            {!! Form::submit('Сохранить', ['class' => 'btn btn-success btn-new']) !!}
        {!! Form::close() !!}	
@endsection