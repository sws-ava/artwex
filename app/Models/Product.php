<?php

namespace App\Models;

use Auth;
use App\Models\Currency;
use App\Traits\ImageTrait;
use App\Traits\ReviewTrait;
use Laravel\Scout\Searchable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
	use ImageTrait, ReviewTrait, Filterable, SoftDeletes, HasTranslations;

    protected $softDelete = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'shop_id',
                        'name',
                        'model_number',
                        'description',
                        'price',
						'oldprice',
                        'slug',
                        'active',
                        'short_description',
                        'is_popular',
                        'is_selled'
                    ];
					
	public $translatable = ['name', 'short_description', 'description'];

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->name;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['id'] = $this->id;
        $array['shop_id'] = $this->shop_id;
        $array['name'] = $this->name;
        $array['model_number'] = $this->model_number;
        $array['short_description'] = $this->short_description;
        $array['description'] = $this->description;
        $array['active'] = $this->active;

        return $array;
    }

    /**
     * Overwrited the image method in the imagetrait
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imagetrait')
        ->where(function($q){
            $q->whereNull('featured')->orWhere('featured', 0);
        })->orderBy('order', 'asc');
    }

    /**
     * Get the shop associated with the product.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the shop associated with the product.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
	
	/**
     * Get the Attributes for the inventory.
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')
            ->withPivot('attribute_value_id')->withTimestamps();
    }

    /**
     * Get the attribute values that owns the SubGroup.
     */
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_product')
            ->withPivot('attribute_id')->withTimestamps();
    }

    /**
     * Get the categories for the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
    }

    /**
     * Get the category list for the product.
     *
     * @return array
     */
    public function getCategoryListAttribute()
    {
        if (count($this->categories)) return $this->categories->pluck('id')->toArray();
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }

    /**
     * Scope a query to only include active products.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }   

    /**
     * Set the Minimum price zero if the value is Null.
     */
    public function setMinPriceAttribute($value)
    {
        $this->attributes['min_price'] = $value ? $value : 0;
    }

    /**
     * Set the Maximum price null if the value is zero.
     */
    public function setMaxPriceAttribute($value)
    {
        $this->attributes['max_price'] = (bool) $value ? $value : null;
    }
	
    /**
     * Checking product has attributes or not
     */
    public function hasAttributes(): bool
    {
        if ($attrs = $this->categories->pluck('attrsList')) {
            return count($attrs->flatten()->unique('id')) > 0;
        }

        return false;
    }
}
