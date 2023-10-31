<?php

namespace App\Http\Middleware;

use App\Helpers\ArtHelper;
use Closure;
use Request;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Wishlist;

class Storefront
{
    /**
     * Handle an incoming request. Supply important data to all views.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Skip when ajax request
        if ($request->ajax()) {
            return $next($request);
        }
		
		$segment = Request::segment(1);
		
		if (is_null($segment)) {
			$pageclass = 'mainpage';
		} else {
			$pageclass = 'innerpage';
		}
		
		View::share('pageclass', $pageclass);
        View::share('pages', ArtHelper::pages(\App\Models\Page::VISIBILITY_PUBLIC));
        View::share('all_categories', ArtHelper::getCategories());
        View::share('recently_viewed_items', ArtHelper::recentlyViewedItems());
		View::share('footer_countries',  ArtHelper::getCountries());
		View::share('footer_units',  ArtHelper::getUnits());
		View::share('footer_languages',  ArtHelper::getLanguages());
		View::share('footer_currencies',  ArtHelper::getCurrencies());
        //View::share('cart_item_count', cart_item_count());
		
		if (Auth::check()) {
			View::share('user_wishlist', Wishlist::mine()->pluck('product_id')->toArray());
		} else {
			View::share('user_wishlist', []);
		}

        return $this->insertIntoViewResponse($next($request));
    }

    /**
     * Insert Important content Into View Response
     *
     * @return  \Illuminate\Http\Request  $request
     */
    private function insertIntoViewResponse($response)
    {
        if (!$response instanceof Response) {
            return $response;
        }

        return $response;
    }
}
