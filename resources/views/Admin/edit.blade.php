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
   
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit Book</h2>
    <form action="{{ route('products.update', $pops->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
            <input type="text" name="description" id="description" value="{{ old('description', $pops->description) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                required maxlength="1000">
            @error('description')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Author -->
        <div class="mb-4">
            <label for="author" class="block text-gray-700 font-semibold mb-2">Author:</label>
            <input type="text" name="author" id="author" value="{{ old('author', $pops->author) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                required maxlength="255">
            @error('author')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Current Image -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Current Image:</label>
            <img src="{{ asset('storage/' . $pops->image_path) }}" alt="Book Image" class="w-32 h-40 object-cover rounded shadow mb-2">
        </div>

        <!-- Upload New Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold mb-2">
                Change Image: <span class="text-gray-500 text-sm">(optional)</span>
            </label>
            <input type="file" name="image" id="image"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
            @error('image')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-6">
            <label for="price" class="block text-gray-700 font-semibold mb-2">Price:</label>
            <input type="number" name="price" id="price" value="{{ old('price', $pops->price) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
                min="0" step="0.01" required>
            @error('price')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                Update Book
            </button>
            <a href="{{ route('products.index') }}" class="ml-4 text-gray-700 hover:underline">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>