    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить художника</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
				<div class="card card-primary">
				<div class="card-body">
<div class="row">
  <div class="col-md-6 nopadding-right">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('name', 'Имя* '.$lang->language_name) !!}
      {!! Form::text('name['.$lang->slug.']', (isset($shop) ? $shop->getTranslation('name', $lang->slug) : null), ['class' => 'form-control makeSlug', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach	
  </div>
  <div class="col-md-6 nopadding-left">
  	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('last_name', 'Фамилия* '.$lang->language_name) !!}
      {!! Form::text('last_name['.$lang->slug.']', (isset($shop) ? $shop->getTranslation('last_name', $lang->slug) : null), ['class' => 'form-control makeSlug', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>
</div>
</div>
</div>
<div class="card card-primary">
<div class="card-body">
	@foreach ($languages as $lang)
<div class="form-group">
  {!! Form::label('description', 'Описание'.$lang->language_name, ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.category_desc') }}"></i>
  {!! Form::textarea('description['.$lang->slug.']', (isset($shop) ? $shop->getTranslation('description', $lang->slug) : null), ['class' => 'form-control summernote-long', 'placeholder' => 'Введите описание художника', 'rows' => '5']) !!}
</div>
	@endforeach
</div>
</div>

<div class="card card-primary">
<div class="card-body">
				<div class="form-group">
					{!! Form::label('image_avatar', 'Изображение Аватар') !!}
					{!! Form::file('image_avatar', null, ['class' => 'form-control', 'required']) !!}
				  <div class="help-block with-errors"></div>
				</div>				
				<div class="form-group">
					{!! Form::label('image_avatar', 'Изображение Постер') !!}
					{!! Form::file('image_cover', null, ['class' => 'form-control', 'required']) !!}
				  <div class="help-block with-errors"></div>
				</div>
			    <div class="form-group">
					{!! Form::label('country_id', trans('app.form.country') . '*') !!}
					{!! Form::select('country_id', $countries, null, ['class' => 'form-control select2-normal', 'required']) !!}
					<div class="help-block with-errors"></div>
				</div>
<div class="form-group">
  {!! Form::label('slug', 'Урл*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Урл"></i>
  {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'Введите ФИО художника латиницей, где пробелы ставьте символ _', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
    <div class="form-group">
      {!! Form::label('active', 'Статус*') !!}
      {!! Form::select('active', ['1' => 'Активный', '0' => 'Не активный'], null, ['class' => 'form-control select2-normal', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
<div class="form-group">
  {!! Form::label('position', 'Позиция*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Урл"></i>
  {!! Form::text('position', 9999, ['class' => 'form-control position', 'placeholder' => 'Введите позицию художника в общем списке', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

</div>
</div>

<p class="help-block">* Обязательные поля</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

