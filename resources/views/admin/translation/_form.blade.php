<div class="row">
  <div class="col-sm-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('group', trans('trans.group').'*', ['class' => 'with-help']) !!}
      {!! Form::text('group', null, ['class' => 'form-control', 'placeholder' => trans('trans.placeholder_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-sm-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('key', trans('trans.key').'*', ['class' => 'with-help']) !!}
      {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => trans('trans.placeholder_code'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="row">
	@foreach ($langs as $lang)
	<div class="col-sm-12 nopadding-left">
		<div class="form-group">
		  {!! Form::label('text', $lang.'*', ['class' => 'with-help']) !!}
		  {!! Form::text('text['.$lang.']', null, ['class' => 'form-control', 'placeholder' => trans('trans.placeholder_lang'), 'required']) !!}
		  <div class="help-block with-errors"></div>
		</div>
	</div>
	@endforeach
</div>
<p class="help-block">* {{ trans('form.required_fields') }}</p>