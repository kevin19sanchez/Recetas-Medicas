<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$medication = Medicamento::all();
        $medication = Medicamento::with('categoria')->get();
        $category = Categoria::all();
        return view('home.medicine.medication_index', compact('medication', 'category'));
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
        $medicamento = new Medicamento();

        $request->validate([
            'name' => 'required|string|max:255|unique:medicamentos,name',
            'description' => 'required|string|max:500',
            'price' => 'nullable|numeric|min:0|max:99999.99',
            'stocks' => 'required|integer|min:0',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre del medicamento es obligatorio.',
            'name.unique' => 'El nombre del medicamento ya está registrado.',
            'description.required' => 'La descripción del medicamento es obligatoria.',
            'description.max' => 'La descripción no puede exceder los 500 caracteres.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'price.max' => 'El precio no puede superar los 99,999.99.',
            'stocks.required' => 'El campo de existencias es obligatorio.',
            'stocks.integer' => 'El campo de existencias debe ser un número entero.',
            'stocks.min' => 'El número de existencias no puede ser negativo.',
        ]);

        //dd($request->all());
        $medicamento->name = $request->name;
        $medicamento->description = $request->description;
        $medicamento->price = $request->price;
        $medicamento->stocks = $request->stocks;
        $medicamento->category_id = $request->category_id;

        $medicamento->save();

        return redirect()->route('medication')->with('success', 'Medicamento creado exitosamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Medicamento $medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicamentoedit = Medicamento::findOrFail($id);
        $categorias = Categoria::all();
        return view('home.medicine.medication_edit', compact('medicamentoedit', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicamentoupdate = Medicamento::findOrFail($id);

        $request->validate([
            'name' => ['required','string','max:255',Rule::unique('medicamentos', 'name')->ignore($medicamentoupdate->id),],
            'description' => 'required|string|max:500',
            'price' => 'nullable|numeric|min:0|max:99999.99',
            'stocks' => 'required|integer|min:0',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre del medicamento es obligatorio.',
            'name.unique' => 'El nombre del medicamento ya está registrado.',
            'description.required' => 'La descripción del medicamento es obligatoria.',
            'description.max' => 'La descripción no puede exceder los 500 caracteres.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'price.max' => 'El precio no puede superar los 99,999.99.',
            'stocks.required' => 'El campo de existencias es obligatorio.',
            'stocks.integer' => 'El campo de existencias debe ser un número entero.',
            'stocks.min' => 'El número de existencias no puede ser negativo.',
        ]);

        //dd($request->all());
        $medicamentoupdate->name = $request->name;
        $medicamentoupdate->description = $request->description;
        $medicamentoupdate->price = $request->price;
        $medicamentoupdate->stocks = $request->stocks;
        $medicamentoupdate->category_id = $request->category_id;

        $medicamentoupdate->save();

        return redirect()->back()->with('success', 'Medicamento editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicamentodelete = Medicamento::findOrFail($id);

        $medicamentodelete->delete();

        return redirect()->back()->with('success', 'Medicamento eliminado exitosamente');
    }
}
