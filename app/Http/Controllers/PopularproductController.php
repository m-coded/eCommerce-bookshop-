<?php

namespace App\Http\Controllers;

use App\Models\popularbooks;
use Illuminate\Http\Request;

class PopularproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pops =popularbooks::all();
        return view('Admin.admin', compact('pops'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.popuplarproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'author' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        // Store the image in storage/app/public/products
        $imagePath = $request->file('image')->store('products', 'public');

        // Save to database
        popularbooks::create([
            'description' => $validated['description'],
            'author' => $validated['author'],
            'image_path' => $imagePath,
            'price' => $validated['price'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $product = popularbooks::findOrFail($id);
    return view('productview', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pops = popularbooks::findOrFail($id);
    return view('Admin.edit', compact('pops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $pops = popularbooks::findOrFail($id);

    $validated = $request->validate([
        'description' => 'required|string|max:1000',
        'author' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // nullable for edit
        'price' => 'required|numeric|min:0',
    ]);

    // If a new image is uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $pops->image_path = $imagePath;
    }

    $pops->description = $validated['description'];
    $pops->author = $validated['author'];
    $pops->price = $validated['price'];
    $pops->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $pops = popularbooks::findOrFail($id);
    // Optionally delete the image from storage:
    // Storage::disk('public')->delete($book->image_path);
    $pops->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
