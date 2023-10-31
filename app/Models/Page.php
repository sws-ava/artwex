<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\ImageTrait;

class Page extends Model
{
    use ImageTrait, HasFactory, SoftDeletes, HasTranslations;
	
	const VISIBILITY_PUBLIC = 1;         //Default	
	const VISIBILITY_MERCHANT = 2;         //Default	
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'author_id',
        'title',
        'slug',
        'content',
        'published_at',
        'position',
        'visibility',
    ];
	
	public $translatable = ['title', 'content'];
	
    /**
     * Set the published_at for the model.
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? date('Y-m-d H:i:s', strtotime($value)) : null;
        // if ($value) $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d h:i a', $value);
    }

    /**
     * Scope a query to only include published blogs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<', Carbon::now());
    }

    /**
     * Scope a query to only include records that have the given visibility.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibilityOf($query, $visibility)
    {
        return $query->where('visibility', $visibility);
    }	
	
	public function viewPosition()
    {
        switch ($this->position) {
            case 'copyright_area':
                return trans('app.copyright_area');
            case 'footer_1st_column':
                return trans('app.footer_1st_column');
            case 'footer_2nd_column':
                return trans('app.footer_2nd_column');
            case 'footer_3rd_column':
                return trans('app.footer_3rd_column');
            case 'main_nav':
                return trans('app.main_nav');
        }
    }
	
    public function visibilityName()
    {
        switch ($this->visibility) {
            case static::VISIBILITY_PUBLIC:
                return '<span class="label label-primary">' . trans('app.public') . '</span>';
            case static::VISIBILITY_MERCHANT:
                return '<span class="label label-outline">' . trans('app.merchants') . '</span>';
        }
    }
}
