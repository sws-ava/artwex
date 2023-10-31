<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('image.')->group(function () {
  Route::get('download/{image}', [
    ImageController::class, 'download'
  ])->name('download');

  Route::post('delete/{image}', [
    ImageController::class, 'delete'
  ])->name('delete');

  Route::post('upload', [
    ImageController::class, 'upload'
  ])->name('upload');

  Route::post('image/sort', [
    ImageController::class, 'sort'
  ])->name('sort');
});


Route::get('/clear-cache', function() {
	Artisan::call('config:clear');
	Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('view:clear');

	// cache
	Artisan::call('config:cache');
	Artisan::call('route:cache');

	return "Cache is cleared";
});

	Auth::routes();

    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::get('/home', [HomeController::class, 'index'])->name('homepage.more');
	Route::get('/inspiration', [HomeController::class, 'inspiration'])->name('inspiration');
	Route::get('/artists', [HomeController::class, 'artists'])->name('artists');
	Route::get('artists/{artist}', [HomeController::class, 'artist'])->name('show.artist');
	Route::get('/popular', [HomeController::class, 'popular'])->name('popular');
	Route::get('/sale', [HomeController::class, 'sale'])->name('sale');
	Route::get('/about', [HomeController::class, 'about'])->name('about');
	Route::get('/order_art', [HomeController::class, 'order_art'])->name('order_art');
	Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
	Route::get('page/{page}', [HomeController::class, 'openPage'])->name('page.open');
	//Route::get('page/{page}', [HomeController::class, 'page'])->name('page.footer');
	Route::get('categories', [CategoryController::class, 'categories'])->name('categories');
	Route::get('category/{slug}', [CategoryController::class, 'browseCategory'])->name('category.browse');
    Route::get('product/{slug}', [ProductController::class, 'index'])->name('show.product');
	Route::get('search', [SearchController::class, 'search'])->name('inCategoriesSearch');
	//Route::get('shop', [ShopController::class, 'index'])->name('shop');
	Route::get('shop/{slug}', [ShopController::class, 'index'])->name('shop');
	Route::get('cart', [CartController::class, 'index'])->name('cart');
	Route::get('cart/add', [CartController::class, 'add'])->name('cart.add');
	Route::get('cart/update', [CartController::class, 'update'])->name('cart.update');
	Route::get('cart/delete', [CartController::class, 'delete'])->name('cart.delete');
	Route::post('set_promocode', [CartController::class, 'set_promocode'])->name('set_promocode');
	Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
	
