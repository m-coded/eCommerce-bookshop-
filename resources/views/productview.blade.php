<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View</title>
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
        <div class="max-w-4xl mx-auto mt-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Product Image -->
        <div class="flex justify-center">
            <img 
                src="{{ asset('storage/' . $product->image_path) }}" 
                alt="Book cover for {{ $product->description }}" 
                class="rounded-xl shadow-lg w-full max-w-xs md:max-w-md object-cover"
            >
        </div>
        <!-- Product Info -->
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $product->description }}</h1>
            <p class="text-lg text-gray-600 mb-4">by <span class="font-semibold text-gray-800">{{ $product->author }}</span></p>
            <div class="flex items-center mb-6">
                <span class="text-3xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow transition duration-150">
                    <!-- Cart Icon (Heroicons) -->
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9V5a3 3 0 016 0v4m-6 9a2 2 0 104 0 2 2 0 00-4 0z"/>
                    </svg>
                    Add to cart
                </button>
            </form>
            <div class="text-sm text-gray-500">
                <span>Free shipping on orders over $50</span>
            </div>
        </div>
    </div>
</div>
    </body>
</html>