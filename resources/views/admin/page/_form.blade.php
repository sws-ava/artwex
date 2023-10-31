    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Страница</h1>
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
  <div class="col-md-8 nopadding-right">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('title', trans('app.form.page_title') . '* '.$lang->language_name) !!}
      {!! Form::text('title['.$lang->slug.']', (isset($page) ? $page->getTranslation('title', $lang->slug) : null), ['class' => isset($page) ? 'form-control' : 'form-control makeSlug', 'placeholder' => trans('app.placeholder.page_title'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('position', trans('app.form.view_area') . '*') !!}
      {!! Form::select('position', $positions, null, ['class' => 'form-control select2-normal', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
						</div>
					</div>
                    <div class="card card-primary">
						<div class="card-body">
@unless(isset($page))
  <div class="form-group">
    {!! Form::label('slug', trans('app.form.slug') . '*') !!}
    {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
    <div class="help-block with-errors"></div>
  </div>
@endunless
						</div>
					</div>
					<div class="card card-primary">
						<div class="card-body">
							@foreach ($languages as $lang)
<div class="form-group">
  {!! Form::label('content', trans('app.form.content') . '* '.$lang->language_name) !!}
  {!! Form::textarea('content['.$lang->slug.']', (isset($page) ? $page->getTranslation('content', $lang->slug) : null), ['class' => 'form-control summernote-long', 'placeholder' => trans('app.placeholder.content'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
							@endforeach
						</div>
					</div>
					<div class="card card-primary">
						<div class="card-body">
@unless(isset($page))
  <div class="row">
    <div class="col-md-6 nopadding-right">
      <div class="form-group">
        {!! Form::label('published_at', trans('app.form.publish_at')) !!}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          {!! Form::text('published_at', isset($page) ? $page->published_at : null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.publish_at')]) !!}
        </div>
        <div class="help-block with-errors">{{ trans('help.leave_empty_to_save_as_draft') }}</div>
      </div>
    </div>
    <div class="col-md-6 nopadding-left">
      <div class="form-group">
        {!! Form::label('visibility', trans('app.form.visibility') . '*') !!}
        {!! Form::select('visibility', ['1' => trans('app.public'), '2' => trans('app.merchant')], null, ['class' => 'form-control select2-normal', 'required']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>
@endunless
						</div>
					</div>
					<div class="card card-primary">
						<div class="card-body">
<div class="form-group">
  <label for="exampleInputFile"> {{ trans('app.cover_image') }}</label>
  @if (isset($page) && $page->coverImage)
    <img src="{{ get_storage_file_url(optional($page->coverImage)->path, 'small') }}" width="" alt="{{ trans('app.cover_image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image[cover]', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  @endif

  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.cover_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
      <div class="fileUpload btn btn-primary btn-block btn-flat">
        <span>{{ trans('app.form.upload') }}</span>
        <input type="file" name="images[cover]" id="uploadBtn" class="upload" />
      </div>
    </div>
  </div>
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>
