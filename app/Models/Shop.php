<?php

namespace App\Models;

use Carbon\Carbon;
//use App\Models\Address;
use App\Traits\ImageTrait;
use App\Traits\ReviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Shop extends Model
{
	use ImageTrait, ReviewTrait, Notifiable, HasTranslations;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'trial_ends_at'];

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'owner_id',
		'name',
		'last_name',
		'legal_name',
		'email',
		'slug',
		'description',
		'external_url',
		'timezone_id',
		'current_billing_plan',
		'stripe_id',
		'card_holder_name',
		'card_brand',
		'card_last_four',
		'trial_ends_at',
		'image_cover',
		'image_avatar',
		'active',
		'country_id'
	];				
	
	public $translatable = ['name', 'last_name', 'description'];
	
    /**
     * Get the address for the shop.
     */
    public function address()
    {
		return $this->morphOne(Address::class, 'addressable')->where('addressable_type','App\Models\Shop');
    }
	
    /**
     * Get the reviews for the shop.
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('reviewable_type','App\Models\Shop');
    }

    /**
     * Get the products for the shop.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
	
    /**
     * Get the products for the shop.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Get the user that owns the shop.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->withTrashed();
    }
}
