<?php

// app/Http/Controllers/BasketController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $basket = Session::get('basket', []);
            if (isset($basket[$productId])) {
                $basket[$productId]['quantity'] += $request->input('quantity', 1);
            } else {
                $basket[$productId] = [
                    'product' => $product,
                    'quantity' => $request->input('quantity', 1),
                ];
            }
            Session::put('basket', $basket);
            return redirect()->route('basket.view')->with('success', 'Product added to basket!');
        }

        return redirect()->route('basket.view')->with('error', 'Product not found!');
    }

    public function view()
    {
        $basket = Session::get('basket', []);

        if (!is_array($basket)) {
            $basket = [];
        }

        $totalPrice = array_reduce($basket, function ($carry, $item) {
            if (isset($item['product']->price)) {
                return $carry + ($item['product']->price * $item['quantity']);
            }
            return $carry;
        }, 0);

        return view('dashboard.basket.view', compact('basket', 'totalPrice'));
    }

    public function remove($productId)
    {
        $basket = Session::get('basket', []);

        if (isset($basket[$productId])) {
            unset($basket[$productId]);

            Session::put('basket', $basket);
            return redirect()->route('basket.view')->with('success', 'Product removed from basket!');
        }

        return redirect()->route('basket.view')->with('error', 'Product not found in basket!');
    }

    public function clear()
    {
        Session::forget('basket');
        return redirect()->route('basket.view')->with('success', 'Basket cleared!');
    }

    

    public function update(Request $request, $productId)
    {
        $basket = Session::get('basket', []);

        if (isset($basket[$productId])) {
            if ($request->input('action') == 'increase') {
                $basket[$productId]['quantity'] += 1;
            } elseif ($request->input('action') == 'decrease' && $basket[$productId]['quantity'] > 1) {
                $basket[$productId]['quantity'] -= 1;
            }

            Session::put('basket', $basket);
            return redirect()->route('basket.view')->with('success', 'Basket updated!');
        }

        return redirect()->route('basket.view')->with('error', 'Product not found in basket!');
    }
}

