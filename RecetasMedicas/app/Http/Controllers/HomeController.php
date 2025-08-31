<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$newuser = Home::all();
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            //dd($request->all());

            // Validación de datos
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:homes,email',
                'password' => 'required|string|min:6',
                'role' => 'required|in:admin,medico,paciente',
                'license_number' => 'nullable|string|unique:homes,license_number',
                'admin_secret' => 'nullable|string', // Solo si es médico
            ],[
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser un texto válido.',
                'name.max' => 'El nombre no puede superar los 255 caracteres.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'Debe ingresar un correo electrónico válido.',
                'email.unique' => 'Este correo ya está registrado.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.string' => 'La contraseña debe ser un texto.',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'role.required' => 'El rol es obligatorio.',
                'role.in' => 'El rol debe ser admin, medico o paciente.',
                'license_number.unique' => 'El número de licencia ya está registrado.',
                'admin_secret.required' => 'La clave de administrador es obligatoria para los administradores.'
            ]);

            // Verificar clave secreta para administradores
            if ($request->role === 'admin' && $request->admin_secret !== 'SuperClave123') {
                return redirect()->back()->withErrors(['admin_secret' => 'Clave secreta incorrecta.']);
            }

            $registeruser = new Home();
            $registeruser->name = $request->name;
            $registeruser->email = $request->email;
            $registeruser->password = Hash::make($request->password);
            $registeruser->role = $request->role;

            //dd('se guardo');

            // Solo guardar license_number si el usuario es médico
            if ($request->role === 'medico') {
                $registeruser->license_number = $request->license_number;
            }

            // Solo guardar admin_secret si el usuario es administrador
            if ($request->role === 'admin') {
                $registeruser->admin_secret = $request->admin_secret;
            }

            $registeruser->save();

            return redirect()->back()->with('success', 'Usuario ingresado exitosamente');


        } catch (\Exception $e) {

            Log::error('Error al guardar usuario:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al registrar usuario.');
        }
    }

    public function viewLogin(Request $request){


        // Validar los datos ingresados
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = $request->email;

        // Verificar si el correo contiene alguno de los tipos de usuario permitidos
        $validTypes = ['paciente', 'medico', 'admin'];
        $hasValidType = false;

        foreach ($validTypes as $type) {
            if (strpos($email, "@" . $type) !== false) {
                $hasValidType = true;
                break;
            }
        }

        if (!$hasValidType) {
            return redirect()->back()->withErrors([
                'email' => 'Este tipo de correo no tiene permiso para acceder'
            ]);
        }

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerar la sesión por seguridad
            return redirect()->route('establecimiento');
        }

        // Si falla, redirigir con un mensaje de error
        return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $useredit = Home::findOrFail($id);
        return view('auth.register_edit', compact('useredit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userupdate = Home::findOrFail($id);

        //dd($request->all());

        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id, // Evita duplicados al editar
            'password' => 'nullable|string|min:6', // Opcional cambiar contraseña
            'role' => 'required|in:admin,medico,paciente',
            'license_number' => 'nullable|string|unique:homes,license_number,' . $id,
            'admin_secret' => 'nullable|string',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.string' => 'La contraseña debe ser un texto.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'El rol es obligatorio.',
            'role.in' => 'El rol debe ser admin, medico o paciente.',
            'license_number.unique' => 'El número de licencia ya está registrado.',
            'admin_secret.required' => 'La clave de administrador es obligatoria para los administradores.'
        ]);

        $userupdate->name = $request->name;
        $userupdate->email = $request->email;
        $userupdate->role = $request->role;

        // Solo actualiza la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $userupdate->password = bcrypt($request->password);
        }

        $userupdate->save(); // Guarda los cambios

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userdelete = Home::findOrFail($id);

        $userdelete->delete();

        return redirect()->back()->with('success', 'Usuario eliminado exitosamente');
    }
}
