<div class="card_n product-card">
	<div class="product-image">
		<a href="{{ route('show.product', $product->slug ) }}">
		@if (count($product->images))
			<img src="/storage/{{str_replace("public/", "", $product->images[0]->path)}}" class="itemImage">
		@else
			<img src="/img/placeholder-100x100.png">
		@endif
		</a>
	</div>
	<div class="name-principal">
		<h3>{{ $product->name }} </h3>
		<nav class="favorites">
			<a href="{{ route('wishlist.add', $product) }}">
				@if (in_array($product->id, $user_wishlist))
				<img src="/img/heart-filled.svg" alt="" />
				@else
				<img src="/img/heart.svg" alt="" />
				@endif
			</a>
		</nav>
	</div>
	<div class="category-name"><h4>@if (isset($product->categories[0])){{ $product->categories[0]->name }}@endif</h4></div>
	<div class="product-author"><h4>{{ isset($product->shop) ? $product->shop->name : '' }}</h4></div>
	<div class="product-price
		@if ($product->oldprice > 0) 
			have-oldprice	
		@endif
		">
		@if ($product->oldprice > 0)
			<span class="old-price">${{ round($product->oldprice,2) }}</span>
		@endif
		${{ round($product->price,2) }}		
	</div>
</div>