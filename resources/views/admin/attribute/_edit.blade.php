@extends('layouts.admin')

@section('title', 'Редактировать атрибут')

@section('content')
    {!! Form::model($attribute, ['method' => 'PUT', 'route' => ['admin.catalog.attribute.update', $attribute->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-body">

      @include('admin.attribute._form')

    </div>
    <div class="modal-footer">
      {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
@endsection
