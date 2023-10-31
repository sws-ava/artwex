<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\ImageTrait;

class Idea extends Model
{
    use ImageTrait, HasFactory, HasTranslations;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ideas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'short_content', 'content', 'image'];
	
	public $translatable = ['title', 'short_content', 'content'];
}
