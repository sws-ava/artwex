    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить категорию</h1>
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
                        <div class="form-group">
  {!! Form::label('parent_id', trans('form.category_sub').'*') !!}
  {!! Form::select('parent_id', array_merge(['0' => 'Нет родителя'], \App\Models\Category::select('id', 'name')->pluck('name', 'id')->toArray()), null, ['class' => 'form-control select2-normal', 'placeholder' => 'Родительская категория', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
  @foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('name', trans('form.category_name').'* '.$lang->language_name) !!}
      {!! Form::text('name['.$lang->slug.']', (isset($category) ? $category->getTranslation('name', $lang->slug) : null), ['class' => 'form-control makeSlug', 'placeholder' => trans('placeholder.category_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('form.status').'*') !!}
      {!! Form::select('active', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
@foreach ($languages as $lang)
<div class="form-group">
  {!! Form::label('description', trans('form.description').' '.$lang->language_name . trans('form.optional'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.category_desc') }}"></i>
  {!! Form::textarea('description['.$lang->slug.']', (isset($category) ? $category->getTranslation('description', $lang->slug) : null), ['class' => 'form-control summernote', 'placeholder' => trans('placeholder.category_description'), 'rows' => '2']) !!}
</div>
@endforeach
@foreach ($languages as $lang)
<div class="form-group">
  {!! Form::label('shipping_text', trans('form.shipping_text').' '.$lang->language_name . trans('form.optional'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.category_ship') }}"></i>
  {!! Form::textarea('shipping_text['.$lang->slug.']', (isset($category) ? $category->getTranslation('shipping_text', $lang->slug) : null), ['class' => 'form-control', 'placeholder' => trans('placeholder.category_shipping_text'), 'rows' => '2']) !!}
</div>
@endforeach
<div class="form-group">
  {!! Form::label('slug', trans('form.slug').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slug') }}"></i>
  {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('placeholder.slug'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
<div class="form-group">
	{!! Form::label('picture', trans('form.avatar')) !!}
	{!! Form::file('picture', null, ['class' => 'form-control', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<p class="help-block">* {{ trans('form.required_fields') }}</p>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

