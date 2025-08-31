<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patient =  Paciente::all();
        return view('home.patients.patient_index', compact('patient'));
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
        $paciente = new Paciente();

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'dui' => 'required|string|size:10|unique:pacientes,dui',
            'date_birth' => 'nullable|date|before:today',
            'phone' => 'required|string|max:15|regex:/^\d{8,15}$/',
            'address' => 'required|string|max:500',
        ],[
            // Mensajes de error personalizados
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser negativa.',
            'age.max' => 'La edad no puede ser mayor a 150.',
            'dui.required' => 'El DUI es obligatorio.',
            'dui.unique' => 'El DUI ya está registrado.',
            'dui.size' => 'El DUI debe tener exactamente 10 caracteres.',
            'date_birth.date' => 'La fecha de nacimiento debe ser válida.',
            'date_birth.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El teléfono debe contener entre 8 y 15 dígitos.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede exceder los 500 caracteres.',
        ]);

        //dd($request->all());
        $paciente->name = $request->name;
        $paciente->last_name = $request->last_name;
        $paciente->age = $request->age;
        $paciente->dui = $request->dui;
        $paciente->date_birth = $request->date_birth;
        $paciente->phone = $request->phone;
        $paciente->address = $request->address;

        $paciente->save();

        return redirect()->route('paciente')->with('success', 'Paciente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pacientesedit = Paciente::findOrFail($id);
        return view('home.patients.patient_edit', compact('pacientesedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pacienteupdate = Paciente::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150',
            'dui' => ['required','string','size:10', Rule::unique('pacientes', 'dui')->ignore($pacienteupdate->id),],
            'date_birth' => 'nullable|date|before:today',
            'phone' => 'required|regex:/^\d{4}-\d{4}$/',
            'address' => 'required|string|max:500',
        ],[
            // Mensajes personalizados
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser negativa.',
            'age.max' => 'La edad no puede ser mayor a 150.',
            'dui.required' => 'El DUI es obligatorio.',
            'dui.unique' => 'El DUI ya está registrado.',
            'dui.size' => 'El DUI debe tener exactamente 10 caracteres.',
            'date_birth.date' => 'La fecha de nacimiento debe ser válida.',
            'date_birth.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'phone.required' => 'El teléfono es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no puede exceder los 500 caracteres.',
        ]);

        $pacienteupdate->name = $request->name;
        $pacienteupdate->last_name = $request->last_name;
        $pacienteupdate->age = $request->age;
        $pacienteupdate->dui = $request->dui;
        $pacienteupdate->date_birth = $request->date_birth;
        $pacienteupdate->phone = $request->phone;
        $pacienteupdate->address = $request->address;

        $pacienteupdate->save();

        return redirect()->back()->with('success', 'Paciente editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pacientedelete = Paciente::findOrFail($id);

        $pacientedelete->delete();

        return redirect()->back()->with('success', 'Paciente eliminado exitosamente');
    }
}
