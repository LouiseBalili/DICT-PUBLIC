<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResource;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with([
            'acquisition', 
            'category', 
            'subcategory', 
            'receivingEmployee', 
            'assignedEmployee', 
            'office'
        ])->get();
        
        // return response()->json(PropertyResource::collection($properties));
        return inertia('Property/Index', [
            'properties' => PropertyResource::collection($properties),
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
    public function store(StorePropertyRequest $request)
    {

        // $request->validated();

        $data = Property::create($request->all());

        return response()->json(['data' => $data], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $data = $property->load([
            'acquisition', 
            'category', 
            'subcategory', 
            'receivingEmployee', 
            'assignedEmployee', 
            'office'
        ]);

        return response()->json(new PropertyResource($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        // $data = Property::create($request->all());

        return response()->json(['data' => $request->all(), 'property' => $property], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
