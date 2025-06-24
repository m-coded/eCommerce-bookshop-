<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\popularbooks;
use Illuminate\Http\Request;


class cartController extends Controller
{
     public function index()
    {
        $cart = Cart::all();
        $total = Cart::total();
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $book = popularbooks::findOrFail($id);
        Cart::add($book, 1);
        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function remove($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index')->with('success', 'Book removed from cart!');
    }

    public function clear()
    {
        Cart::clear();
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
