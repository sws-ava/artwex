<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\ImageTrait;

class Slider extends Model
{
    use ImageTrait, HasFactory, HasTranslations;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'title_color', 'sub_title', 'sub_title_color', 'background_color', 'button_color', 'link', 'image'];
	
	public $translatable = ['title', 'sub_title'];
}
