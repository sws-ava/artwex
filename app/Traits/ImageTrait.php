<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Attach this Trait to a controller where need image
 */
trait ImageTrait {

	/**
	 * Check if model has an images.
	 *
	 * @return bool
	 */
	public function hasImages()
	{
		return (bool) $this->images()->count();
	}

	/**
	 * Return collection of images related to the imagetrait
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function images()
    {
        return $this->morphMany(\App\Models\Image::class, 'imagetrait')
        ->where(function($q){
        	$q->whereNull('featured')->orWhere('featured', 0);
        })->orderBy('order', 'asc');
    }

	/**
	 * Return the image related to the imagetrait
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imagetrait')->orderBy('order', 'asc');
    }

	/**
	 * Return the logo related to the logoable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function logo()
    {
        return $this->morphOne(\App\Models\Image::class, 'imagetrait')->where('featured','!=',1);
    }

	/**
	 * Return the banner background related to the banner background img
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function bannerbg()
    {
        return $this->morphOne(\App\Models\Image::class, 'imagetrait')->where('featured','!=',1);
    }

	/**
	 * Return the featured Image related to the imagetrait
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function featuredImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imagetrait')->where('featured',1);
    }

	/**
     * Save images
     *
     * @param  file  $image
     *
     * @return image model
	 */
	public function saveImage($image, $featured = null)
	{
        $path = Storage::put('images', $image);

        return $this->createImage($path, $image->getClientOriginalName(), $image->getClientOriginalExtension(), $image->getSize(), $featured);
	}

	/**
     * Save images in table field
     *
     * @param  file  $image
     *
     * @return image model
	 */
	public function saveImageTable($image, $table, $field, $id)
	{
        $path = Storage::put('images', $image);
		
		\DB::table($table)->where('id',$id)->update([$field => $path]);

        return true;
	}

	/**
     * Save images from external URL
     *
     * @param  file  $image
     *
     * @return image model
	 */
	public function saveImageFromUrl($url, $featured = null)
	{
		// Get file info and validate
    	$file_info = get_headers($url, TRUE);
    	if( ! isset($file_info['Content-Length']) ) return;

    	// Get file size
    	$size = $file_info['Content-Length'];
    	if(is_array($size))
	    	$size =  array_key_exists(1, $size) ? $size[1] : $size[0];

    	// Get file ext
    	$extension = substr($url, strrpos($url, '.', -1) + 1);
    	$extension = in_array($extension, config('image.mime_types')) ? $extension : 'jpeg';

    	// Make path and upload
		$path = image_storage_dir() . '/' . str_random(40) . '.' . $extension;
    	Storage::put($path, file_get_contents($url));

        return $this->createImage($path, $url, $extension, $size, $featured);
	}

	/**
	 * Deletes the given image.
	 *
	 * @return bool
	 */
	public function deleteImage($image = Null)
	{
		if (!$image)
			$image = $this->image;

		if (optional($image)->path) {
	    	Storage::delete($image->path);
			//Storage::deleteDirectory(image_cache_path($image->path));
		    return $image->delete();
		}

		return;
	}

	/**
	 * Deletes the Featured Image of this model.
	 *
	 * @return bool
	 */
	public function deleteFeaturedImage()
	{
		if($img = $this->featuredImage)
			$this->deleteImage($img);
		return;
	}

	/**
	 * Deletes the Brand Logo Image of this model.
	 *
	 * @return bool
	 */
	public function deleteLogo()
	{
		if($img = $this->logo)
			$this->deleteImage($img);
		return;
	}

	/**
	 * Deletes all the images of this model.
	 *
	 * @return bool
	 */
	public function flushImages()
	{
		foreach ($this->images as $image)
			$this->deleteImage($image);

		$this->deleteLogo();
		$this->deleteFeaturedImage();

		return;
	}

	/**
	 * Create image model
	 *
	 * @return array
	 */
	private function createImage($path, $name, $ext = '.jpeg', $size = Null, $featured = Null)
	{
        return $this->image()->create([
            'path' => $path,
            'name' => $name,
            'extension' => $ext,
            'featured' => (bool) $featured,
            'size' => $size,
        ]);
	}

	/**
	 * Prepare the previews for the dropzone
	 *
	 * @return array
	 */
	public function previewImages()
	{
		$urls = '';
		$configs = '';

		foreach ($this->images as $image) {
	    	Storage::url($image->path);
            $path = Storage::url($image->path);
            $deleteUrl = route('image.delete', $image->id);
            $urls .= '"' .$path . '",';
            $configs .= '{caption:"' . $image->name . '", size:' . $image->size . ', url: "' . $deleteUrl . '", key:' . $image->id . '},';
		}

		return [
			'urls' => rtrim($urls, ','),
			'configs' => rtrim($configs, ',')
		];
	}
	
	public function getImagePath($item = null, $size = 'medium', $type = 'primary', $node = 'Product')
    {
        /*if (is_int($item) && !($item instanceof \App\Models\{$node}))
            $item = \App\Models\{$node}::findorFail($item);*/

        $images_count = $item->images->count();

        // If the listing has no images then pick the product images
        if( ! $images_count ) {
            $item = $item->product;
            $images_count = $item->images->count();
        }

        if($images_count) {
            if($type == 'alt' && $images_count > 1) {
                $imgs = $item->images->toArray();
                $path = $imgs[1]['path'];
            }
            else{
                $path = $item->images->first()->path;
            }
            return Storage::url("image/{$path}?p={$size}");
        }

        return asset('images/placeholders/no_img.png');
    }
}