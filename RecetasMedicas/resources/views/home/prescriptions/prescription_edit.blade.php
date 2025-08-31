@extends('template.template')

@section('title', 'Prescription')

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

                <!-- Content Row -->
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Actulizar Recetas</h4>
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
                            <form action="{{route('receta.update', $recetaedit->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha" class="form-label">Fecha</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" required value="{{ $recetaedit->fecha }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="medico_id">Médico</label>
                                            <select name="medico_id" id="medico_id" class="form-control" required>
                                                <option value="">Seleccione un médico</option>
                                                @foreach ($medicoedit as $medico)
                                                    <option value="{{ $medico->id}}">
                                                        {{ old('medico_id', $recetaedit->medico_id) == $medico->id ? 'selected' : '' }}
                                                        {{$medico->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="paciente_id">Paciente</label>
                                        <select name="paciente_id" id="paciente_id" class="form-control" required>
                                            <option value="">Seleccione un paciente</option>
                                            @foreach ($pacientesedit as $paciente)
                                                <option value="{{$paciente->id}}">
                                                    {{ old('paciente_id', $recetaedit->id) == $paciente->id ? 'selected' : '' }}
                                                    {{$paciente->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="establecimiento_id">Establecimiento</label>
                                        <select name="establecimiento_id" id="establecimiento_id" class="form-control" required>
                                            <option value="">Seleccione un establecimiento</option>
                                            @foreach ($establedit as $estables)
                                                <option value="{{$estables->id}}">
                                                    {{ old('establecimiento_id', $recetaedit->id) == $estables->id ? 'selected' : '' }}
                                                    {{$estables->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" required value="{{ $recetaedit->cantidad }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dosis" class="form-label">Dosis</label>
                                        <input type="text" class="form-control" id="dosis" name="dosis" required value="{{ $recetaedit->dosis }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="indicaciones" class="form-label">Indicaciones</label>
                                        <input type="text" class="form-control" id="indicaciones" name="indicaciones" required value="{{ $recetaedit->indicaciones }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="medicamentos">Medicamentos</label>
                                        <textarea name="medicamentos" id="medicamentos" class="form-control" rows="3" required value="{{ old($recetaedit->medicamentos) }}"></textarea>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-floppy"></i> Actulizar
                                    </button>
                                </div>
                            </form>
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
