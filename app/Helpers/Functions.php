<?php 
if (!function_exists('getMinNumberOfRequiredImgsForInventory')) {
    /**
     * Return Min Number Of Required Imgs For Inventory to upload per item
     */
    function getMinNumberOfRequiredImgsForInventory()
    {
        return config('system_settings.min_number_of_inventory_imgs', 0);
    }
}

if (!function_exists('getMaxNumberOfImgsForInventory')) {
    /**
     * Return max_number_of_inventory_imgs allowed to upload per item
     */
    function getMaxNumberOfImgsForInventory()
    {
        return config('system_settings.max_number_of_inventory_imgs', 10);
    }
}

if (!function_exists('getAllowedMinImgSize')) {
    /**
     * Return min_img_size_limit_kb allowed to upload
     */
    function getAllowedMinImgSize()
    {
        return config('system_settings.min_img_size_limit_kb') ?? config('image.min_size', 0);
    }
}

if (!function_exists('getAllowedMaxImgSize')) {
    /**
     * Return max_img_size_limit_kb allowed to upload
     */
    function getAllowedMaxImgSize()
    {
        return config('system_settings.max_img_size_limit_kb') ?? config('image.max_size', 1024);
    }
}

if (!function_exists('image_storage_dir')) {
    function image_storage_dir()
    {
        return config('image.dir');
    }
}

if (!function_exists('temp_storage_dir')) {
    function temp_storage_dir($dir = '')
    {
        return Str::finish(public_path("temp/{$dir}"), '/');
    }
}

if (!function_exists('get_qualified_model')) {
    function get_qualified_model($class_name = '')
    {
        return 'App\\Models\\' . Str::singular(Str::studly($class_name));
    }
}

if (!function_exists('image_cache_path')) {
    function image_cache_path($path = null)
    {
        $path = config('image.cache_dir') . '/' . $path;

        return Str::finish($path, '/');
    }
}

if (!function_exists('get_page_url')) {
    /**
     * Return page url
     */
    function get_page_url($page = null)
    {
        if ($page == null) {
            return url('/');
        }

        return route('page.open', $page);
    }
}
if (!function_exists('check_image_orientation')) {
	function check_image_orientation($image_path)
    {
		list($width, $height) = getimagesize($image_path);

		if( $width > $height) {
			$orientation = "landscape";
		} else {
			$orientation = "portrait";
		}
		
		return $orientation;
    }

}