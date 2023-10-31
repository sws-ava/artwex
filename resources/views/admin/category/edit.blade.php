@extends('layouts.admin')

@section('title', 'Редактирование категории')

@section('content')
		{!! Form::model($category, ['method' => 'PUT', 'route' => ['category.update', $category->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            @include('admin.category._form')
            {!! Form::submit('Сохранить', ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}	
@endsection