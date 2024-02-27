<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $categories = Category::select('id', 'catname')
        //     ->with('subcategories:id,category_id,subcatname')
        //     ->get();

        $categories = CategoryResource::collection(Category::with('subcategories')->withCount('subcategories')->get());

        return inertia('Category/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'catname' => 'required|string|unique:categories',
            'code' => 'required|numeric|unique:categories'
        ], [
            'catname.required' => 'The category name field is required.',
            'catname.unique' => 'The category name is already taken.',
        ]);

        Category::create($request->all());

        return back()->with('message', 'Category successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia('Category/Edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'catname' => ['required', 'string', Rule::unique(Category::class)->ignore($category->id)],
            'code' => ['required', 'numeric', Rule::unique(Category::class)->ignore($category->id)]
        ], [
            'catname.required' => 'The category name field is required.',
        ]);

        $category->update($request->all());

        return redirect(route('category.index'))->with('success', 'Category details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->subcategories()->exists() || $category->properties()->exists()) {
            return back()->with('message', 'Error deleting category.');
        } else {
            $category->delete();
            return back()->with('success', 'Category has been removed.');
        }
    }
}
