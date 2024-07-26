<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch products with related categories and stores
        $products = Product::with(['category', 'store'])->paginate();

        // Fetch a specific category and its products (example for demonstration)
        $category = Category::with('products')->find(1);

        // Uncomment if you need to use $category->products in the view
        // $products = $category->products;

        // Remove the echo statements
        // foreach($category->products as $product){
        //     echo $product->name;
        // }

        return view('dashboard.products.index', compact('products'));
    }

    // Other methods...

    public function create()
    {
        $product = new Product();
        $parents = Product::all();
        $stores = Store::all(); // Assuming you have a Store model
        return view('dashboard.products.create', compact('product', 'parents', 'stores'));
    }


public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'store_id' => 'required|exists:stores,id',
        // Add validation for other required fields
    ]);

    // Generate slug from the product name
    $validatedData['slug'] = Str::slug($validatedData['name'], '-');

    // If 'slug' field exists in the request data and is empty, ensure it's filled
    if(empty($validatedData['slug'])) {
        return back()->withErrors(['slug' => 'The slug field could not be generated.']);
    }

    Product::create($validatedData);

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
}





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement as needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $product = Product::findOrFail($id);
    $stores = Store::all(); // Fetch stores if needed for the form
    $tags=$product->tags;
    return view('dashboard.products.edit', compact('product','stores'));
}


public function update(Request $request, Product $product)
{
    $product->update($request->except('tags'));

    $tags = explode(',', $request->post('tags'));
    $tag_ids = [];
    foreach ($tags as $t_name) {
        $slug = Str::slug($t_name);
        $tag = Tag::where('slug', $slug)->first();
        if (!$tag) {
            $tag = Tag::create([
                'name' => $t_name,
                'slug' => $slug,
            ]);
        }
        $tag_ids[] = $tag->id;
    }

    $product->tags()->sync($tag_ids);

    return redirect()->route('products.index')->with('success', 'Product updated');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implement as needed
    }
}
