<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Category::included()->findOrFail(2);
        // $categories=Category::included()->get();
      //  $categories=Category::included()->filter()->sort()->get();
        $categories=Category::included()->filter()->sort()->getOrPaginate();
        //$categories=Category::included()->filter()->get();

        //$categories = Category::all();
        //$categories = Category::with(['posts.user'])->get();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::create($request->all());

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id) //si se pasa $id se utiliza la comentada
    {
        $category = Category::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories,slug,' . $category->id,

        ]);

        $category->update($request->all());

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $category;
    }
}
