<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promocode;
use Darryldecode\Cart\CartCondition;

use Cart;
use Session;

class CartController extends Controller
{
    public function index() {
		$products = Cart::session(Session::getId())->getContent();
		
		$subTotal = Cart::session(Session::getId())->getSubTotal();
		$condition = Cart::session(Session::getId())->getCondition('Promocode');
		
		$messageErrorPromocode = \session('errorPromocode');
		
		$is_promocode = $condition ? true : false;
		if ($is_promocode) {
			$promocode = Promocode::where(['promocode' => $condition->getType()])->first();
			$conditionCalculatedValue = $condition->getCalculatedValue($subTotal);
		} else {
			$promocode = '';
			$conditionCalculatedValue = 0;
		}
		
		return view('cart', compact('products', 'is_promocode', 'promocode', 'subTotal', 'conditionCalculatedValue'))->with('messageErrorPromocode', $messageErrorPromocode);
	}
	
	public function add(Request $request) {
		$product = Product::query()->where(['id' => $request->id])->first();
		
		$session_id = Session::getId();
		
		Cart::session($session_id)->add([
			'id' => $product->id,
			'name' => $product->name,
			'price' => $product->price,
			'quantity' => 1,
			'atributes' => [
				'image' => $product->image,
				'type' => $request->type				
			],
			'associatedModel' => $product
		]);
		
		return redirect()->back();
	}
	
	public function delete(Request $request) {
		Cart::session(Session::getId())->remove($request->id);
		
		return redirect()->back();
	}
	
	public function update(Request $request) {
		//Cart::session(Session::getId())->remove($rowId);

	}
	
	public function set_promocode(Request $request) {
		$promocode = Promocode::where('promocode', $request->promocode)->where('used', 0)->first();
		if ($promocode) {
			$coupon101 = new CartCondition(array(
				'name' => 'Promocode',
				//'code' => $promocode->promocode,
				'type' => $promocode->promocode,
				'value' => '-'.$promocode->sale.'%',
			));
			/*$products = Cart::session(Session::getId())->getContent();
			foreach ($products as $product) {
				Cart::session(Session::getId())->addItemCondition($product->id, $coupon101);
			}*/
			Cart::session(Session::getId())->condition($coupon101);
		} else {
			Session::flash('errorPromocode', 'Wrong promocode: '.$request->promocode);
		}
		
		return redirect()->back(); 
	}
	
	public function checkout() {
		$cart_total = Cart::session(Session::getId())->getTotal();
		
		$subTotal = Cart::session(Session::getId())->getSubTotal();
		$condition = Cart::session(Session::getId())->getCondition('Promocode');
		
		$messageErrorPromocode = \session('errorPromocode');
		
		$is_promocode = $condition ? true : false;
		if ($is_promocode) {
			$promocode = Promocode::where(['promocode' => $condition->getType()])->first();
			$conditionCalculatedValue = $condition->getCalculatedValue($subTotal);
		} else {
			$promocode = '';
			$conditionCalculatedValue = 0;
		}

		return view('checkout', compact('cart_total', 'promocode', 'is_promocode', 'subTotal', 'conditionCalculatedValue'))->with('messageErrorPromocode', $messageErrorPromocode);
	}
}
