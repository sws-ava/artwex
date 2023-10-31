<?php

namespace App\Helpers;

use App\Models\Attribute;
use App\Models\Country;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Language;
use App\Models\Page;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

/**
 * This is a helper class to process,upload and remove images from different models
 */
class ArtHelper
{
	/**
     * Get pages list for theme.
     */
    public static function pages($visibility = null)
    {

        return Cache::rememberForever('cached_pages', function () use ($visibility) {
            if ($visibility) {
                return Page::select('title', 'slug', 'position')
                    ->published()->visibilityOf($visibility)->get();
            }

            return Page::select('title', 'slug', 'position')->published()->get();
        });
    }
	
	/**
     * Get list of all available categories formated for theme
     *
     * @return array
     */
    public static function getCategories($all = false)
    {
        return Cache::remember('all_categories', config('cache.remember.categories', 0), function () use ($all) {
            $result = Category::all();

            return $result;
        });
    }	
	
	/**
     * Get list of all available categories formated for theme
     *
     * @return array
     */
    public static function getCategoriesArr($all = false)
    {
        return Category::orderBy('name', 'asc')->pluck('name', 'id');
    }
	
	public static function recentlyViewedItems()
    {
        return Cache::rememberForever('recently_viewed_items', function () {
            $products = Session::get('products.recently_viewed_items');

            if (!$products) {
                return collect([]);
            }

            return Product::whereIn('id', $products)->get();
        });
    }
		
	/**
     * Get list of all available categories formated for theme
     *
     * @return array
     */
    public static function getCountries($all = false)
    {
        return Cache::remember('footer_countries', config('cache.remember.countries', 0), function () use ($all) {
            $result = Country::all();

            return $result;
        });
    }
		
	/**
     * Get list of all available categories formated for theme
     *
     * @return array
     */
    public static function getCurrencies($all = false)
    {
        return Cache::remember('footer_currencies', config('cache.remember.currencies', 0), function () use ($all) {
            $result = Currency::active()->get();

            return $result;
        });
    }
		
	/**
     * Get list of all available categories formated for theme
     *
     * @return array
     */
    public static function getLanguages($all = false)
    {
        return Cache::remember('footer_languages', config('cache.remember.languages', 0), function () use ($all) {
            $result = Language::active()->get();

            return $result;
        });
    }
		
	/**
     * Get list of all available categories formated for theme
     *
     * @return array
     */
    public static function getUnits($all = false)
    {
        return Cache::remember('footer_units', config('cache.remember.units', 0), function () use ($all) {
            $result = Category::all();

            return $result;
        });
    }
	
    /**
     * Get attributes list for form dropdown.
     *
     * @return array
     */
    public static function attributes($all = false)
    {
        $query = DB::table('attributes')->where('deleted_at', null);

        //if (!$all) {
            //$query->where('shop_id', Auth::user()->merchantId());
        //}

        return $query->orderBy('name', 'asc')->pluck('name', 'id');
    }

    /**
     * Get attributes list with all values for form dropdown.
     *
     * @return array
     */
    public static function attributeWithValues()
    {
        return Attribute::where('deleted_at', null)
            ->with('attributeValues')->orderBy('order', 'asc')->get();
    }
	
    /**
     * Get attribute_types list for form dropdown.
     *
     * @return array
     */
    public static function attribute_types()
    {
        return DB::table('attribute_types')->orderBy('type', 'asc')->pluck('type', 'id');
    }
	
	/**
     * Get currency list for form dropdown.
     *
     * @return array
     */
    public static function currencies($all = false)
    {
        $query = DB::table('currencies')->select('name', 'symbol', 'iso_code', 'id');

        if (!$all) {
            $query->where('active', BaseModel::ACTIVE);
        }

        $currencies = $query->orderBy('priority', 'asc')->orderBy('name', 'asc')->get();

        $result = [];
        foreach ($currencies as $currency) {
            $result[$currency->id] = $currency->name . ' (' . $currency->iso_code . ' ' . $currency->symbol . ')';
        }

        return $result;
    }
	
	/**
     * Get country list for form dropdown.
     *
     * @return array
     */
    public static function countries()
    {
        return DB::table('countries')->orderBy('name', 'asc')->pluck('name', 'id');
    }
	
	/**
     * Get tags list for form dropdown.
     *
     * @return array
     */
    public static function tags()
    {
        return DB::table('tags')->orderBy('name', 'asc')->pluck('name', 'id');
    }
	
    /**
     * Get page positions list for form dropdown.
     *
     * @return array
     */
    public static function page_positions()
    {
        return  [
            'copyright_area'    => trans('app.copyright_area'),
            'footer_1st_column' => trans('app.footer_1st_column'),
            'footer_2nd_column' => trans('app.footer_2nd_column'),
            'footer_3rd_column' => trans('app.footer_3rd_column'),
            'main_nav'           => trans('app.main_nav'),
        ];
    }
	
	/**
     * Return attribute list for the given product
     *
     * @param Product $product
     * @return collection
     */
    public static function getAttributesBy(Product $product)
    {
        if ($attrs = $product->categories->pluck('attrsList')) {
            return $attrs->flatten()->unique('id');
        }

        return $attrs;
    }
}