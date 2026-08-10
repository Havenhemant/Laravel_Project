<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        if (auth()->user()->role === 'admin') {
            return back()->with('error', 'Admins cannot place orders.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = max(1, (int) $request->quantity);
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Cart updated');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Product removed from cart');
    }
}