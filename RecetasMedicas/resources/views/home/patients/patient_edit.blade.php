@extends('template.template')

@section('title', 'Patients')

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
                            <h4>Registro de Pacientes</h4>
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
                            <form action="{{route('paciente.update', $pacientesedit->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="{{ $pacientesedit->name }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ $pacientesedit->last_name }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="age" class="form-label">Edad</label>
                                        <input type="text" class="form-control" id="age" name="age" required value="{{ $pacientesedit->age }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dui" class="form-label">DUI</label>
                                        <input type="text" class="form-control" id="dui" name="dui" required placeholder="00000000-0" value="{{ $pacientesedit->dui }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="date_birth" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ $pacientesedit->date_birth }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="0000-0000" value="{{ $pacientesedit->phone }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $pacientesedit->address }}">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-floppy"></i> Actualizar
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
