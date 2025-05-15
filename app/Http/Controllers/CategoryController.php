<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::withCount('todos')
            ->where('user_id', $userId)
            ->get();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Category::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
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
    public function edit(Category $category)
    {
        if (Auth::id() === $category->user_id) {
            return view('category.edit', compact('category'));
        }

        return redirect()->route('category.index')->with('danger', 'You are not authorized to edit this category!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
{

    if (Auth::id() !== $category->user_id) {
        return redirect()->route('category.index')->with('danger', 'You are not authorized to update this category!');
    }

    $request->validate([
        'title' => 'required|string|max:255',
    ]);


    $category->update([
        'title' => $request->title,
    ]);


    return redirect()->route('category.index')->with('success', 'Category updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if (Auth::id() !== $category->user_id) {
            return redirect()->route('category.index')->with('danger', 'You are not authorized to delete this category!');
        }


        $category->delete();


        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

}