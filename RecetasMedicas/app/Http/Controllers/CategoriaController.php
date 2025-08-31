<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showcategory = Categoria::all();
        return view('home.category.category_index', compact('showcategory'));
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
            'name' => 'required|string|max:255|unique:categorias,name',
            'description' => 'nullable|string|max:500'
        ],[
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'description.max' => 'La descripción no puede tener más de 500 caracteres.'
        ]);

        $categori = new Categoria();
        //dd($request->all());
        $categori->name = $request->name;
        $categori->description = $request->description;

        $categori->save();

        return redirect()->route('category.index')->with('success', 'Categoria creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoriedit = Categoria::findOrFail($id);
        return view('home.category.category_edit', compact('categoriedit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoryupdate = Categoria::findOrFail($id);

        $request->validate([
            'name' => [
                'required','string','max:255',Rule::unique('categorias', 'name')->ignore($categoryupdate->id),
            ],
            'description' => 'nullable|string|max:500'
        ], [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'name.unique' => 'Ya existe una categoría con este nombre.',
            'description.string' => 'La descripción debe ser un texto válido.',
            'description.max' => 'La descripción no puede tener más de 500 caracteres.'
        ]);
        //dd($request->all());
        $categoryupdate->name = $request->name;
        $categoryupdate->description = $request->description;

        $categoryupdate->save();

        return redirect()->route('category.index')->with('success', 'Categoria editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorydelete = Categoria::findOrFail($id);

        $categorydelete->delete();

        return redirect()->route('category.index')->with('success', 'Categoria eliminada exitosamente');
    }
}
