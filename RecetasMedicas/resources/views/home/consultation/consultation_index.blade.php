@extends('template.template')

@section('title', 'Consultation')

@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <!--<i class="fas fa-laugh-wink"></i>-->
                <i class="bi bi-hospital-fill"></i>
            </div>
            <div class="sidebar-brand-text mx-3">My Recipes</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{route('establecimiento')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Establecimientos</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('medicos')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Medicos</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('paciente')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Pacientes</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('medication')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Medicamentos</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('prescription')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Recetas Medicas</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('consulta.index')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Consulta</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('category.index')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Categoria</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('users')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Usuarios Registrados</span></a>
        </li>

        <li class="nav-item">
            <form action="{{ route('login.logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-dark w-100">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class=""></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                {{ auth()->user()->name }}
                            </span>
                            <img class="img-profile rounded-circle"
                                src="https://placehold.co/100">
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div class="container">
                    <!-- Formulario de Registro -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Registro de Nueva Consulta</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('consulta.create')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <!-- Primera columna -->
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Paciente</label>
                                                    <select name="paciente_id" id="paciente_id" class="form-control @error('paciente_id') is-invalid @enderror" required>
                                                        <option value="">Seleccione un paciente</option>
                                                        @foreach($paciente as $pacientes)
                                                            <option value="{{ $pacientes->id }}">{{ $pacientes->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('paciente_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Médico</label>
                                                    <select name="medico_id" id="medico_id" class="form-control @error('medico_id') is-invalid @enderror" required>
                                                        <option value="">Seleccione un médico</option>
                                                        @foreach($medico as $medicos)
                                                            <option value="{{ $medicos->id }}">{{ $medicos->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('medico_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Establecimiento</label>
                                                    <select name="establecimiento_id" id="establecimiento_id" class="form-control @error('establecimiento_id') is-invalid @enderror" required>
                                                        <option value="">Seleccione establecimiento</option>
                                                        @foreach($estbles as $establecimiento)
                                                            <option value="{{ $establecimiento->id }}">{{ $establecimiento->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('establecimiento_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Fecha Consulta</label>
                                                    <input type="date" name="fecha_consulta" id="fecha_consulta" class="form-control @error('fecha_consulta') is-invalid @enderror" required>
                                                    @error('fecha_consulta')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Segunda columna -->
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Motivo de Consulta</label>
                                                    <textarea name="motivo_consulta" id="motivo_consulta" class="form-control @error('motivo_consulta') is-invalid @enderror" required rows="3"></textarea>
                                                    @error('motivo_consulta')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Síntomas</label>
                                                    <textarea name="sintomas" id="sintomas" class="form-control @error('sintomas') is-invalid @enderror" required rows="3"></textarea>
                                                    @error('sintomas')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Diagnóstico</label>
                                                    <textarea name="diagnostico" id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" required rows="3"></textarea>
                                                    @error('diagnostico')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Tercera columna -->
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Presión</label>
                                                            <input type="text" name="presion_arterial" id="presion_arterial" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Temperatura</label>
                                                            <input type="number" step="0.1" name="temperatura" id="temperatura" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Peso</label>
                                                            <input type="number" step="0.1" name="peso" id="peso" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Próxima Cita</label>
                                                    <input type="date" name="proxima_cita" id="proxima_cita" class="form-control">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Estado</label>
                                                    <select name="estado" id="estado" class="form-control">
                                                        <option value="activa">Activa</option>
                                                        <option value="completada">Completada</option>
                                                        <option value="cancelada">Cancelada</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Observaciones</label>
                                                    <textarea name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" required rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-floppy"></i> Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Consultas -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Lista de Consultas</h3>
                                </div>
                                <div class="card-body">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Paciente</th>
                                                    <th>Médico</th>
                                                    <th>Establecimiento</th>
                                                    <th>Diagnóstico</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($consultas as $consult)
                                                <tr>
                                                    <td>{{ date('Y-m-d', strtotime($consult->fecha_consulta)) }}</td>
                                                    <td>{{ $consult->paciente->name }}</td>
                                                    <td>{{ $consult->medico->name }}</td>
                                                    <td>{{ $consult->establecimiento->name }}</td>
                                                    <td>{{ $consult->diagnostico }}</td>
                                                    <td>
                                                        @if($consult->estado == 'activa')
                                                            <span class="badge bg-primary">Activa</span>
                                                        @elseif($consult->estado == 'completada')
                                                            <span class="badge bg-success">Completada</span>
                                                        @else
                                                            <span class="badge bg-danger">Cancelada</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('consulta.edit', $consult->id)}}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{route('consulta.delete', $consult->id)}}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- $consultas->links() --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>MY RECIPES 2025 &copy;</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@endsection
