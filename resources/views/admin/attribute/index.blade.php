@extends('layouts.admin')

@section('title', trans('app.attributes'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('app.attributes') }}</h1>
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
  <div class="box">
    <div class="box-header with-border">
      <div class="box-tools pull-right">
          <a href="{{ route('attributeValue.create') }}" class="btn btn-new btn-flat">{{ trans('app.add_attribute_value') }} </a>

          <a href="{{ route('attribute.create') }}" class="btn btn-new btn-flat">{{ trans('app.add_attribute') }} </a>

      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort" id="sortable" data-action="{{ Route('attribute.reorder') }}">
        <thead>
          <tr>
            @can('massDelete', \App\Models\Attribute::class)
              <th class="massActionWrapper">
                <!-- Check all button -->
                <div class="btn-group ">
                  <button type="button" class="btn btn-xs btn-default checkbox-toggle">
                    <i class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="{{ trans('app.select_all') }}"></i>
                  </button>
                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">{{ trans('app.toggle_dropdown') }}</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" data-link="{{ route('attribute.massTrash') }}" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> {{ trans('app.trash') }}</a></li>
                    <li><a href="javascript:void(0)" data-link="{{ route('attribute.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a></li>
                  </ul>
                </div>
              </th>
            @endcan
            <th width="7px">{{ trans('app.#') }}</th>
            <th>{{ trans('app.position') }}</th>
            <th>{{ trans('app.name') }}</th>
            <th>{{ trans('app.type') }}</th>
            <th>{{ trans('app.categories') }}</th>
            <th>{{ trans('app.entities') }}</th>
            <th>{{ trans('app.option') }}</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          @foreach ($attributes as $attribute)
            <tr id="{{ $attribute->id }}">
              @can('massDelete', \App\Models\Attribute::class)
                <td><input id="{{ $attribute->id }}" type="checkbox" class="massCheck"></td>
              @endcan
              <td>
                <i data-toggle="tooltip" data-placement="top" title="{{ trans('app.move') }}" class="fa fa-arrows sort-handler"> </i>
              </td>
              <td><span class="order">{{ $attribute->order }}</span></td>
              <td>
                @can('view', $attribute)
                  <a href="{{ route('attribute.entities', $attribute->id) }}">{{ $attribute->name }}</a>
                @else
                  {{ $attribute->name }}
                @endcan
              </td>
              <td>{{ $attribute->attributeType->type }}</td>
              <td>
                <span class="label label-info">{{ $attribute->categories_count }}</span>
              </td>
              <td>
                <span class="label label-default">{{ $attribute->attribute_values_count }}</span>
              </td>
              <td class="row-options">
                @can('view', $attribute)
                  <a href="{{ route('attribute.entities', $attribute->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.entities') }}" class="fa fa-plus"></i></a>&nbsp;
                @endcan
                @can('update', $attribute)
                  <a href="javascript:void(0)" data-link="{{ route('attribute.edit', $attribute->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
                @endcan
                @can('delete', $attribute)
                  {!! Form::open(['route' => ['attribute.trash', $attribute->id], 'method' => 'delete', 'class' => 'data-form']) !!}
                  {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                  {!! Form::close() !!}
                @endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

  <div class="box collapsed-box">
    <div class="box-header with-border">
      <h3 class="box-title">
        @can('massDelete', \App\Models\Attribute::class)
          {!! Form::open(['route' => ['attribute.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']) !!}
          {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm btn btn-default btn-flat ajax-silent', 'title' => trans('help.empty_trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'right']) !!}
          {!! Form::close() !!}
        @else
          <i class="fa fa-trash-o"></i>
        @endcan
        {{ trans('app.trash') }}
      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-option">
        <thead>
          <tr>
            <th>{{ trans('app.name') }}</th>
            <th>{{ trans('app.type') }}</th>
            <th>{{ trans('app.deleted_at') }}</th>
            <th>{{ trans('app.option') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($trashes as $trash)
            <tr>
              <td>{{ $trash->name }}</td>
              <td>{{ $trash->attributeType->type }}</td>
              <td>{{ $trash->deleted_at->diffForHumans() }}</td>
              <td class="row-options">
                @can('delete', $trash)
                  <a href="{{ route('attribute.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

                  {!! Form::open(['route' => ['attribute.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                  {!! Form::close() !!}
                @endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

	</div>
</section>
@endsection

@section('page-script')
  @include('plugins.drag-n-drop')
@endsection
