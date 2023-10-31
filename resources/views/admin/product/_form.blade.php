    <!-- Content Header (Page header) -->
<?php 
//echo '<pre>'; 
//print_r($product->getTranslation('description', 'en')); 
//print_r(array_filter(json_decode($product->description), function ($value) {return $value=='en';})); 
//exit(); ?>	
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isset($product) ? 'Обновить товар' : 'Добавить товар' }}</h1>
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
            <div class="col-md-12 nopadding-right">
			  	@foreach ($languages as $lang)
				<div class="form-group">
				  {!! Form::label('name['.$lang->slug.']', 'Название* '.$lang->language_name) !!}
				  {!! Form::text('name['.$lang->slug.']', (isset($product) ? $product->getTranslation('name', $lang->slug) : null), ['class' => 'form-control makeSlug', 'placeholder' => 'Введите название', 'required']) !!}
				  <div class="help-block with-errors"></div>
				</div>
				@endforeach	
            </div>
		</div>
		          <div class="row">
            <div class="col-md-12 nopadding-right">
			  <div class="form-group">
    {!! Form::label('slug', trans('app.form.slug') . '*') !!}
    {!! Form::text('slug', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
    <div class="help-block with-errors"></div>
  </div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						{!! Form::label('model_number', 'Артикул', ['class' => 'with-help']) !!}
						<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i>
						{!! Form::text('model_number', null, ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
			</div>
		</div>
		</div>
						    <div class="card card-primary">
						<div class="card-body">
		<div class="row">
            <div class="col-md-6 nopadding-left">
              <div class="form-group">
				{!! Form::label('shop_id', 'Художник*') !!}
				{!! Form::select('shop_id', $shops, null, ['class' => 'form-control select2-normal', 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>
			<div class="col-md-6 nopadding-right">
			    <div class="form-group">
					{!! Form::label('category_list[]', trans('app.form.categories') . '*') !!}
					{!! Form::select('category_list[]', $categories, null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple', 'required']) !!}
					<div class="help-block with-errors"></div>
				</div>
			</div>

          </div>
					</div>
				</div>
			<div class="card card-primary">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">	
					@if (isset($product))
				        @if ($attributes->count())
						  <fieldset class="">
							<legend>{{ trans('app.attributes') }}</legend>
							@foreach ($attributes as $attribute)
							  <div class="form-group">
								{!! Form::label($attribute->name, $attribute->name) !!}
								<select class="form-control select2" id="{{ $attribute->name }}" name="variants[{{ $attribute->id }}]" placeholder={{ trans('app.placeholder.select') }}>
								  <option value="">{{ trans('app.placeholder.select') }}</option>

								  @foreach ($attribute->attributeValues as $attributeValue)
									<option value="{{ $attributeValue->id }}" {{ isset($product) &&count($product->attributes) &&in_array($attributeValue->id, $product->attributeValues->pluck('id')->toArray())? 'selected': '' }}>

									  {{ $attributeValue->value }}

									</option>
								  @endforeach
								</select>
							  </div>
							@endforeach
						  </fieldset>
						@endif
					@endif
						</div>
					</div>
				</div>
			</div>
		
				    <div class="card card-primary">
						<div class="card-body">
          <div class="row">
            <div class="col-md-4 nopadding-right">
              <div class="form-group">
                {!! Form::label('price', 'Цена', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i>
                {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => '']) !!}
              </div>
            </div>
            <div class="col-md-4 nopadding-right">
              <div class="form-group">
                {!! Form::label('oldprice', 'Старая цена', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i>
                {!! Form::text('oldprice', null, ['class' => 'form-control', 'placeholder' => '']) !!}
              </div>
            </div>			
            <div class="col-md-4 nopadding-left">
              <div class="form-group">
                {!! Form::label('active', 'Статус*', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i>
                {!! Form::select('active', ['1' => 'Активный', '0' => 'Не активный'], !isset($product) ? 1 : null, ['class' => 'form-control select2-normal', 'placeholder' => '', 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
						</div>
					</div>
					<div class="card card-primary">
						<div class="card-body">
						@foreach ($languages as $lang)
          <div class="form-group">
            {!! Form::label('short_description', 'Краткое описание* '.$lang->language_name, ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i>
            {!! Form::textarea('short_description['.$lang->slug.']', (isset($product) ? $product->getTranslation('short_description', $lang->slug) : null), ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => '', 'required']) !!}
            <div class="help-block with-errors">{!! $errors->first('short_description', ':message') !!}</div>
          </div>
		  @endforeach
          </div>
          </div>
		  				    <div class="card card-primary">
						<div class="card-body">
						@foreach ($languages as $lang)
          <div class="form-group">
            {!! Form::label('description', 'Полное описание* '.$lang->language_name, ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i>
            {!! Form::textarea('description['.$lang->slug.']', (isset($product) ? $product->getTranslation('description', $lang->slug) : null), ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => '', 'required']) !!}
            <div class="help-block with-errors">{!! $errors->first('description', ':message') !!}</div>
          </div>
		  @endforeach
          </div>
          </div>
				    <div class="card card-primary">
						<div class="card-body">
          <div class="form-group">
            {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
            {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
          </div>

          <fieldset>
            <legend>
              {{ trans('app.form.images') }}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_images') }}"></i>
            </legend>
            <div class="form-group">
              <div class="file-loading">
                <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
              </div>
              <span class="small"><i class="fa fa-info-circle"></i> {{ trans('help.multi_img_upload_instruction', ['size' => getAllowedMaxImgSize(),'number' => getMaxNumberOfImgsForInventory()]) }}</span>
            </div>
          </fieldset>
		    <div class="col-md-3 nopadding-left">
              <div class="form-group">
                {!! Form::label('is_popular', 'Популярное*', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Этот пункт отвечает за появление товара на странице Популярное"></i>
                {!! Form::select('is_popular', ['0' => 'Не популярное', '1' => 'Популярное'], !isset($product) ? 0 : null, ['class' => 'form-control select2-normal', 'placeholder' => '', 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>		    
			<div class="col-md-3 nopadding-left">
              <div class="form-group">
                {!! Form::label('is_selled', 'Продано*', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Этот пункт отвечает за наличие кнопки купить в карточке товара"></i>
                {!! Form::select('is_selled', ['0' => 'Не продано', '1' => 'Продано'], !isset($product) ? 0 : null, ['class' => 'form-control select2-normal', 'placeholder' => '', 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>

          <p class="help-block">* {{ trans('app.form.required_fields') }}</p>

          <div class="box-tools pull-right">
            {!! Form::submit(isset($product) ? 'Сохранить' : 'Создать', ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
          </div>
		  
					</div>
					</div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->