<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
         @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <div class=" px-4 bg-emerald-700 ">
        <ul class="    width-full  flex items-center justify-between py-2">
           <h1 class=" font-bold  text-white	 px-7 ">GOOD BOOKS</h1>
        <li class="text-gray-700 hover:text-green-700 mr-4 text-white font-semibold text-right">
            <a href="{{ url('/') }}">Home</a>
        </li>
        <a href="{{ route('cart.index') }}" class="relative flex items-center">
    <!-- Heroicons shopping cart SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9V5a3 3 0 016 0v4m-6 9a2 2 0 104 0 2 2 0 00-4 0z" />
    </svg>
    <!-- Cart count badge -->
    @php
        $cart = session('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
    @endphp
    @if($cartCount > 0)
        <span class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
            {{ $cartCount }}
        </span>
    @endif
</a>
        <li class="text-gray-700 hover:text-green-700 mr-4 text-white font-semibold text-right">
            <a href="{{ url('/contact') }}">Contact</a>
        </li>
     <div class="ml-4 flex items-center">
    @auth
        <span class="mr-4 font-semibold text-white">Welcome, {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-white hover:underline font-bold">Logout</button>
        </form>
    @else
        <a href="{{ url('/login') }}" class="text-gray-700 hover:text-green-700 mr-4 text-white font-semibold">Login</a>
        <a href="{{ url('/register') }}" class="text-gray-700 hover:text-green-700 text-white font-semibold">Register</a>
    @endauth
</div>
    </div>

    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
    <h2 class="text-2xl font-bold mb-6">Shopping Cart</h2>
    @if (count($cart))
        <table class="w-full mb-6">
            <thead>
                <tr>
                    <th class="text-left">Image</th>
                    <th class="text-left">Description</th>
                    <th class="text-left">Author</th>
                    <th class="text-left">Qty</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr class="border-t">
                    <td>
                        <img src="{{ asset('storage/' . $item['image_path']) }}" alt="book image" class="w-16 h-20 object-cover rounded">
                    </td>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $item['author'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['book_id']) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between items-center mb-6">
            <div class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</div>
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Clear Cart</button>
            </form>
        </div>
        <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-semibold">Checkout</button>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>