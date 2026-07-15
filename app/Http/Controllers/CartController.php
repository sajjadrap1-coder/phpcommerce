<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(fn ($item) => $item->subtotal);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->stock < $data['quantity']) {
            return back()->with('error', 'موجودی کافی نیست.');
        }

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $data['product_id'])
            ->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $data['quantity'];
            if ($newQty > $product->stock) {
                return back()->with('error', 'موجودی کافی نیست.');
            }
            $cartItem->update(['quantity' => $newQty]);
        } else {
            CartItem::create([
                'user_id'    => auth()->id(),
                'product_id' => $data['product_id'],
                'quantity'   => $data['quantity'],
            ]);
        }

        return back()->with('success', 'محصول به سبد خرید اضافه شد.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        if ($data['quantity'] > $cartItem->product->stock) {
            return back()->with('error', 'موجودی کافی نیست.');
        }

        $cartItem->update(['quantity' => $data['quantity']]);

        return back()->with('success', 'سبد خرید به‌روزرسانی شد.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'محصول از سبد خرید حذف شد.');
    }

    public function count(): JsonResponse
    {
        $count = CartItem::where('user_id', auth()->id())->sum('quantity');

        return response()->json(['count' => $count]);
    }
}
