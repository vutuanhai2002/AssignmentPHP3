<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function cartList()
    {

        $cartItems = \Cart::getContent();
        $category = new Category();
        $this->v['categories'] = $category->loadListClient();
        return view('client.home.cart', compact('cartItems'),$this->v);
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $request->image,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Sản phẩm được thêm vào giỏ hàng thành công!');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Giỏ hàng được cập nhật thành công !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Giỏ hàng xóa thành công !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'Xóa tất cả giỏ hàng thành công !');

        return redirect()->route('cart.list');
    }
}