Route::middleware(['role:user|admin'])->prefix('profile')->group(function () {
	Route::get('/', [AccountController::class, 'index'])->name('profile');
	Route::get('wishlist', [AccountController::class, 'wishlist'])->name('profile.wishlist');
	Route::get('history', [AccountController::class, 'history'])->name('profile.history');
	Route::get('settings', [AccountController::class, 'settings'])->name('profile.settings');
	
	Route::get('/edit', [AccountController::class, 'editProfileForm'])->name('profile.edit');
	Route::get('/editpassword', [AccountController::class, 'editPasswordProfileForm'])->name('profile.editpassword');
    Route::post('/edit', [AccountController::class, 'storeProfileForm'])->name('profile.edit.submit');
	Route::post('/updatepassword', [AccountController::class, 'updatePassword'])->name('profile.updatepassword');
	Route::post('/uploadcover', [AccountController::class, 'store_cover'])->name('image.upload.cover');

	Route::get('wishlist/{item}', [WishlistController::class, 'add'])->name('wishlist.add');
	Route::delete('wishlist/{wishlist}', [WishlistController::class, 'remove'])->name('wishlist.remove');	
	
	Route::get('review', [ReviewController::class, 'index'])->name('review.index');
	Route::post('product/{slug}/review', [ReviewController::class, 'create_review_product'])->name('review.product.add');
});
	
Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin'); // /admin
	
	Route::get('product/index', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');
	Route::get('product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create');
	Route::post('product/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store');	
	Route::get('product/store/publish', [App\Http\Controllers\Admin\ProductController::class, 'publish'])->name('product.setpublish');
	Route::get('product/{product}/unpublish', [App\Http\Controllers\Admin\ProductController::class, 'store_unpublish'])->name('product.unpublish');
    Route::post('product/store/publish/submit', [App\Http\Controllers\Admin\ProductController::class, 'store_publish'])->name('product.publish');
	Route::get('product/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
	Route::post('product/{product}/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
	Route::get('product/{product}/restore', [App\Http\Controllers\Admin\ProductController::class, 'restore'])->name('product.restore');
	Route::delete('product/{product}/trash', [App\Http\Controllers\Admin\ProductController::class, 'trash'])->name('product.trash');
	Route::delete('product/{product}/destroy', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('product.destroy');	
	Route::get('product/getProducts', [App\Http\Controllers\Admin\ProductController::class, 'getProducts'])->name('product.getMore');
	
	Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
	Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
	Route::post('category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');	
	Route::get('category/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
	Route::put('category/{category}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
	Route::delete('category/{category}/destroy', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');	
	Route::delete('category/{category}/trash', [App\Http\Controllers\Admin\CategoryController::class, 'trash'])->name('category.trash');
	Route::get('category/{category}/restore', [App\Http\Controllers\Admin\CategoryController::class, 'restore'])->name('category.restore');
	Route::get('category/getMoreCategories', [App\Http\Controllers\Admin\CategoryController::class, 'getCategories'])->name('category.getMore')->middleware('ajax');	
	
	Route::get('shop', [App\Http\Controllers\Admin\ShopController::class, 'index'])->name('shop.index');
	Route::get('shop/create', [App\Http\Controllers\Admin\ShopController::class, 'create'])->name('shop.create');
	Route::post('shop/store', [App\Http\Controllers\Admin\ShopController::class, 'store'])->name('shop.store');	
	Route::get('shop/{shop}/edit', [App\Http\Controllers\Admin\ShopController::class, 'edit'])->name('shop.edit');
	Route::put('shop/{shop}/update', [App\Http\Controllers\Admin\ShopController::class, 'update'])->name('shop.update');
	Route::delete('shop/{shop}/destroy', [App\Http\Controllers\Admin\ShopController::class, 'destroy'])->name('shop.destroy');	
	Route::delete('shop/{shop}/trash', [App\Http\Controllers\Admin\ShopController::class, 'trash'])->name('shop.trash');
	Route::get('shop/{shop}/restore', [App\Http\Controllers\Admin\ShopController::class, 'restore'])->name('shop.restore');
			
	Route::get('faq', [App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faq.index');
	Route::get('faq/create', [App\Http\Controllers\Admin\FaqController::class, 'create'])->name('faq.create');
	Route::post('faq/store', [App\Http\Controllers\Admin\FaqController::class, 'store'])->name('faq.store');	
	Route::get('faq/{faq}/edit', [App\Http\Controllers\Admin\FaqController::class, 'edit'])->name('faq.edit');
	Route::put('faq/{faq}/update', [App\Http\Controllers\Admin\FaqController::class, 'update'])->name('faq.update');
	Route::delete('faq/{faq}/destroy', [App\Http\Controllers\Admin\FaqController::class, 'destroy'])->name('faq.destroy');	
	Route::delete('faq/{faq}/trash', [App\Http\Controllers\Admin\FaqController::class, 'trash'])->name('faq.trash');
	Route::get('faq/{faq}/restore', [App\Http\Controllers\Admin\FaqController::class, 'restore'])->name('faq.restore');	
	
	Route::get('attribute', [App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('attribute.index');
	Route::get('attribute/create', [App\Http\Controllers\Admin\AttributeController::class, 'create'])->name('attribute.create');
	Route::post('attribute/store', [App\Http\Controllers\Admin\AttributeController::class, 'store'])->name('attribute.store');	
	Route::get('attribute/{faq}/edit', [App\Http\Controllers\Admin\AttributeController::class, 'edit'])->name('attribute.edit');
	Route::put('attribute/{faq}/update', [App\Http\Controllers\Admin\AttributeController::class, 'update'])->name('attribute.update');
	Route::delete('attribute/{faq}/destroy', [App\Http\Controllers\Admin\AttributeController::class, 'destroy'])->name('attribute.destroy');	
	Route::delete('attribute/{faq}/trash', [App\Http\Controllers\Admin\AttributeController::class, 'trash'])->name('attribute.trash');
	Route::get('attribute/{faq}/restore', [App\Http\Controllers\Admin\AttributeController::class, 'restore'])->name('attribute.restore');
	Route::post('attribute/reorder', [App\Http\Controllers\AttributeController::class, 'reorder'])->name('attribute.reorder');	
	
	Route::get('attributeValue', [App\Http\Controllers\Admin\AttributeValueController::class, 'index'])->name('attributeValue.index');
	Route::get('attributeValue/create', [App\Http\Controllers\Admin\AttributeValueController::class, 'create'])->name('attributeValue.create');
	Route::post('attributeValue/store', [App\Http\Controllers\Admin\AttributeValueController::class, 'store'])->name('attributeValue.store');	
	Route::get('attributeValue/{faq}/edit', [App\Http\Controllers\Admin\AttributeValueController::class, 'edit'])->name('attributeValue.edit');
	Route::put('attributeValue/{faq}/update', [App\Http\Controllers\Admin\AttributeValueController::class, 'update'])->name('attributeValue.update');
	Route::delete('attributeValue/{faq}/destroy', [App\Http\Controllers\Admin\AttributeValueController::class, 'destroy'])->name('attributeValue.destroy');	
	Route::delete('attributeValue/{faq}/trash', [App\Http\Controllers\Admin\AttributeValueController::class, 'trash'])->name('attributeValue.trash');
	Route::get('attributeValue/{faq}/restore', [App\Http\Controllers\Admin\AttributeValueController::class, 'restore'])->name('attributeValue.restore');
	Route::post('attributeValue/reorder', [App\Http\Controllers\AttributeValueController::class, 'reorder'])->name('attributeValue.reorder');
				
	Route::get('promocode', [App\Http\Controllers\Admin\PromocodeController::class, 'index'])->name('promocode.index');
	Route::get('promocode/create', [App\Http\Controllers\Admin\PromocodeController::class, 'create'])->name('promocode.create');
	Route::post('promocode/store', [App\Http\Controllers\Admin\PromocodeController::class, 'store'])->name('promocode.store');	
	Route::get('promocode/{promocode}/edit', [App\Http\Controllers\Admin\PromocodeController::class, 'edit'])->name('promocode.edit');
	Route::put('promocode/{promocode}/update', [App\Http\Controllers\Admin\PromocodeController::class, 'update'])->name('promocode.update');
	Route::delete('promocode/{promocode}/destroy', [App\Http\Controllers\Admin\PromocodeController::class, 'destroy'])->name('promocode.destroy');	
	Route::delete('promocode/{promocode}/trash', [App\Http\Controllers\Admin\PromocodeController::class, 'trash'])->name('promocode.trash');
	Route::get('promocode/{promocode}/restore', [App\Http\Controllers\Admin\PromocodeController::class, 'restore'])->name('promocode.restore');
	
	Route::get('translation', [App\Http\Controllers\Admin\TranslationController::class, 'index'])->name('translation.index');
	Route::get('translation/create', [App\Http\Controllers\Admin\TranslationController::class, 'create'])->name('translation.create');
	Route::post('translation/store', [App\Http\Controllers\Admin\TranslationController::class, 'store'])->name('translation.store');	
	Route::get('translation/{translation}/edit', [App\Http\Controllers\Admin\TranslationController::class, 'edit'])->name('translation.edit');
	Route::put('translation/{translation}/update', [App\Http\Controllers\Admin\TranslationController::class, 'update'])->name('translation.update');
	
	Route::get('page', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('page.index');
	Route::get('page/create', [App\Http\Controllers\Admin\PageController::class, 'create'])->name('page.create');
	Route::post('page/store', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('page.store');	
	Route::get('page/{page}/edit', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('page.edit');
	Route::put('page/{page}/update', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('page.update');
	Route::delete('page/{page}/destroy', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('page.destroy');	
	Route::delete('page/{page}/trash', [App\Http\Controllers\Admin\PageController::class, 'trash'])->name('page.trash');
	Route::get('page/{page}/restore', [App\Http\Controllers\Admin\PageController::class, 'restore'])->name('page.restore');	
	
	Route::get('slider', [App\Http\Controllers\Admin\SliderController::class, 'index'])->name('slider.index');
	Route::get('slider/create', [App\Http\Controllers\Admin\SliderController::class, 'create'])->name('slider.create');
	Route::post('slider/store', [App\Http\Controllers\Admin\SliderController::class, 'store'])->name('slider.store');	
	Route::get('slider/{slider}/edit', [App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('slider.edit');
	Route::put('slider/{slider}/update', [App\Http\Controllers\Admin\SliderController::class, 'update'])->name('slider.update');
	Route::delete('slider/{slider}/destroy', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('slider.destroy');	
	Route::delete('slider/{slider}/trash', [App\Http\Controllers\Admin\SliderController::class, 'trash'])->name('slider.trash');
	Route::get('slider/{slider}/restore', [App\Http\Controllers\Admin\SliderController::class, 'restore'])->name('slider.restore');	
	
	Route::get('idea', [App\Http\Controllers\Admin\IdeaController::class, 'index'])->name('idea.index');
	Route::get('idea/create', [App\Http\Controllers\Admin\IdeaController::class, 'create'])->name('idea.create');
	Route::post('idea/store', [App\Http\Controllers\Admin\IdeaController::class, 'store'])->name('idea.store');	
	Route::get('idea/{idea}/edit', [App\Http\Controllers\Admin\IdeaController::class, 'edit'])->name('idea.edit');
	Route::put('idea/{idea}/update', [App\Http\Controllers\Admin\IdeaController::class, 'update'])->name('idea.update');
	Route::delete('idea/{idea}/destroy', [App\Http\Controllers\Admin\IdeaController::class, 'destroy'])->name('idea.destroy');	
	Route::delete('idea/{idea}/trash', [App\Http\Controllers\Admin\IdeaController::class, 'trash'])->name('idea.trash');
	Route::get('idea/{idea}/restore', [App\Http\Controllers\Admin\IdeaController::class, 'restore'])->name('idea.restore');
	
	Route::post('review/{slug}/create', [App\Http\Controllers\Admin\ReviewController::class, 'create'])->name('review.add');
	Route::delete('review/{review}/destroy', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('review.destroy');
	
	Route::get('order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
	
	Route::get('contact', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contact.index');
	
		// AJAX routes
	Route::middleware('ajax')->group(function () {
		Route::get('catalog/ajax/getParrentAttributeType', [App\Http\Controllers\Admin\AttributeController::class, 'ajaxGetParrentAttributeType'])->name('ajax.getParrentAttributeType');

		Route::get('order/ajax/filterShippingOptions', [App\Http\Controllers\Admin\AjaxController::class, 'filterShippingOptions'])->name('ajax.filterShippingOptions');
	});
});

// Switch between the included languages
Route::get('locale/{locale?}', [
    App\Http\Controllers\LocaleController::class, 'change'
])->name('locale.change');

// To view img no need to login
Route::get('image/{path}', [
    App\Http\Controllers\ImageController::class, 'show'
])->where('path', '.*')->name('image.show');

Route::middleware('ajax')->group(function () {
    // Use php helper functions from js
    Route::get('helper/getFromPHPHelper', [App\Http\Controllers\Admin\AjaxController::class, 'ajaxGetFromPHPHelper'
    ])->name('helper.getFromPHPHelper');
	
});