@extends('layouts.admin')

@section('title', 'Редактировать значение')

@section('content')
    {!! Form::model($attributeValue, ['method' => 'PUT', 'route' => ['attributeValue.update', $attributeValue->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-body">
      @include('admin.attribute-value._form')
    </div>
    <div class="modal-footer">
      {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
@endsection
