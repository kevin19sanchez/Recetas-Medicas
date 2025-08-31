@extends('template.template')

@section('title', 'Doctor Register')

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

                <!-- Content Row -->
                <div class="container">
                    <!-- Formulario de Registro -->
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registro de Médico</h4>
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

                                    <form action="{{route('medico.create')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="code">Código</label>
                                                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
                                                    <small class="text-muted">Ejemplo: MED-001</small>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="name">Nombre Completo</label>
                                                    <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="specialty">Especialidad</label>
                                                    <input type="text" class="form-control" id="specialty" name="specialty" value="{{ old('specialty') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="phone">Teléfono</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="email">Correo Electrónico</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="establishment_id">Establecimiento</label>
                                                    <select class="form-control" id="establecimiento_id" name="establecimiento_id" required>
                                                        <option value="">Seleccione un establecimiento</option>
                                                        @foreach ($establ as $location)
                                                            <option value="{{$location->id}}">
                                                                {{$location->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-floppy"></i> Guardar
                                            </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Médicos -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Lista de Médicos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Especialidad</th>
                                                    <th>Establecimiento</th>
                                                    <th>Contacto</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($doctores as $medico)
                                                    <tr>
                                                        <td>{{$medico->code}}</td>
                                                        <td>{{$medico->name}}</td>
                                                        <td>{{$medico->specialty}}</td>
                                                        <td>{{$medico->establecimiento->name}}</td>
                                                        <td>
                                                            <small>
                                                                <i class="bi bi-telephone"></i> {{$medico->phone}}<br>
                                                                <i class="bi bi-envelope"></i> {{$medico->email}}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('medico.edit', $medico->id)}}" class="btn btn-sm btn-info">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>

                                                            <form action="{{route('medico.delete', $medico->id)}}" method="POST" class="d-inline">
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
                                    </div>

                                    <!-- Paginación -->
                                    <div class="d-flex justify-content-center mt-3">
                                        <!-- Paginación cuerpo-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Edición -->
                <div class="modal fade" id="editModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Médico</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- El formulario de edición se llenará vía JavaScript -->
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
