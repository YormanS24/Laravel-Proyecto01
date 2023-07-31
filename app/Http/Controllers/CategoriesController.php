<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',['categories' => $categories]);
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
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7'
        ]);

        Category::create([
            'name' => $request->name,
            'color' => $request->color
        ]);

        return redirect()->route('categories.index')->with('success','Nueva categoria agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('categories.show',['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        $request->validate([
//            'name' => 'required|unique:categories|max:255',
//            'color' => 'required|max:7'
//        ]);

        Category::where('id',$id)
            ->update([
                'name' => $request->name,
                'color' => $request->color
            ]);

        return redirect()->route('categories.index')->with('success','Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $category = Category::find($id);
            $category->todos()->each(function ($todo){
                $todo->delete();
            });
            $category->delete();

            return redirect()->route('categories.index')->with('success','Categoria eliminada');
        }catch (Throwable){
            return redirect()->route('categories.index')->with('error','Tenemos problemas, reintente mas tarde...');
        }
    }
}
