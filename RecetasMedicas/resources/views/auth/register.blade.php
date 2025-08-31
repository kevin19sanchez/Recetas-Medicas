@extends('template.template')

@section('title', 'Register')

@section('content')

<!-- Page Wrapper -->
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

        <!-- Divider
        <hr class="sidebar-divider">-->

        {{-- <li class="nav-item">
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
            <a class="nav-link" href="{{route('prescription')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Recetas Medicas</span></a>
        </li> --}}

        <!-- Divider
        <hr class="sidebar-divider d-none d-md-block">-->

        <!-- Sidebar Toggler (Sidebar)
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>-->

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
                    {{-- <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrador</span>
                            <img class="img-profile rounded-circle"
                                src="https://placehold.co/100">
                        </a>
                    </li> --}}

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Registro de Usuario</h4>
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


                                    <form action="{{route('register.store')}}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                    <i class="bi bi-eye"></i> <!-- Icono de Bootstrap -->
                                                </button>
                                            </div>

                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="role" class="form-label">Tipo de Usuario</label>
                                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                                <option value="">Seleccione un rol</option>
                                                <option value="admin">Administrador</option>
                                                <option value="medico">Médico</option>
                                                <option value="paciente">Paciente</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Campo condicional para Admin -->
                                        <div class="mb-3" id="secretKeyDiv" style="display: none;">
                                            <label for="secret_key" class="form-label">Clave Secreta</label>
                                            <input type="password" class="form-control @error('secret_key') is-invalid @enderror" id="admin_secret" name="admin_secret">
                                            @error('secret_key')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Campo condicional para Médico -->
                                        <div class="mb-3" id="licenseDivs" style="display: none;">
                                            <label for="license_number" class="form-label">Número de Licencia</label>
                                            <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number">
                                            @error('license_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary me-2">
                                                <i class="bi bi-floppy"></i> Registrarse
                                            </button>

                                            <a href="{{route('login')}}" class="btn btn-secondary">
                                                <i class="bi bi-box-arrow-in-left"></i> Volver al Login
                                            </a>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <!-- Tabla de usuarios -->
                            {{-- <div class="card mt-4">
                                <div class="card-header">
                                    <h4 class="mb-0">Usuarios Registrados</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Correo</th>
                                                    <th>Rol</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($newuser as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{ucfirst($user->role)}}</td>
                                                    <td>
                                                        <a href="{{route('register.edit', $user->id)}}"  class="btn btn-sm btn-info edit-doctor" >
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{route('register.delete', $user->id)}}" method="POST" class="d-inline">
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
                            </div> --}}
                            <!--termina div de la tabla-->
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const roleSelect = document.getElementById('role');
                const secretKeyDiv = document.getElementById('secretKeyDiv');
                const licenseDiv = document.getElementById('licenseDivs');

                roleSelect.addEventListener('change', function() {
                    // Ocultar todos los campos condicionales
                    secretKeyDiv.style.display = 'none';
                    licenseDiv.style.display = 'none';

                    // Mostrar campo según el rol seleccionado
                    if (this.value === 'admin') {
                        secretKeyDiv.style.display = 'block';
                    } else if (this.value === 'medico') {
                        licenseDiv.style.display = 'block';
                    }
                });

                // Ejecutar el evento change al cargar la página para manejar datos old()
                roleSelect.dispatchEvent(new Event('change'));
            });

            document.getElementById("togglePassword").addEventListener("click", function() {
                var passwordInput = document.getElementById("password");
                var icon = this.querySelector("i");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.classList.remove("bi-eye");
                    icon.classList.add("bi-eye-slash");
                } else {
                    passwordInput.type = "password";
                    icon.classList.remove("bi-eye-slash");
                    icon.classList.add("bi-eye");
                }
            });
            </script>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@endsection

{{--@section('scripts')
<script>
    function toggleFields(){
        var role = document.getElementById("role").value;
        var licenseField = document.getElementById("license_field");
        var adminSecretField = document.getElementById("admin_secret_field");

        // Verificar que los elementos existen antes de acceder a sus propiedades
        if (licenseField) {
            licenseField.style.display = "none";
        }

        if (adminSecretField) {
            adminSecretField.style.display = "none";
        }

        // Mostrar el campo correspondiente según el rol seleccionado
        if (role === "medico" && licenseField) {
            licenseField.style.display = "block";
        } else if (role === "admin" && adminSecretField) {
            adminSecretField.style.display = "block";
        }
    }

    // Ejecutar la función cuando la página cargue (en caso de edición de datos)
        document.addEventListener("DOMContentLoaded", function() {
                toggleFields();
            });

</script>
@endsection--}}
