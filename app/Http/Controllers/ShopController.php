<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $slug, $sortby = Null) {
		
		$currencies = Currency::all();
		$categories = Category::get();
		
		$category = Category::where('slug', $slug)->active()->firstOrFail();
		
		$all_products = $category->listings();
		
		$priceRange['min'] = floor($all_products->min('price'));
        $priceRange['max'] = ceil($all_products->max('price'));
		
        $products = $all_products->filter($request->all())
        ->with(['reviews:rating,reviewable_id,reviewable_type', 'images:path,imagetrait_id,imagetrait_type'])->active()
        ->paginate(20)->appends($request->except('page'));
		
		return view('shop', compact('category', 'products', 'priceRange', 'currencies', 'categories'));
	}
}
