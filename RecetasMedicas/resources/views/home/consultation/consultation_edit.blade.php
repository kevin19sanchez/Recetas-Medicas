@extends('template.template')

@section('title', 'Consultation Edit')

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
                                    <h3>Editar Consulta</h3>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                                    <form action="{{route('consulta.update', $consultas1->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <!-- Primera columna -->
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Paciente</label>
                                                    <select name="paciente_id" id="paciente_id" class="form-control @error('paciente_id') is-invalid @enderror" required>
                                                        <option value="">Seleccione un paciente</option>
                                                        @foreach($paciente1 as $paciente)
                                                            <option value="{{ $paciente->id }}" {{$consultas1->paciente_id == $paciente->id ? 'selected' : ''}}>
                                                                {{ $paciente->name }}
                                                            </option>
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
                                                        @foreach($medico1 as $medico)
                                                            <option value="{{ $medico->id }}" {{$consultas1->medico_id == $medico->id ? 'selected' : ''}}>
                                                                {{ $medico->name }}
                                                            </option>
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
                                                        @foreach($estbles1 as $establecimientos)
                                                            <option value="{{ $establecimientos->id }}" {{$consultas1->establecimiento_id == $establecimientos->id ? 'selected' : ''}}>
                                                                {{ $establecimientos->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('establecimiento_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Fecha Consulta</label>
                                                    <input type="date" name="fecha_consulta" id="fecha_consulta" class="form-control" required
                                                    value="{{ \Carbon\Carbon::parse($consultas1->fecha_consulta)->format('Y-m-d') }}">
                                                    @error('fecha_consulta')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Segunda columna -->
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Motivo de Consulta</label>
                                                    <textarea name="motivo_consulta" id="motivo_consulta" class="form-control @error('motivo_consulta') is-invalid @enderror"
                                                    required rows="3">{{$consultas1->motivo_consulta}}</textarea>
                                                    @error('motivo_consulta')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Síntomas</label>
                                                    <textarea name="sintomas" id="sintomas" class="form-control @error('sintomas') is-invalid @enderror"
                                                    required rows="3">{{$consultas1->sintomas}}</textarea>
                                                    @error('sintomas')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Diagnóstico</label>
                                                    <textarea name="diagnostico" id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror"
                                                    required rows="3">{{$consultas1->diagnostico}}</textarea>
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
                                                            <input type="text" name="presion_arterial" id="presion_arterial" class="form-control"
                                                            value="{{$consultas1->presion_arterial}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Temperatura</label>
                                                            <input type="number" step="0.1" name="temperatura" id="temperatura" class="form-control"
                                                            value="{{$consultas1->temperatura}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Peso</label>
                                                            <input type="number" step="0.1" name="peso" id="peso" class="form-control"
                                                            value="{{$consultas1->peso}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Próxima Cita</label>
                                                    <input type="date" name="proxima_cita" id="proxima_cita" class="form-control"
                                                    value="{{$consultas1->proxima_cita}}">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Estado</label>
                                                    <select name="estado" id="estado" class="form-control">
                                                        <option value="activa" {{$consultas1->estado == 'activa' ? 'selected' : ''}}>Activa</option>
                                                        <option value="completada" {{$consultas1->estado == 'completada' ? 'selected' : ''}}>Completada</option>
                                                        <option value="cancelada" {{$consultas1->estado == 'cancelada' ? 'selected' : ''}}>Cancelada</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Observaciones</label>
                                                    <textarea name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror"
                                                    required rows="3">{{$consultas1->observaciones}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-floppy"></i> Editar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
