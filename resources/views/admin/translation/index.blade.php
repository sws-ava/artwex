@extends('layouts.admin')

@section('content')
<div class="d-flex fullscreen-page">
	<div class="my-products-page fullscreen-block">
	    <div class="title-container">
			<h2>{{ trans('back.langs') }}</h2>
		</div>
		<div class="my-products-items">
			<div class="product-item my-item">
				@can('create', App\Models\Translation::class)
					<a href="{{ route('translation.add') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_translate') }}</a>
				@endcan
				<table class="table table-hover table-2nd-short">
					<thead>
						<tr>
						  <th>{{ trans('trans.group') }}</th>
						  <th>{{ trans('trans.key') }}</th>
						  @foreach($kinds as $kind)
						  <th>{{ $kind }}</th>
						  @endforeach
						</tr>
					</thead>
					<tbody>
					@foreach($langs as $lang )
						<tr>
							<td>{{ $lang->group }}</td>
						  <td>
								@can('update', $lang)
									<a href="{{ route('translation.edit', $lang) }}"><strong>{!! $lang->key !!}</strong></a>
								@else
									<strong>{!! $lang->key !!}</strong>
								@endcan
						  </td>
						  @foreach($kinds as $kind)
						  <td>{{ $lang->text[$kind] }}</td>
						  @endforeach
						  <td class="row-options text-muted small">
									<a href="{{ route('translation.edit', $lang) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" width="14" height="14">
                                            <g id="noun_edit_684936" transform="translate(-1.618 -1.618)">
                                                <path id="Path_958" fill="#8b8d91" transform="translate(0)" d="M 15.042 3.121 l -0.928 -0.928 a 1.97 1.97 0 0 0 -2.783 0 L 2.983 10.542 a 0.434 0.434 0 0 0 -0.111 0.189 L 1.635 15.06 a 0.437 0.437 0 0 0 0.421 0.558 a 0.426 0.426 0 0 0 0.12 -0.017 L 6.5 14.363 a 0.436 0.436 0 0 0 0.189 -0.111 L 15.042 5.9 a 1.968 1.968 0 0 0 0 -2.783 Z M 6.155 13.554 l -3.463 0.989 l 0.99 -3.463 L 10.4 4.358 l 2.474 2.474 Z m 8.269 -8.269 l -0.928 0.928 L 11.022 3.74 l 0.928 -0.928 a 1.1 1.1 0 0 1 1.547 0 l 0.928 0.928 a 1.092 1.092 0 0 1 0 1.546 Z" data-name="Path 958" />
                                            </g>
                                        </svg></a>&nbsp;
						  </td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
