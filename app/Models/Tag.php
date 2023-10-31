<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

	/**
     * Get all of the customers that are assigned this tag.
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    /**
     * Get all of the shops that are assigned this tag.
     */
    public function shops()
    {
        return $this->belongsToMany(Shop::class);
    }

    /**
     * Get all of the products that are assigned this tag.
     */
    public function products()
    {
		return $this->belongsToMany(Product::class);
    }

	public static function syncTags($product, array $tagIds)
    {
        $tags = [];
        foreach ($tagIds as $id){
            if (is_numeric($id)){
                $tags[] =  $id;
            }else{
                $newTag = Tag::firstOrCreate(['name' => $id]);
                $tags[] = $newTag->id;
            }
        }

        return $product->tags()->sync($tags);
    }
	
}
