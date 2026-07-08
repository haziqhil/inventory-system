<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Check stock availability before committing anything
        foreach ($validated['products'] as $item) {
            $product = Product::find($item['id']);
            if ($product->stock_quantity < $item['quantity']) {
                return back()->withErrors([
                    'products' => "Not enough stock for {$product->name}. Available: {$product->stock_quantity}"
                ]);
            }
        }

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'status' => 'pending',
            'total' => 0,
        ]);

        $total = 0;

        foreach ($validated['products'] as $item) {
            $product = Product::find($item['id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price_at_purchase' => $product->price,
            ]);

            $product->decrement('stock_quantity', $item['quantity']);
            $total += $product->price * $item['quantity'];
        }

        $order->update(['total' => $total]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order): View
    {
        $order->load('orderItems.product');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        $products = Product::all();
        $order->load('orderItems');
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }
}