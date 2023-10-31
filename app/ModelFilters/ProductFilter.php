<?php
namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function query($query)
    {
        return $this->where('name', 'like', '%'.$query.'%');
    }

    public function rating($rating)
    {
        return $this->whereHas('reviews', function($query) use ($rating) {
            return $query->select('rating')->groupBy('reviewable_id')->havingRaw('AVG(rating) >= ?', [$rating]);
        });
    }
	
	public function category($id) {
		return $this->related('categories', 'category_id', '=', $id);
	}	
	
	public function categorysubs($id) {
		$cats = [];
		$data = Category::select('id')->where('category_sub_id', $id)->get();
		foreach ($data as $cat) {
			$cats[] = $cat->id;
		}
		if (count($cats)) {
			return $this->related('categories', function($query) use ($cats) {
				return $query->whereIn('category_id', $cats);
			});
		}
	}

    public function price($price)
    {
    	$price = explode('-', $price);

    	return $this->whereBetween('price', [$price[0], $price[1]]);
    	//return $this->where('price', '>', $price);
    }
    
	public function unit($unit)
    {
    	return $this->where('unit', $unit);
    }    
	
	public function currencies($currencies)
    {
    	return $this->where('currencies', $currencies);
    }

    public function newArraivals($new_arrivals)
    {
        return $this->where('products.created_at', '>', Carbon::now()->subDays(7));
    }

    public function hasOffers($has_offers)
    {
        return $this->hasOffer();
    }

    public function sortBy($sort_by)
    {
        switch ($sort_by) {
            case 'newest':
                return $this->orderBy('products.created_at', 'desc');
            case 'oldest':
                return $this->orderBy('products.created_at', 'asc');
            case 'price_acs':
                return $this->orderBy('products.price', 'asc');
            case 'price_desc':
                return $this->orderBy('products.price', 'desc');
            case 'best_match':
            default:
                return;
        }
	}

    public function condition($condition)
    {
    	return $this->whereIn('condition', array_keys($condition));
    }

    public function brand($brand)
    {
    	return $this->whereIn('brand', array_keys($brand));
    }
	
    public function attribute($attributes)
    {
        $values = array_keys($attributes);
        $attrs = array_unique($attributes);

        return $this->whereHas('attributes', function (Builder $query) use ($attrs, $values) {
            $query->whereIn('attribute_product.attribute_id', $attrs)
                ->whereIn('attribute_product.attribute_value_id', $values);
        });
    }
}
