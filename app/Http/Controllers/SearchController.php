<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Helpers\CatalogHelper;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
		$query = $request->all();

		if (!empty($request->all())) {
			$products = Product::filter($request->all())
			->with(['reviews:rating,reviewable_id,reviewable_type', 'images:path,imagetrait_id,imagetrait_type'])
			->select('products.*')
			->paginateFilter();
		} else {
			$products = [];
		}
		return view('search_results', compact('products', 'query'));
    }
}