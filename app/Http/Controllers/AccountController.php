<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Shop;
use App\Models\Role;
use App\Models\Review;
use App\Models\Language;
use App\Models\Country;
use App\Models\Currency;
use App\Helpers\CatalogHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAvatarUpdateRequest;
use App\Http\Requests\CustomerPasswordUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Show the customer dashboard.
     *
     * @return Response
     */
    public function index()
    {   		
		$user = User::where('id', Auth::user()->id)->first();
		$wishlist = Wishlist::mine()->whereHas('product')->with(['product', 'product.reviews:rating,reviewable_id,reviewable_type', 'product.images:path,imagetrait_id,imagetrait_type'])->paginate(7);
        return view('dashboard.profile', compact('user', 'wishlist'));
    }

    /**
     * Return wishlist
     * @return collection
     */
    public function wishlist()
    {
		$user = User::where('id', Auth::user()->id)->first();
		$wishlist = Wishlist::mine()->whereHas('product')->with(['product', 'product.reviews:rating,reviewable_id,reviewable_type', 'product.images:path,imagetrait_id,imagetrait_type'])->paginate(7);
		
        /*$wishlist = Wishlist::mine()->paginate(7);
		foreach ($wishlist as $item) {
			$products[] = Product::where('id', $item['product_id'])->with(['reviews:rating,reviewable_id,reviewable_type', 'images:path,imagetrait_id,imagetrait_type'])->firstOrFail();
		}*/
		
		//echo '<pre>'; print_r($wishlist); exit();
		return view('dashboard.wishlist', compact('user','wishlist'));
    }
	
	/**
     * Return history
     * @return collection
     */
    public function history()
    {
		$user = User::where('id', Auth::user()->id)->first();
		return view('dashboard.history', compact('user'));
	}	
	
	/**
     * Return settings
     * @return collection
     */
    public function settings()
    {
		$user = User::where('id', Auth::user()->id)->first();
		$languages = Language::where(['language_active' => 1])->get();
		$currencies = Currency::get();
		$countries = Country::get();
		return view('dashboard.settings', compact('user', 'languages', 'currencies', 'countries'));
	}
	
    /**
     * Return product
     * @return collection
     */
    public function products()
    {
		$products = Product::mine()->orderBy('id','desc')->paginate(10);
		$trashed = Product::mine()->onlyTrashed()->with('categories')->get();
		return view('dashboard.products', compact('products', 'trashed'));
    }	
    /**
     * Return product
     * @return collection
     */
    public function reviews()
    {
		$user = User::where('id', Auth::user()->id)->first();
		
		if ($user->type == 'seller') {
			$products = $user->shop->products;
			$array = [];
			foreach ($products as $product) {
				$array[] = $product->id;
			}
			
			$reviews = Review::whereIn('reviewable_id', $array)->with(['product:id,name,slug'])->get();
		} else {
			$reviews = Review::where('customer_id', $user->id)->with(['product:id,name,slug'])->get();
		}
		//echo '<pre>'; print_r($reviews); exit();

		return view('dashboard.reviews', compact('reviews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Auth::guard('web')->user()->update($request->all());

        return redirect()->route('account', 'account#settings')->with('success', trans('notify.info_updated'));
    }
	
	public function editPasswordProfileForm(User $user)
    {
        return view('dashboard.settings_password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(CustomerPasswordUpdateRequest $request)
    {
        Auth::guard('web')->user()->fill([
            'password' => $request->input('password'),
        ])->save();

        return redirect()->route('profile.settings')->with('success', trans('notify.info_updated'));
    }

    public function avatar(CustomerAvatarUpdateRequest $request)
    {
        Auth::guard('web')->user()->deleteImage();

        Auth::guard('web')->user()->saveImage($request->file('avatar'));

        return redirect()->route('account', 'account#settings')->with('success', trans('notify.info_updated'));
    }

    public function delete_avatar(Request $request)
    {
        Auth::guard('web')->user()->deleteImage();

        return redirect()->route('account', 'account#settings')->with('success', trans('notify.info_deleted'));
    }
    
    public function editProfileForm(User $user)
    {
        $countries = Country::select('*')->active()->orderBy('strong_position')->get();
        $user = User::find(auth()->user()->id);
        $shop = Shop::where('id',$user->shop_id)->firstOrFail();
        $address = $shop->address;
		if (!empty($address->phone)) {
        $phone = explode('#',$address->phone);
        $address->phone_code = $phone[0];
        $address->phone = $phone[1];
		} 
        return view('dashboard.settings',compact('countries','user','address','shop'));
    }
    public function storeProfileForm(Request $request)
    {
        $user = User::find(auth()->user()->id);
       
        $user->name = empty($request->name)?$user->name:$request->name;
        $user->last_name = empty($request->last_name)?$user->last_name:$request->last_name;
        $user->country_id = empty($request->country_id)?$user->country_id:$request->country_id;
        $user->language_id = empty($request->language_id)?$user->language_id:$request->language_id;
        $user->currency_id = empty($request->currency_id)?$user->currency_id:$request->currency_id;
        $user->login = empty($request->login)?$user->login:$request->login;
		
        $user->save();
		
		$user = new User();
		if ($request->hasFile('avatar_image')) {
            $user->saveImageTable($request->file('avatar_image'), 'users', 'image_avatar', $request->model_id);
		}
        
        return redirect()->route('profile.settings')->with('success', trans('notify.info_updated'));
    }
	
	public function store_cover(Request $request) 
	{
		
		$user = new User();
		
		if ($request->hasFile('cover_image')) {
            $user->saveImageTable($request->file('cover_image'), 'users', 'image_cover', $request->model_id);
		}		
		
		if ($request->hasFile('avatar_image')) {
            $user->saveImageTable($request->file('avatar_image'), 'users', 'image_avatar', $request->model_id);
		}
		
		return response()->json(array('success'=>true),200);
	}	
}
