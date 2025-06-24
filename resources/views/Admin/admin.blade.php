<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN (remove for production if using Laravel Mix/Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 left-0 z-50">
        <div class="container mx-auto px-4 flex flex-wrap items-center justify-between h-16">
            <div class="flex items-center space-x-2">
                <span class="text-xl font-bold text-gray-800">Admin Dashboard</span>
            </div>
            <div class="flex items-center">
                <span class="hidden sm:block text-gray-700 mr-6">
                    Welcome, {{ Auth::user()->name ?? 'Admin' }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content Container -->
    <div class="pt-20 flex justify-center min-h-screen">
        <div class="container mx-auto bg-white rounded-lg shadow-lg flex flex-col md:flex-row w-full mx-2 md:mx-0 overflow-hidden">
            <!-- Sidebar -->
            <aside class="w-full md:w-1/4 bg-gray-800 text-white flex flex-col">
                <div class="p-6 border-b border-gray-700 text-lg font-bold">
                    Admin Menu
                </div>
                <nav class="flex-1 flex flex-col space-y-1 p-4">
                    <button class="text-left py-2 px-4 rounded hover:bg-gray-700 transition">Authorbooks</button>
                    <button class="text-left py-2 px-4 rounded hover:bg-gray-700 transition">Novelsbooks</button>
                    <button class="text-left py-2 px-4 rounded hover:bg-gray-700 transition">Other</button>
                </nav>
            </aside>
            <!-- Main Content -->
            <main class="w-full md:w-3/4 p-6 flex flex-col">
                <div class="flex justify-end mb-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow  transition"
                            onclick="window.location.href='{{ route('products.create') }}'">
                        Add User
                    </button>
                </div>
                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                 
                    <table class="min-w-full bg-white border border-gray-200">
                       
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b text-left">Image</th>
                                <th class="py-3 px-4 border-b text-left">Author</th>
                                <th class="py-3 px-4 border-b text-left">Price</th>
                                <th class="py-3 px-4 border-b text-left">Description</th>
                                <th class="py-3 px-4 border-b text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($pops as $product)
                            <!-- Example Row -->
                            <tr>
                                 <td class="py-3 px-4 border-b">
                                    <img src="{{$product->image_path}}" alt="Book image" class="w-12 h-12 rounded object-cover">
                                </td>
                                <td class="py-3 px-4 border-b">{{$product->author}}</td>
                                <td class="py-3 px-4 border-b">{{$product->price}}</td>
                                <td class="py-3 px-4 border-b">{{$product->description}}</td>
                                <td class="py-3 px-4 border-b">
                                    <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded mr-2 transition"  onclick="window.location.href='{{ route('products.edit', $product->id) }}'">Edit</button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                     @csrf
                                     @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Delete</button>
                                 </form>                               
                                 </td>
                            </tr>
                             @endforeach
                        </tbody>
                        
                    </table>
                   
                </div>
            </main>
        </div>
    
    </div>
</body>
</html>