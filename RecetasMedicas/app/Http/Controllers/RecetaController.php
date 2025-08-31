<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Receta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recetas = Receta::all();
        $medicos = Medico::all();
        $pacientes = Paciente::all();
        $establ = Establecimiento::all();
        return view('home.prescriptions.prescription_index', compact('recetas','medicos','pacientes','establ'));
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
        $receta = new Receta();

        $request->validate([
            'fecha' => 'required|date|before_or_equal:today',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_id' => 'required|exists:establecimientos,id',
            'medicamentos' => 'required|string|max:500',
            'cantidad' => 'required|integer|min:1|max:1000',
            'dosis' => 'required|string|max:255',
            'indicaciones' => 'required|string|max:1000',
        ], [
            // Mensajes de error personalizados
            'fecha.required' => 'La fecha de la receta es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
            'medico_id.required' => 'El médico es obligatorio.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'paciente_id.required' => 'El paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'establecimiento_id.required' => 'El establecimiento es obligatorio.',
            'establecimiento_id.exists' => 'El establecimiento seleccionado no existe.',
            'medicamentos.required' => 'Los medicamentos son obligatorios.',
            'medicamentos.max' => 'La lista de medicamentos no puede exceder los 500 caracteres.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
            'cantidad.max' => 'La cantidad máxima es 1000.',
            'dosis.required' => 'La dosis es obligatoria.',
            'dosis.max' => 'La dosis no puede exceder los 255 caracteres.',
            'indicaciones.required' => 'Las indicaciones son obligatorias.',
            'indicaciones.max' => 'Las indicaciones no pueden exceder los 1000 caracteres.',
        ]);

        //dd($request->all());
        $receta->fecha = $request->fecha;
        $receta->medico_id = $request->medico_id;
        $receta->paciente_id = $request->paciente_id;
        $receta->establecimiento_id = $request->establecimiento_id;
        $receta->medicamentos = $request->medicamentos;
        $receta->cantidad = $request->cantidad;
        $receta->dosis = $request->dosis;
        $receta->indicaciones = $request->indicaciones;

        $receta->save();

        return redirect()->route('prescription')->with('success', 'Receta creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $recetaedit = Receta::findOrFail($id);
        $medicoedit = Medico::all();
        $pacientesedit = Paciente::all();
        $establedit = Establecimiento::all();

        return view('home.prescriptions.prescription_edit', compact('recetaedit','medicoedit','pacientesedit','establedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $recetaupdate = Receta::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date|before_or_equal:today',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'establecimiento_id' => 'required|exists:establecimientos,id',
            'medicamentos' => 'required|string|max:500',
            'cantidad' => 'required|integer|min:1|max:1000',
            'dosis' => 'required|string|max:255',
            'indicaciones' => 'required|string|max:1000',
        ], [
            // Mensajes personalizados
            'fecha.required' => 'La fecha de la receta es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
            'medico_id.required' => 'El médico es obligatorio.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'paciente_id.required' => 'El paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'establecimiento_id.required' => 'El establecimiento es obligatorio.',
            'establecimiento_id.exists' => 'El establecimiento seleccionado no existe.',
            'medicamentos.required' => 'Los medicamentos son obligatorios.',
            'medicamentos.max' => 'La lista de medicamentos no puede exceder los 500 caracteres.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
            'cantidad.max' => 'La cantidad máxima es 1000.',
            'dosis.required' => 'La dosis es obligatoria.',
            'dosis.max' => 'La dosis no puede exceder los 255 caracteres.',
            'indicaciones.required' => 'Las indicaciones son obligatorias.',
            'indicaciones.max' => 'Las indicaciones no pueden exceder los 1000 caracteres.',
        ]);

        $recetaupdate->fecha = $request->fecha;
        $recetaupdate->medico_id = $request->medico_id;
        $recetaupdate->paciente_id = $request->paciente_id;
        $recetaupdate->establecimiento_id = $request->establecimiento_id;
        $recetaupdate->medicamentos = $request->medicamentos;
        $recetaupdate->cantidad = $request->cantidad;
        $recetaupdate->dosis = $request->dosis;
        $recetaupdate->indicaciones = $request->indicaciones;

        $recetaupdate->save();

        return redirect()->back()->with('success', 'Receta editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recetadelete = Receta::findOrFail($id);

        $recetadelete->delete();

        return redirect()->back()->with('success', 'Receta eliminada exitosamente');
    }

    public function generarPdf(){
        $mi_receta = Receta::all();

        $pdf = Pdf::loadView('home.prescriptions.prescription_pdf', compact('mi_receta'));
        return $pdf->stream();
        //download('recetas.pdf');
    }
}
