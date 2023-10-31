<?php


namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
	use ImageTrait, SoftDeletes, HasTranslations;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'parent_id', 'slug', 'description', 'shipping_text', 'active', 'featured', 'picture'];
	
	public $translatable = ['name', 'description', 'shipping_text'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get all listings for the category.
     */
    public function listings()
    {
        return $this->belongsToMany(Product::class, 'category_product', null, 'product_id', null, 'id');
    }
	
    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    /**
     * Scope a query to only include Featured records.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    /**
     * Scope a query to only include active categories.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
	
	/**
     * Get the attributes of respective categories.
     */
    public function attrsList(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_categories')
            ->orderBy('order', 'asc')->withTimestamps();
    }
	
	/**
     * Setters
     */
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = (bool) $value;
    }
	
	/**
     * Setters
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }
}
