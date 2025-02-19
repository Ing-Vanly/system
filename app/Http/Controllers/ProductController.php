<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        $users = User::all();
        $catagories = Category::all();
        return view('backends.product.create', compact('users','catagories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'user_id' => 'required',
            'category_id' => 'nullable',
            'image' => 'nullable',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product', 'public');
    }

    $userId = $request->user_id ?? auth()->id();

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'user_id' => $userId,
        'category_id' => $request->category_id,
        'image' => $imagePath,
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
        $users = User::all();
        $categories = Category::all();
        return view('backends.product.edit', compact('product','users','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
           'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'user_id' => 'required',
            'category_id' => 'nullable',
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
        $userId = $request->user_id ?? $product->user_id;


         // Update the author
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'user_id' => $userId,
            'category_id' => $request->category_id,
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

