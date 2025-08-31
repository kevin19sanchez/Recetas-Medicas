<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Establecimiento;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paciente = Paciente::all();
        $medico = Medico::all();
        $estbles = Establecimiento::all();
        $consultas = Consulta::all();
        return view('home.consultation.consultation_index', compact('paciente','medico','estbles', 'consultas'));
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
        $consult = new Consulta();
        //dd($request->all());

        $request->validate([
            'fecha_consulta' => 'required|date_format:d/m/Y',
            'motivo_consulta' => 'required|string|min:3|max:500',
            'sintomas' => 'required|string|min:3|max:1000',
            'diagnostico' => 'required|string|min:3|max:1000',
            'observaciones' => 'nullable|string|max:1000',
            'presion_arterial' => 'nullable|string|max:10|regex:/^\d{2,3}\/\d{2,3}$/',
            'temperatura' => 'nullable|numeric|min:30|max:45',
            'peso' => 'nullable|numeric|min:1|max:300',
            'proxima_cita' => 'nullable|date|after_or_equal:fecha_consulta',
            'estado' => 'required|string|in:activa,finalizada,cancelada',
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'establecimiento_id' => 'required|exists:establecimientos,id',
        ],[
            'fecha_consulta.required' => 'La fecha de la consulta es obligatoria.',
            'fecha_consulta.date_format' => 'El formato de fecha debe ser YYYY-MM-DD.',
            'motivo_consulta.required' => 'El motivo de la consulta es obligatorio.',
            'sintomas.required' => 'Los síntomas son obligatorios.',
            'diagnostico.required' => 'El diagnóstico es obligatorio.',
            'presion_arterial.regex' => 'El formato de la presión arterial debe ser XX/XX o XXX/XX.',
            'temperatura.numeric' => 'La temperatura debe ser un número.',
            'peso.numeric' => 'El peso debe ser un número.',
            'proxima_cita.after_or_equal' => 'La próxima cita debe ser posterior o igual a la fecha de la consulta.',
            'estado.in' => 'El estado debe ser activa, finalizada o cancelada.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'establecimiento_id.exists' => 'El establecimiento seleccionado no existe.',
        ]);

        $consult->paciente_id = $request->paciente_id;
        $consult->medico_id = $request->medico_id;
        $consult->establecimiento_id = $request->establecimiento_id;
        $consult->fecha_consulta = $request->fecha_consulta;
        $consult->motivo_consulta =  $request->motivo_consulta;
        $consult->sintomas = $request->sintomas;
        $consult->diagnostico = $request->diagnostico;
        $consult->observaciones = $request->observaciones;
        $consult->presion_arterial = $request->presion_arterial;
        $consult->temperatura = $request->temperatura;
        $consult->peso = $request->peso;
        $consult->proxima_cita = $request->proxima_cita;
        $consult->estado = $request->estado;

        $consult->save();

        return redirect()->route('consulta.index')->with('success', 'Consulta creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consultas1 = Consulta::findOrFail($id);
        $paciente1 = Paciente::all();
        $medico1 = Medico::all();
        $estbles1 = Establecimiento::all();
        return view('home.consultation.consultation_edit', compact('consultas1','paciente1','medico1','estbles1'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $consultupdate = Consulta::findOrFail($id);
        //dd($request->all());

        $request->validate([
            'fecha_consulta' => 'sometimes|date_format:d/m/Y H:i:s',
            'motivo_consulta' => 'sometimes|string|min:3|max:500',
            'sintomas' => 'sometimes|string|min:3|max:1000',
            'diagnostico' => 'sometimes|string|min:3|max:1000',
            'observaciones' => 'nullable|string|max:1000',
            'presion_arterial' => 'nullable|string|max:10|regex:/^\d{2,3}\/\d{2,3}$/',
            'temperatura' => 'nullable|numeric|min:30|max:45',
            'peso' => 'nullable|numeric|min:1|max:300',
            'proxima_cita' => 'nullable|date_format:d/m/Y|after_or_equal:fecha_consulta',
            'estado' => 'sometimes|string|in:activa,finalizada,cancelada',
            'paciente_id' => 'sometimes|exists:pacientes,id',
            'medico_id' => 'sometimes|exists:medicos,id',
            'establecimiento_id' => 'sometimes|exists:establecimientos,id',
        ],[
            'fecha_consulta.date_format' => 'El formato de fecha debe ser DD/MM/YYYY HH:MM:SS.',
            'motivo_consulta.min' => 'El motivo de consulta debe tener al menos 3 caracteres.',
            'sintomas.required' => 'Los síntomas son obligatorios.',
            'diagnostico.required' => 'El diagnóstico es obligatorio.',
            'presion_arterial.regex' => 'El formato de la presión arterial debe ser XX/XX o XXX/XX.',
            'temperatura.numeric' => 'La temperatura debe ser un número válido.',
            'peso.numeric' => 'El peso debe ser un número válido.',
            'proxima_cita.date_format' => 'El formato de la próxima cita debe ser DD/MM/YYYY.',
            'proxima_cita.after_or_equal' => 'La próxima cita debe ser posterior o igual a la fecha de la consulta.',
            'estado.in' => 'El estado debe ser activa, finalizada o cancelada.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'establecimiento_id.exists' => 'El establecimiento seleccionado no existe.',
        ]);

        $consultupdate->paciente_id = $request->paciente_id;
        $consultupdate->medico_id = $request->medico_id;
        $consultupdate->establecimiento_id = $request->establecimiento_id;
        $consultupdate->fecha_consulta = $request->fecha_consulta;
        $consultupdate->motivo_consulta =  $request->motivo_consulta;
        $consultupdate->sintomas = $request->sintomas;
        $consultupdate->diagnostico = $request->diagnostico;
        $consultupdate->observaciones = $request->observaciones;
        $consultupdate->presion_arterial = $request->presion_arterial;
        $consultupdate->temperatura = $request->temperatura;
        $consultupdate->peso = $request->peso;
        $consultupdate->proxima_cita = $request->proxima_cita;
        $consultupdate->estado = $request->estado;

        $consultupdate->save();

        return redirect()->back()->with('success', 'Consulta editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consultdelete = Consulta::findOrFail($id);

        $consultdelete->delete();

        return redirect()->back()->with('success', 'Consulta eliminada exitosamente');
    }
}
