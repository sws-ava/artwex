    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить вопрос</h1>
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
                        <!-- form start -->
<div class="row">
  <div class="col-sm-12 col-md-6 nopadding-right">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('question', 'Вопрос* '.$lang->language_name) !!}
      {!! Form::text('question['.$lang->slug.']', (isset($faq) ? $faq->getTranslation('question', $lang->slug) : null), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>
  <div class="col-sm-12 col-md-6 nopadding-left">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('answer', 'Ответ* '.$lang->language_name) !!}
      {!! Form::text('answer['.$lang->slug.']', (isset($faq) ? $faq->getTranslation('answer', $lang->slug) : null), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>  
  <div class="col-sm-12">
    <div class="form-group">
      {!! Form::label('hide', 'Скрыть*') !!}
      {!! Form::select('hide', ['1' => 'Скрыть', '0' => 'Отобразить'], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('form.required_fields') }}</p>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

