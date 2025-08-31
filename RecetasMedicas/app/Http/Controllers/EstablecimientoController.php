<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Whoops\Run;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estable =  Establecimiento::all();
        return view('home.configuration.configuration', compact('estable'));
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

        $establ = new Establecimiento();
        //dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|regex:/^\d{4}-\d{4}$/',
            'email' => 'required|email|unique:establecimientos,email',
            'code' => 'required|string|max:20|unique:establecimientos,code|regex:/^[A-Z]{3}-\d{3}$/',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
        ],[
            'code.required' => 'El código es obligatorio.',
            'code.unique' => 'Este código ya está registrado.',
            'code.regex' => 'El código debe tener el formato AAA-123.',
            'name.required' => 'El nombre es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El formato del teléfono debe ser 1234-1234.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe estar en formato JPG, PNG, JPEG o GIF.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('image'), $nombreImagen);
            $establ->imagen = 'image/'. $nombreImagen;
            //dd('si se subio imagen');
        }

        $establ->name = $request->name;
        $establ->address = $request->address;
        $establ->phone = $request->phone;
        $establ->email = $request->email;
        $establ->code = $request->code;

        $establ->save();

        return redirect()->route('establecimiento')->with('success', 'Establecimiento creado exitosamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //$establ = Establecimiento::find($id);
        $establ = Establecimiento::findOrFail($id);
        //dd($establ);
        return view('home.configuration.establ_edit', compact('establ'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $establupdate = Establecimiento::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|digits:8',
            'email' => ['required','email', Rule::unique('establecimientos')->ignore($establupdate->id)],
            'code' => ['required', 'string', 'max:20', Rule::unique('establecimientos')->ignore($establupdate->id)],
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
        ],[
            'code.unique' => 'Este código ya está registrado.',
            'code.regex' => 'El código debe tener el formato AAA-123.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
            'address.string' => 'La dirección debe ser un texto válido.',
            'address.max' => 'La dirección no debe superar los 500 caracteres.',
            'phone.regex' => 'El formato del teléfono debe ser 1234-1234.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'email.max' => 'El correo no debe superar los 255 caracteres.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe estar en formato JPG, PNG, JPEG o GIF.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('image', $nombreImagen));
            $establupdate->imagen = 'image'. $nombreImagen;
            //dd('si se subio imagen');
        }

        $establupdate->name = $request->name;
        $establupdate->address = $request->address;
        $establupdate->phone = $request->phone;
        $establupdate->email = $request->email;
        $establupdate->code = $request->code;

        $establupdate->save();

        return redirect()->back()->with('success', 'Establecimiento editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $establdelete = Establecimiento::findOrFail($id);

        $establdelete->delete();

        return redirect()->back()->with('success', 'Establecimiento eliminado exitosamente');
    }

    public function userResgiter(){
        $newuser = Home::all();
        return view('home.users.user_view', compact('newuser'));
    }
}
