<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backends.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
            'warranty' => 'required',
            'image' => 'nullable',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product', 'public');
    }
    Product::create([
        'name' => $request->name,
        'brand' => $request->brand,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'weight' => $request->weight,
        'warranty' => $request->warranty,
        'image' => $imagePath,
        'user_id' => auth()->id(),
    ]);
    return redirect()->route('product.index')->with('success', 'product created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('backends.product.view',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('backends.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'weight' => 'required',
            'warranty' => 'required',
            'image' => 'nullable',
        ]);
        $product = Product::findOrFail($id);

        // If a new image is uploaded, delete the old image from storage
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('categorys', 'public');
        } else {
            // If no new image is uploaded, keep the old image path
            $imagePath = $product->image;
        }

         // Update the author
        $product->update([
            'name'=> $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'warranty' => $request->warranty,
            'image' => $imagePath,
        ]);

        return redirect()->route('product.index')->with('success', 'Products updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete the image from storage if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        // Delete the product from the database
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Products deleted successfully!');
        }
    }

