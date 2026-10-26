<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Cloudinary\Cloudinary;

class CategoryController extends Controller
{

    public function consulta1(){

     $respuesta = Category::with(['posts.user'])->get();
     return response()->json($respuesta);

    }

    public function consulta2(){


     $respuesta = Category::with(['posts'])->get();
     return response()->json($respuesta);

    }

    public function index()
    {
       $categories = Category::all();

       return response()->json($categories);
    }

        // $categories = Category::with(['posts.user'])->get();
        // $category = Category::included()->findOrFail(2);
        // $categories = Category::included()->get();
        //$categories=Category::included()->filter()->sort()->get();
        //$categories = Category::included()->filter()->sort()->getOrPaginate();
        // $categories=Category::included()->filter()->get();

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('imagen');

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $resultado = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'categories',
                'resource_type' => 'image',
            ]
        );

        $category = Category::create([
            'name' => $request->name,
            'imagen_url' => $resultado['secure_url'],
            'imagen_public_id' => $resultado['public_id'],
        ]);

        return response()->json([
            'message' => 'Categoría creada correctamente',
            'data' => $category,
        ], 201);
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
            ]);

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json($category);
    }
}
