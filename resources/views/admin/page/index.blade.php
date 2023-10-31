@extends('layouts.admin')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.pages') }}</h3>
      <div class="box-tools pull-right">
          <a href="{{ route('page.create') }}" class="btn btn-success btn-flat">{{ trans('app.add_page') }}</a>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            <th>{{ trans('app.page_title') }}</th>
            <th>{{ trans('app.visibility') }}</th>
            <th>{{ trans('app.view_position') }}</th>
            <th>{{ trans('app.date') }}</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          @foreach ($pages as $page)
            <tr>
              <td width="45%">
                  <strong>{!! $page->title !!}</strong>
                @if (is_null($page->published_at))
                  <span class="indent10 label label-default">{{ strtoupper(trans('app.draft')) }}</span>
                @endif
              </td>
              <td>{!! $page->visibilityName() !!}</td>
              <td>{!! $page->viewPosition() !!}</td>
              <td class="small">
                @if ($page->published_at)
                  @if (\Carbon\Carbon::now() < $page->published_at)
                    {{ trans('app.schedule_published_at') }}<br />
                    {{ optional($page->published_at)->toDayDateTimeString() }}
                  @else
                    {{ trans('app.published_at') }}<br />
                    {{ optional($page->published_at)->toFormattedDateString() }}
                  @endif
                @else
                  {{ trans('app.updated_at') }}<br />
                  {{ $page->updated_at->toFormattedDateString() }}
                @endif
              </td>
              <td class="row-options text-muted small">
                  <a href="{{ route('page.edit', $page) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
                
                    {!! Form::open(['route' => ['page.trash', $page], 'method' => 'delete', 'class' => 'data-form']) !!}
                    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                    {!! Form::close() !!}

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
        @can('massDelete', \App\Models\Page::class)
          {!! Form::open(['route' => ['admin.utility.page.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']) !!}
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
      <table class="table table-hover table-2nd-sort">
        <thead>
          <tr>
            <th>{{ trans('app.page_title') }}</th>
            <th>{{ trans('app.visibility') }}</th>
            <th>{{ trans('app.author') }}</th>
            <th>{{ trans('app.deleted_at') }}</th>
            <th>{{ trans('app.option') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($trashes as $trash)
            <tr>
              <td width="50%"><strong>{!! $trash->title !!}</strong></td>
              <td>{!! $trash->visibilityName() !!}</td>
              <td>{{ $trash->author->getName() }}</td>
              <td>{{ $trash->deleted_at->diffForHumans() }}</td>
              <td class="row-options small">
                @can('delete', $trash)
                  <a href="{{ route('admin.utility.page.restore', $trash) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;
                  {!! Form::open(['route' => ['admin.utility.page.destroy', $trash], 'method' => 'delete', 'class' => 'data-form']) !!}
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
@endsection
