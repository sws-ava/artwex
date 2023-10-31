@extends('layouts.master')

@section('content')
    <div class="cover cover-yellow">
        <h2>@lang('ideas.idea_header')</h2>
    </div>

    <div class="but-page-buttons">
        <div class="container-fluid">
            <div class="row">
                <div class="col align-self-end">
                    <div class="dropdown-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            9 @lang('ideas.perpage')
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">12</a></li>
                          <li><a class="dropdown-item" href="#">15</a></li>
                          <li><a class="dropdown-item" href="#">18</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="creativity-ideas">
        <div class="container-fluid">
            <div class="row">
				@foreach ($ideas as $idea)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="creativity-ideas-card">
						<img src="/storage/{{$idea->image}}" class="creativity-ideas-card-img" alt="{{ $idea->title }}">
                        <h3>{{ $idea->title }}</h3>
                        <h4>{!! $idea->short_content !!}</h4>
                        <a href="#">@lang('ideas.read_more') <img src="/img/arrow1.svg" alt=""></a>
                    </div>
                </div>
				@endforeach
            </div>
        </div>
    </div>

    

    <div>@if (count($ideas) > 9)<button class="but-show-more">@lang('ideas.show_more')</button>@endif</div>
@endsection