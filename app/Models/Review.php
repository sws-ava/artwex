<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';
	
	    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'customer_id',
		'rating',
		'parent_id',
		'comment',
		'reviewable_id',
		'reviewable_type',
		'moderated',
		'created_at',
	];
	
    /**
     * Get the customer associated with the model.
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
	
	public function product()
	{
		return $this->belongsTo(Product::class, 'reviewable_id');
	}

    /**
     * Set the rating for the model.
     */
    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = $value ? (int) $value : 1;
    }
}
