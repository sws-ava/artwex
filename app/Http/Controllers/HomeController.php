<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Product;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Shop;
use App\Models\Slider;
use App\Models\Idea;
use App\Models\Wishlist;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$paintings = Product::active()->latest()->limit(6)->get();
		foreach ($paintings as $key => $val) {
			if (count($val->images)) {
				$orientation = check_image_orientation(storage_path("app/public/".$val->images[0]->path));
				if ($orientation == 'landscape') {
					$paintings[$key]->col = 'col-12 col-sm-12 col-lg-6';
				} else {
					$paintings[$key]->col = 'col-12 col-sm-6 col-lg-4';
				}
			} else {
				$paintings[$key]->col = 'col-12 col-sm-6 col-lg-4';
			}
		}
		$sculptures = Product::active()->latest()->limit(9)->get();
		$sales = Product::active()->where('oldprice', '>', 0)->get();
		$shops = Shop::latest()->limit(9)->get();
		$sliders = Slider::get();
		$categories = Category::get();
        return view('index', compact('paintings', 'sculptures', 'categories', 'shops', 'sliders', 'sales'));
    }
	
	public function inspiration() 
	{
		$ideas = Idea::limit(9)->get();
		return view('inspiration', compact('ideas'));
	}	
	
	public function artists() 
	{
		$shops = Shop::latest()->limit(9)->get();
		return view('artist', compact('shops'));
	}
	
	public function artist($artist) 
	{
		$artist = Shop::where('slug', $artist)->first();
		return view('artist_single', compact('artist'));
	}	
	
	public function popular() 
	{
		$populars = Product::where('is_popular', 1)->get();
		return view('popular', compact('populars'));
	}
	
	public function sale() 
	{
		$sales = Product::where('oldprice', '>', 0)->get();
		return view('sale', compact('sales'));
	}
	
	public function about() 
	{
		return view('about');
	}		
	
	public function order_art() 
	{
		$faqs = Faq::where('hide', 0)->get();
		return view('order_art', compact('faqs'));
	}	
	
	public function contact() 
	{
		return view('contact');
	}
	
	public function profile()
    {
        return view('profile');
    }
	
	public function openPage($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('page', compact('page'));
    }
}
