<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ArtHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Shop;
use App\Models\Language;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	private $model;
	
	private $product;

    /**
     * construct
     */
    public function __construct(ProductRepository $product)
    {
        parent::__construct();

        $this->model = 'Товар';

        $this->product = $product;
    }
	
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Category::orderBy('name')->pluck('name', 'id');
		$shops = Shop::orderBy('name')->pluck('name', 'id');
		$tags = Tag::orderBy('name', 'asc')->pluck('name', 'id');
		$languages = Language::active()->get();
		
        return view('admin.product.create',compact('categories','tags', 'shops', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
		$product = $this->product->store($request);

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$product = $this->product->find($id);
		
		$categories = Category::orderBy('name')->pluck('name', 'id');
		//$shops = Shop::orderBy('name')->where('id', $product->shop_id)->pluck('name', 'id');
		$shops = Shop::orderBy('name')->pluck('name', 'id');
		$tags = Tag::orderBy('name', 'asc')->pluck('name', 'id');
		$languages = Language::active()->get();
        $preview = $product->previewImages();
		
		$attributes = ArtHelper::getAttributesBy($product);
		
        return view('admin.product.edit', [
            'product' => $product,
			'attributes' => $attributes,
			'tags' => $tags,
			'categories' => $categories,
			'shops' => $shops,
			'languages' => $languages,
			'preview' => $preview
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->product->update($request, $id);

        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->withSuccess('Товар был успешно удален!');
    }
	
    /**
     * return json params to procceed the form
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($product)
    {
        return [
            'id' => $product->id,
            'model' => 'product',
            'redirect' => route('product.index'),
        ];
    }
}
