    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить идею</h1>
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
                        <!-- form start -->
<div class="row">
  <div class="col-sm-12 col-md-6 nopadding-right">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('title', 'Название* '.$lang->language_name) !!}
      {!! Form::text('title['.$lang->slug.']', (isset($idea) ? $idea->getTranslation('title', $lang->slug) : null), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>
  <div class="col-sm-12 col-md-6 nopadding-left">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('short_content', 'Краткое описание* '.$lang->language_name) !!}
	  {!! Form::textarea('short_content['.$lang->slug.']', (isset($idea) ? $idea->getTranslation('short_content', $lang->slug) : null), ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>  
  </div>  
  </div>  
</div>                    
<div class="card card-primary">
					<div class="card-body">
                        <!-- form start -->
<div class="row">
  <div class="col-sm-12 nopadding-left">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('content', 'Полное описание* '.$lang->language_name) !!}
	  {!! Form::textarea('content['.$lang->slug.']', (isset($idea) ? $idea->getTranslation('content', $lang->slug) : null), ['class' => 'form-control summernote', 'rows' => '8', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>  
  </div>  
  </div>  
</div> 
<div class="card card-primary">
	<div class="card-body">
		<div class="row"> 
			<div class="col-sm-12 col-md-6">
				<div class="form-group">
					{!! Form::label('image', 'Изображение') !!}
					{!! Form::file('image', null, ['class' => 'form-control', 'required']) !!}
				  <div class="help-block with-errors"></div>
				</div>   
			</div>   
		</div>
	</div>
</div>

<p class="help-block">* {{ trans('form.required_fields') }}</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

