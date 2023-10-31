@extends('layouts.master')

@section('content')
     <div class="cover">
          <h6 style="color:#A9A9C1;">Главная/Магазин</h6>
          <h2 style="color: #20223E;">Поиск по запросу "{{ $query['query'] }}"</h2>
     </div>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="filter">Filter</div>
                <ul class="filter__menu">
                    <li><a href="#">Категория</a></li>
                    <li><a href="#">Тип покраски</a></li>
                    <li><a href="#">Стиль</a></li>
                    <li><a href="#">Цена</a></li>
                    <li><a href="#">Ориентация</a></li>
                    <li><a href="#">Поиск по словам</a></li>
                </ul>
                <div class="reset">Сбросить фильтры</div>
            </div>
            <div class="col-12 col-sm-9">
                <div class="items">
					@foreach ($products as $product)
						<div class="item">
							@include('templates.product', ['product' => $product])
						</div>
					@endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection