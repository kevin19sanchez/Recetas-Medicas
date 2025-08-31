<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $establ = Establecimiento::all();
        $doctores = Medico::all();
        return view('home.personal_doctor.index', compact('establ', 'doctores'));
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
        $medico = new Medico();

        $request->validate([
            'code' => 'required|string|max:255|unique:medicos,code|regex:/^[A-Z]{3}-\d{3}$/',
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'license_number' => 'required|string|max:255|unique:medicos,license_number',
            'phone' => 'required|regex:/^\d{4}-\d{4}$/',
            'email' => 'required|email|max:255|unique:medicos,email',
            'establecimiento_id' => 'required|exists:establecimientos,id',
        ],[
            // Mensajes personalizados de error
            'code.required' => 'El código del médico es obligatorio.',
            'code.unique' => 'El código del médico ya está en uso.',
            'name.required' => 'El nombre del médico es obligatorio.',
            'specialty.required' => 'La especialidad del médico es obligatoria.',
            'license_number.required' => 'El número de licencia médica es obligatorio.',
            'license_number.unique' => 'El número de licencia ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El teléfono debe contener 8 dígitos.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'establecimiento_id.required' => 'El establecimiento es obligatorio.',
            'establecimiento_id.exists' => 'El establecimiento seleccionado no es válido.',
        ]);

        //dd($request->all());
        $medico->code = $request->code;
        $medico->name = $request->name;
        $medico->specialty = $request->specialty;
        $medico->email = $request->email;
        $medico->phone = $request->phone;
        $medico->establecimiento_id = $request->establecimiento_id;

        $medico->save();

        return redirect()->route('medicos')->with('success', 'Medico creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicos = Medico::findOrFail($id);
        $establecemientos = Establecimiento::all();
        return view('home.personal_doctor.medico_edit', compact('medicos', 'establecemientos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicos1 = Medico::findOrFail($id);

        $request->validate([
            'code' => ['required','string','max:255', Rule::unique('medicos', 'code')->ignore($id),],
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'license_number' => ['required','string','max:255', Rule::unique('medicos', 'license_number')->ignore($id),],
            'phone' => 'required|string|max:15|regex:/^\d{8,15}$/',
            'email' => ['required','email','max:255', Rule::unique('medicos', 'email')->ignore($id),],
            'establecimiento_id' => 'required|exists:establecimientos,id',
        ],[
            // Mensajes personalizados
            'code.required' => 'El código del médico es obligatorio.',
            'code.unique' => 'El código del médico ya está en uso.',
            'name.required' => 'El nombre del médico es obligatorio.',
            'specialty.required' => 'La especialidad del médico es obligatoria.',
            'license_number.required' => 'El número de licencia médica es obligatorio.',
            'license_number.unique' => 'El número de licencia ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El teléfono debe contener entre 8 y 15 dígitos.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'establecimiento_id.required' => 'El establecimiento es obligatorio.',
            'establecimiento_id.exists' => 'El establecimiento seleccionado no es válido.',
        ]);

        $medicos1->code = $request->code;
        $medicos1->name = $request->name;
        $medicos1->specialty = $request->specialty;
        $medicos1->email = $request->email;
        $medicos1->phone = $request->phone;
        $medicos1->establecimiento_id = $request->establecimiento_id;

        $medicos1->save();

        return redirect()->back()->with('success', 'Medico editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicosdelete = Medico::findOrFail($id);

        $medicosdelete->delete();

        return redirect()->back()->with('success', 'Medico eliminado exitosamente');
    }
}
