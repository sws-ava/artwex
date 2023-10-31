@extends('layouts.admin')

@section('title', 'Добавить атрибут')

@section('content')
    {!! Form::open(['route' => 'attribute.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-body">

      @include('admin.attribute._form')

    </div>
    <div class="modal-footer">
      {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
@endsection