<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Review;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopReviewCreateRequest;
use App\Http\Requests\ProductReviewCreateRequest;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_review_shop(ShopReviewCreateRequest $request, $slug)
    {
        $model = new Review();				
		$data = $request->all();

		$item = Shop::where('slug', $slug)->withCount('reviews')->firstOrFail();
		
		$data['reviewable_id'] = $item->id;
		$data['reviewable_type'] = 'App\Models\Shop';

        return redirect()->route('show.store', $slug);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_review_product(ProductReviewCreateRequest $request, $slug)
    {
        //$customer_id = Auth::user()->id; //Set customer_id		
		$model = new Review();				
		$data = $request->all();

		$item = Product::where('slug', $slug)->withCount('reviews')->firstOrFail();
		
		$data['reviewable_id'] = $item->id;
		$data['reviewable_type'] = 'App\Models\Product';
		
		$review = $model->create($data);
		
        return redirect()->route('show.product', $slug);
    }
	
	public function index() {
		exit('sadasdas');
	}

}
