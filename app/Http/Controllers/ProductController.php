<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($slug){
		$product = Product::where('slug', $slug)->withCount('reviews')->firstOrFail();
		$more_products = Product::where('shop_id', $product->shop_id)->get();
		
		$this->update_recently_viewed_items($product); //update_recently_viewed_items
		
		return view('product', compact('product', 'more_products'));
	}
	
    /**
     * Push product ID to session for the recently viewed items section
     *
     * @param  [type] $product [description]
     */
    private function update_recently_viewed_items($product)
    {
        $items = Session::get('products.recently_viewed_items', []);

        if (!in_array($product->getKey(), $items)) {
            Session::push('products.recently_viewed_items', $product->getKey());
        }

        Cache::forget('recently_viewed_items');
    }
}
