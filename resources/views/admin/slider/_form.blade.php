    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить слайд</h1>
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
      {!! Form::text('title['.$lang->slug.']', (isset($slider) ? $slider->getTranslation('title', $lang->slug) : null), ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
	@endforeach
  </div>
  <div class="col-sm-12 col-md-6 nopadding-left">
	@foreach ($languages as $lang)
    <div class="form-group">
      {!! Form::label('sub_title', 'Краткое описание* '.$lang->language_name) !!}
	  {!! Form::textarea('sub_title['.$lang->slug.']', (isset($slider) ? $slider->getTranslation('sub_title', $lang->slug) : null), ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => '', 'required']) !!}
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
			<div class="col-sm-12 col-md-3">
				<div class="form-group">
					{!! Form::label('title_color', 'Цвет текста тайтла') !!}
					{!! Form::text('title_color', null, ['class' => 'form-control', 'placeholder' => '#20223E']) !!}
				  <div class="help-block with-errors"></div>
				</div>  
			</div>  
			<div class="col-sm-12 col-md-3">			
				<div class="form-group">
					{!! Form::label('sub_title_color', 'Цвет текста краткого описания') !!}
					{!! Form::text('sub_title_color', null, ['class' => 'form-control', 'placeholder' => '#4F5163']) !!}
				  <div class="help-block with-errors"></div>
				</div>    
			</div>    
			<div class="col-sm-12 col-md-3">
				<div class="form-group">
					{!! Form::label('background_color', 'Цвет бэкграунда') !!}
					{!! Form::text('background_color', null, ['class' => 'form-control', 'placeholder' => 'linear-gradient(102.54deg, #F5F6FF 0%, #FBD9A0 98.99%)']) !!}
				  <div class="help-block with-errors"></div>
				</div>
			</div>			
			<div class="col-sm-12 col-md-3">
				<div class="form-group">
					{!! Form::label('button_color', 'Цвет кнопки') !!}
					{!! Form::text('button_color', null, ['class' => 'form-control', 'placeholder' => '#DF1A1D']) !!}
				  <div class="help-block with-errors"></div>
				</div>
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
			<div class="col-sm-12 col-md-6">	
				<div class="form-group">
					{!! Form::label('link', 'Ссылка') !!}
					{!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => '']) !!}
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

