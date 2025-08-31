@extends('template.template')

@section('title', 'Category')

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
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Nueva Categoría de Medicamentos</h4>
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
                            <form action="{{route('category.create')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror" id="name"name="name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-floppy"></i> Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Categorías de Medicamentos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($showcategory as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->description}}</td>
                                                <td>
                                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-sm btn-info edit-doctor">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <form action="{{route('category.delete', $category->id)}}" method="POST" class="d-inline">
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
