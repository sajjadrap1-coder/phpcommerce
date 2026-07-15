<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'سبد خرید شما خالی است.');
        }

        $total = $cartItems->sum(fn ($item) => $item->subtotal);

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function place(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'shipping_name'        => 'required|string|max:255',
            'shipping_email'       => 'required|email',
            'shipping_phone'       => 'required|string|max:20',
            'shipping_address'     => 'required|string',
            'shipping_city'        => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'notes'                => 'nullable|string|max:500',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'سبد خرید شما خالی است.');
        }

        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', "موجودی محصول «{$item->product->name}» کافی نیست.");
            }
        }

        DB::transaction(function () use ($data, $cartItems) {
            $total = $cartItems->sum(fn ($item) => $item->subtotal);

            $order = Order::create([
                'user_id'              => auth()->id(),
                'order_number'         => 'ORD-' . strtoupper(uniqid()),
                'total_amount'         => $total,
                'status'               => 'pending',
                'shipping_name'        => $data['shipping_name'],
                'shipping_email'       => $data['shipping_email'],
                'shipping_phone'       => $data['shipping_phone'],
                'shipping_address'     => $data['shipping_address'],
                'shipping_city'        => $data['shipping_city'],
                'shipping_postal_code' => $data['shipping_postal_code'],
                'notes'                => $data['notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity'     => $item->quantity,
                    'unit_price'   => $item->product->effective_price,
                    'total_price'  => $item->subtotal,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            CartItem::where('user_id', auth()->id())->delete();
        });

        return redirect()->route('orders.index')
            ->with('success', 'سفارش شما با موفقیت ثبت شد.');
    }
}
