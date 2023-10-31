<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shop;
use App\Models\Tag;
use App\Models\Language;
use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Repositories\Shop\ShopRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
	private $model;
	
	private $shop;

    /**
     * construct
     */
    public function __construct(ShopRepository $shop)
    {
        parent::__construct();

        $this->model = 'Artist';

        $this->shop = $shop;
    }
	
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderBy('created_at', 'desc')->get();

        return view('admin.shop.index', [
            'shops' => $shops
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$countries = Country::orderBy('name')->pluck('name', 'id');
		$tags = Tag::orderBy('name', 'asc')->pluck('name', 'id');
		$languages = Language::active()->get();
		
        return view('admin.shop.create',compact('countries','tags', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShopRequest $request)
    {
		$shop = $this->shop->store($request);

        return redirect()->back()->withSuccess('Художник был успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$shop = $this->shop->find($id);
		
		$countries = Country::orderBy('name')->where('id', $shop->country_id)->pluck('name', 'id');
		$tags = Tag::orderBy('name', 'asc')->pluck('name', 'id');

        $preview = $shop->previewImages();
		
		$languages = Language::active()->get();
		
        return view('admin.shop.edit', [
            'shop' => $shop,
			'tags' => $tags,
			'languages' => $languages,
			'countries' => $countries,
			'preview' => $preview
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, $id)
    {	
		$shop = $this->shop->update($request, $id);

        return redirect()->back()->withSuccess('Художник был успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->back()->withSuccess('Художник был успешно удален!');
    }
}
