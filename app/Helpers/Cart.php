<?php

namespace App\Helpers;

class Cart
{
    public static function add($book, $quantity = 1)
    {
        $cart = session()->get('cart', []);
        $bookId = $book->id;

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] += $quantity;
        } else {
            $cart[$bookId] = [
                'book_id' => $bookId,
                'description' => $book->description,
                'author' => $book->author,
                'image_path' => $book->image_path,
                'price' => $book->price,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);
    }

    public static function remove($bookId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$bookId]);
        session(['cart' => $cart]);
    }

    public static function clear()
    {
        session()->forget('cart');
    }

    public static function all()
    {
        return session()->get('cart', []);
    }

    public static function total()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}