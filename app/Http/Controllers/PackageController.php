<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::paginate(5);
        // $packages = Package::all();
     return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated= $request->validate(['name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|in:1,3,6,12',
            'percent' => 'required|integer|min:0|max:100',
            'status' => 'nullable|boolean',
            'expire_at' => 'required|date|after:today',
        ]);


         $package = Package::create($validated);

       return redirect()->route('packages.index')->with('success', 'package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
       return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validated= $request->validate(['name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|in:1,3,6,12',
            'percent' => 'required|integer|min:0|max:100',
            'status' => 'nullable|boolean',
            'expire_at' => 'required|date|after:today',
        ]);

        $package->update($validated);

        return redirect()->route('packages.index')->with('success', 'package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return response()->json(['success' => 'Package deleted successfully.']);

    }
}
