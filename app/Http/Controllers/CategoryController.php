<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        return view('backends.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.category.create');
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
            'image' => 'nullable',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Category::create([
            'name'=> $request->name,
            'brand'  => $request->brand,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
            'user_id' => auth()->id(),

        ]);
        return redirect()->route('category.index')->with('success', 'category created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backends.category.view', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backends.category.edit', compact('category'));
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
            'image' => 'nullable',
        ]);
        $category = Category::findOrFail($id);

        // If a new image is uploaded, delete the old image from storage
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('categorys', 'public');
        } else {
            // If no new image is uploaded, keep the old image path
            $imagePath = $category->image;
        }

         // Update the author
        $category->update([
            'first_name'=> $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
        ]);

        return redirect()->route('category.index')->with('success', 'Categorys updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete the image from storage if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        // Delete the product from the database
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}
