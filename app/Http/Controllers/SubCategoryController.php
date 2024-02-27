<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Resources\SubcategoryResource;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Subcategory::with('category')->get();
        
        return inertia('Subcategory/Index', [
            'subcategories' => SubcategoryResource::collection($data)
        ]);
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
        // dd($request->all());
        $request->validate(['subcatname' => 'string|required|unique:subcategories']);

        // Subcategory::create($request->all());
        $category = Category::where('id', $request->category_id)->first();

        $category->subcategories()->create(['subcatname' => $request->subcatname]);

        return back()->with('success', 'A new subcategory has been added to '.$category->catname.'!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        // dd($request->all(), $subcategory);
        $request->validate(['subcatname' => 'required|string']);
        $subcategory->update(['subcatname' => $request->subcatname]);

        return back()->with('success', 'Subcategory name has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        dd($subcategory);
    }
}
