<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search'); // Get the search query

        // Fetch categories with filter and search functionality
        $categories = Category::with('parent')
        // leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            // ->select(['categories.*', 'parents.name as parent_name'])
           // ->select('categories.*')
           // ->selectRaw('(SELECT Count(*) FROM products WHERE category_id=categories.id) as products_count ')
            -> withCount(['products as products_count'=>function ($query){
              $query->where('status','=','active');
                      }])
            ->filter($request->query()) // Apply filters
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->where('categories.name', 'like', "%{$query}%");
            })
            ->orderBy('categories.name')
            ->withTrashed()
            ->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $parents = Category::all();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        Category::create($data);

        // PRG
        return redirect()->route('categories.index')->with('success', 'Category created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                      ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    public function show(Category $category)
    {
        // Fetch products in this category
        $products = $category->products()->where('status', 'active')->get();

        return view('dashboard.categories.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }


    // app/Http/Controllers/CategoryController.php

public function showProducts(Category $category)
{
    $products = $category->products; // Get all products in the category

    return view('dashboard.categories.products', [
        'category' => $category,
        'products' => $products
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }

        $old_image = $category->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);

        if ($old_image && $new_image) {
            try {
                Storage::disk('public')->delete($old_image);
            } catch (Exception $e) {
                return redirect()->route('categories.index')->with('error', 'Failed to delete old image');
            }
        }

        return redirect()->route('categories.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            // if($category->image){
            //     Storage::disk('public')->delete($category->image);
            // }
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        return redirect()->route('categories.index')->with('success', 'Category deleted');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $path = $file->store('uploads', 'public');
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(10);
        return view('dashboard.categories.trashed', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        try {
            $category = Category::onlyTrashed()->where('id', $id)->firstOrFail();
            $category->restore();
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.trash')->with('error', 'Category not found');
        }
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category restored');
    }

    public function forceDelete($id)
    {
        try {
            $category = Category::withTrashed()->where('id', $id)->firstOrFail();
            $category->forceDelete();

            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.trash')->with('error', 'Category not found');
        }
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category permanently deleted');
    }
}
