<?php

namespace App\Traits;

trait ReviewTrait {

	/**
	 * Check if model has any Reviews.
	 *
	 * @return bool
	 */
	public function hasReviews()
	{
		return (bool) $this->reviews()->count();
	}

	/**
	 * Return collection of Reviews related to the replied model
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function Reviews()
	{
        return $this->morphMany(\App\Models\Review::class, 'reviewable')->orderBy('created_at', 'DESC');
	}

	public function averageFeedback()
    {
        return $this->morphMany(\App\Models\Review::class, 'reviewable')->avg('rating');
    }

    public function sumFeedback()
    {
        return $this->reviews()->sum('rating');
    }
	
    public function userAverageFeedback()
    {
        return $this->reviews()->where('customer_id', \Auth::guard('web')->id())->avg('rating');
    }
	
    public function userSumFeedback()
    {
        return $this->reviews()->where('customer_id', \Auth::guard('web')->id())->sum('rating');
    }
	
    public function ratingPercent($max = 5)
    {
        $quantity = $this->reviews()->count();
        $total = $this->sumFeedback();
        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }
}