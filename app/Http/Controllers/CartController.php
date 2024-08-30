<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, tambahkan kuantitasnya
            $cartItem->quantity++;
        } else {
            // Jika belum ada, tambahkan produk ke keranjang
            $cartItem = new Cart();
            $cartItem->user_id = Auth::id();
            $cartItem->product_id = $id;
            $cartItem->quantity = 1;
        }

        $cartItem->save();

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Hitung subtotal
        $subtotal = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        return view('e_commerce.cart.index', compact('cartItems', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $request->id)->first();

        if ($cartItem && $request->quantity > 0) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function removeFromCart(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $request->id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Product removed successfully');
    }
}
