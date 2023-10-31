@extends('layouts.admin')

@section('title', 'Добавить значение')

@section('content')
    {!! Form::open(['route' => 'attributeValue.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-body">

      @include('admin.attribute-value._form')

    </div>
    <div class="modal-footer">
      {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
@endsection
