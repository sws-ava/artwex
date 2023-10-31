<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Shop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products_count = Product::all()->count();
        $categories_count = Category::all()->count();
        $contacts_count = Contact::all()->count();
        $shops_count = Shop::all()->count();
        $orders_count = Order::all()->count();

        return view('admin.home.index', [
            'products_count' => $products_count,
            'categories_count' => $categories_count,
            'shops_count' => $shops_count,
            'contacts_count' => $contacts_count,
            'orders_count' => $orders_count,
        ]);
    }
}
