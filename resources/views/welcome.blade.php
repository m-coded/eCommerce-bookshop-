<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-gray-50 to-gray-200">
  <div class="container mx-auto px-4 bg-emerald-700 rounded-md">
        
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

    </ul>
    <div class="relative w-full h-60 flex items-center justify-center rounded-md mt-6 overflow-hidden">
    <!-- Background image -->
   <img src="{{ asset('images/image.png') }}"   
        alt="Background"
        class="absolute inset-0 w-full h-full object-cover "
    >
    <!-- Animated text overlay -->
    <div class="relative z-10 flex items-center justify-center w-full h-full">
        <h1 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg animate-slidein">
            {{ $text ?? 'Welcome to BookStore' }}
             <p class="text-1xl md:text-2xl  text-center text-white ">Find your next read</p>
        </h1>
    </div>
    
</div>
<br>
<br>
<div class=" shadow flex items-left justify-between px-6 py-4 mb-6 mt-6">
    
<h1>
    <span class="text-2xl font-bold text-white">BookStore</span>

</div>
<!----card container-->
<div class="container mx-auto p-4  ">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4  ">
    @foreach($pop as $product)
      <div class="bg-emerald-900 shadow rounded-lg overflow-hidden hover:shadow-lg transition-shadow text-sm w-40 ">
        <a href="{{ route('product.show', $product->id) }}">
          <img src="{{ asset('storage/' . $product->image_path) }}" alt="Book cover for {{ $product->description }}" class="w-full h-40 object-cover p-4">
          <div class="p-2">
            <p class="text-xs text-gray-500 mb-0.5 text-white font-bold">
              Author: <span class=" text-gray-800 text-white" >{{ ucfirst($product->author) }}</span>
            </p>
            <p class="font-semibold text-base mb-1 truncate text-white">{{ ucfirst($product->description) }}</p>
        </a>
            <div class="flex items-center justify-between mt-2">
              <span class="text-lg font-bold text-yellow-300">${{ number_format($product->price, 2) }}</span>
              <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded font-semibold flex items-center text-xs">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9V5a3 3 0 016 0v4m-6 9a2 2 0 104 0 2 2 0 00-4 0z"/>
                  </svg>
                  Add
                </button>
              </form>
            </div>
          </div>
      </div>
    @endforeach
  </div>
</div>
<br>
<br>
<!-------->


</div>



<!--container line-->

</div>

            
</body>
</html>