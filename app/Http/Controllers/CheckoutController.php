<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'phone'   => 'required|string|max:20',
        ]);

        $cart = session('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            DB::transaction(function () use ($cart, $request) {

                $total = 0;

                // Pehle stock check karo sab products ka
                foreach ($cart as $productId => $item) {
                    $product = Product::lockForUpdate()->findOrFail($productId);

                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Not enough stock for {$product->name}.");
                    }

                    $total += $item['price'] * $item['quantity'];
                }

                // Order banao
                $order = Order::create([
                    'customer_id'  => auth()->id(),
                    'total_amount' => $total,
                    'status'       => 'pending',
                    'address'      => $request->address,
                    'phone'        => $request->phone,
                ]);

                // Order items banao + stock kam karo
                foreach ($cart as $productId => $item) {
                    $product = Product::find($productId);

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $productId,
                        'quantity'   => $item['quantity'],
                        'unit_price' => $item['price'],
                    ]);

                    $product->decrement('stock', $item['quantity']);
                }
            });

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully! Waiting for admin approval.');
    }
}