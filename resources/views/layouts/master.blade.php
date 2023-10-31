<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index, follow" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@lang('meta.title')</title>
		<meta name="description" content="@lang('meta.desc')">
		
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="@lang('meta.title')" />
		<meta property="og:description"        content="@lang('meta.desc')" />
		
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;700&display=swap&subset=cyrillic-ext;" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/style.css?ver='.time()) }}"/>
		    <link rel="stylesheet" href="{{ asset('css/slick.css?ver='.time()) }}">

		  <link rel="shortcut icon" href="/img/favicons/favicon.ico" type="image/x-icon" />
		  <link rel="apple-touch-icon" href="/img/favicons/apple-touch-icon.png" />
		  <link rel="apple-touch-icon" sizes="57x57" href="/img/favicons/apple-touch-icon-57x57.png" />
		  <link rel="apple-touch-icon" sizes="72x72" href="/img/favicons/apple-touch-icon-72x72.png" />
		  <link rel="apple-touch-icon" sizes="76x76" href="/img/favicons/apple-touch-icon-76x76.png" />
		  <link rel="apple-touch-icon" sizes="114x114" href="/img/favicons/apple-touch-icon-114x114.png" />
		  <link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/apple-touch-icon-120x120.png" />
		  <link rel="apple-touch-icon" sizes="144x144" href="/img/favicons/apple-touch-icon-144x144.png" />
		  <link rel="apple-touch-icon" sizes="152x152" href="/img/favicons/apple-touch-icon-152x152.png" />
		  <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon-180x180.png" />
  
        @stack('styles')
    </head>
    <body class="{{$pageclass}}">
		@include('layouts.header')
		<div class="wrapper">
			@yield('content')
		</div>
		@include('layouts.footer')
		
		@include('scripts.appjs')

		@yield('scripts')
		@stack('scripts')
    </body>
</html>
