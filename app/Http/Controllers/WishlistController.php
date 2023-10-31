<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $item
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, Product $item)
    {
		$wishlist = Wishlist::where('product_id',$item->id)->where('customer_id', $request->user()->id)->first();

		if ($wishlist) {
			$wishlist->forceDelete();
			$method = 'delete';
		} else {
			$wishlist = new Wishlist;
			$wishlist->create([
				'product_id'  => $item->id,
				'customer_id' => $request->user()->id
			]);
			$method = 'add';
		}
		
        //return redirect()->route('profile.wishlist');
		return response()->json(['status' => 'success', 'method' => $method/*, 'id' => $wishlist->id*/], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, Wishlist $wishlist)
    {
        //$this->authorize('remove', $wishlist);

        $wishlist->forceDelete();

        //return redirect()->route('profile.wishlist');
		return response()->json(['status' => 'success'], 200); 
    }
}
