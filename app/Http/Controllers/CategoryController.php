<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
		$categories = Category::get();
        return view('category', compact('categories'));
    }
	
	public function categories()
    {
		$categories = Category::get();
        return view('category', compact('categories'));
    }
}
