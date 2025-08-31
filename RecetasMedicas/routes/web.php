<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

////////////////////////////RUTAS PUBLICAS///////////////////////////////////////
Route::get('/', function() {
    return redirect()->route('login');
});
Route::get('/login', [HomeController::class, 'index'])->name('login'); //login
Route::post('/login', [HomeController::class, 'viewLogin'])->name('login.procces');
Route::post('/logout', [HomeController::class, 'logout'])->name('login.logout');
Route::get('/register', [HomeController::class, 'create'])->name('register');
Route::post('/register/registro', [HomeController::class, 'store'])->name('register.store');


///////////////////////MIDDLEWARES/////////////////////////////////////////////
Route::middleware(['auth', RoleMiddleware::class.':admin'])->group( function(){

    Route::get('/users', [EstablecimientoController::class, 'userResgiter'])->name('users');
    Route::get('/register/{id}/edit', [HomeController::class, 'edit'])->name('register.edit');
    Route::put('/register/{id}/edit', [HomeController::class, 'update'])->name('register.update');
    Route::delete('/register/{id}', [HomeController::class, 'destroy'])->name('register.delete');

    // Acceso completo para administradores
    Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos');
    Route::get('/establecimiento', [EstablecimientoController::class, 'index'])->name('establecimiento');
    Route::get('/configuration', [ConfigurationController::class, 'index'])->name('config');
    Route::get('/category', [CategoriaController::class, 'index'])->name('category.index');

    // CRUD Médicos
    Route::post('medicos/doctores', [MedicoController::class, 'store'])->name('medico.create');
    Route::get('/medicos/{id}/edit', [MedicoController::class, 'edit'])->name('medico.edit');
    Route::put('/medicos/{id}/edit', [MedicoController::class, 'update'])->name('medico.update');
    Route::delete('/medicos/{id}', [MedicoController::class, 'destroy'])->name('medico.delete');

    // CRUD Establecimientos
    Route::post('/establecimiento/establ', [EstablecimientoController::class, 'store'])->name('establ.create');
    Route::get('/establecimiento/{id}/edit,', [EstablecimientoController::class, 'edit'])->name('establ.edit');
    Route::put('/establecimiento/{id}/edit', [EstablecimientoController::class, 'update'])->name('establ.update');
    Route::delete('/establecimiento/{id}', [EstablecimientoController::class, 'destroy'])->name('establ.delete');

    // Gestión de categorías de medicamentos
    Route::post('/category/categories', [CategoriaController::class, 'store'])->name('category.create');
    Route::get('/category/{id}/edit', [CategoriaController::class, 'show'])->name('category.edit');
    Route::put('/category/{id}/edit', [CategoriaController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoriaController::class, 'destroy'])->name('category.delete');

    Route::delete('/pacientes/{id}', [PacienteController::class, 'destroy'])->name('paciente.delete');
    Route::delete('/medicamento/{id}', [MedicamentoController::class, 'destroy'])->name('medicamento.delete');
    Route::delete('/recetas/{id}', [RecetaController::class, 'destroy'])->name('receta.delete');
    Route::delete('/consulta/{id}', [ConsultaController::class, 'destroy'])->name('consulta.delete');

});

// Rutas para médicos
Route::middleware(['auth', RoleMiddleware::class.':admin,medico'])->group( function(){

    // Acceso a pacientes
    //Route::get('/pacientes', [PacienteController::class, 'index'])->name('paciente');
    Route::post('pacientes/patient', [PacienteController::class, 'store'])->name('paciente.create');

    // Gestión de consultas
    Route::get('/consulta', [ConsultaController::class, 'index'])->name('consulta.index');
    Route::post('/consulta/consultas', [ConsultaController::class, 'store'])->name('consulta.create');
    Route::get('/consulta/{id}/edit', [ConsultaController::class, 'edit'])->name('consulta.edit');
    Route::put('/consulta/{id}/edit', [ConsultaController::class, 'update'])->name('consulta.update');

    // Gestión de recetas
    Route::get('/recetas', [RecetaController::class, 'index'])->name('prescription');
    Route::post('/recetas/prescription', [RecetaController::class, 'store'])->name('receta.create');
    Route::get('recetas/pdf', [RecetaController::class, 'generarPdf'])->name('verRecetas.pdf');
    Route::get('/recetas/{id}/edit', [RecetaController::class, 'edit'])->name('receta.edit');
    Route::put('/recetas/{id}/edit', [RecetaController::class, 'update'])->name('receta.update');

    // Acceso a medicamentos
    Route::get('/medicamento', [MedicamentoController::class, 'index'])->name('medication');
    Route::post('/medicameno/medicine', [MedicamentoController::class, 'store'])->name('medicamento.create');
    Route::get('/medicamento/{id}/edit', [MedicamentoController::class, 'edit'])->name('medicamento.edit');
    Route::put('/medicamento/{id}/edit', [MedicamentoController::class, 'update'])->name('medicamento.update');

});

// Rutas para pacientes
Route::middleware(['auth', RoleMiddleware::class.':admin,medico,paciente'])->group(function () {
    Route::get('/pacientes', [PacienteController::class, 'index'])->name('paciente');
    Route::get('/recetas', [RecetaController::class, 'index'])->name('prescription');
    Route::get('recetas/pdf', [RecetaController::class, 'generarPdf'])->name('verRecetas.pdf');

    Route::get('pacientes/{id}/edit', [PacienteController::class, 'edit'])->name('paciente.edit');
    Route::put('/pacientes/{id}/edit', [PacienteController::class, 'update'])->name('paciente.update');
});
