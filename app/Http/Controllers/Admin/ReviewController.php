<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ProductReviewCreateRequest;

class ReviewController extends Controller
{	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(ProductReviewCreateRequest $request, $slug)
    {
        //$customer_id = Auth::user()->id; //Set customer_id		
		$model = new Review();				
		$data = $request->all();

		$item = Product::where('slug', $slug)->withCount('reviews')->firstOrFail();
		
		$data['reviewable_id'] = $item->id;
		$data['reviewable_type'] = 'App\Models\Product';
		
		$review = $model->create($data);
		
        return redirect()->route('account.reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
		$review = Review::onlyTrashed()->findOrFail($id);
        $review->forceDelete();

        return redirect()->route('account.reviews');
    }
}
