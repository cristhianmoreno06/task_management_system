@extends('layouts.vertical', ['title' => 'Profile', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/select2/dist/css/select2.min.css', 'node_modules/daterangepicker/daterangepicker.css', 'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css', 'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'node_modules/flatpickr/dist/flatpickr.min.css'])
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="profile-bg-picture"
                style="background-image:url('/images/bg-profile.jpg')">
                <span class="picture-bg-overlay"></span>
                <!-- overlay -->
            </div>
            <!-- meta -->
            <div class="profile-user-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="profile-user-img">
                            <div class="avatar-xl" style="width: 6rem; height: 6rem; top: -56px; position: absolute">
                                <span class="avatar-lg rounded-circle avatar-title bg-primary-subtle text-primary fs-24 rounded-circle">{{ Auth::user()->getInitials() }}</span>
                            </div>
                            {{--<img src="/images/users/avatar-1.jpg" alt="" class="avatar-lg rounded-circle">--}}
                        </div>
                        <div class="">
                            <h4 class="mt-4 fs-17 ellipsis">{{ $user->name }}</h4>
                            {{--<p class="font-13"> {{ $user->username }}</p>--}}
                            <p class="text-muted mb-0"><small>Bogotá, Colombia</small></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <button type="button" class="btn btn-soft-danger">
                                <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                Edit Profile
                            </button>
                            <a class="btn btn-soft-info" href="#"> <i class="ri-check-double-fill fs-18 me-1 lh-1"></i> Following</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ meta -->
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="profile-content">
                        <ul class="nav nav-underline nav-justified gap-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile">Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab" aria-controls="home" aria-selected="true" href="#projects">Projects</a>
                            </li>
                        </ul>

                        <div class="tab-content m-0 p-4">
                            <!-- settings -->
                            <div id="edit-profile" class="tab-pane active">
                                <div class="user-profile-content">
                                    <form method="POST" action="{{ route('profile.update', Auth::id()) }}">
                                        @csrf
                                        <div class="row row-cols-sm-2 row-cols-1">
                                            <div class="mb-2">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Enter your name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Enter your email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="6 - 15 Characters">
                                                    <span class="input-group-text bg-white">
                                                        <i class="ri-eye-line cursor-pointer" id="togglePassword"></i>
                                                    </span>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <label for="password-confirm" class="form-label">Re-Password</label>
                                                <div class="input-group">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="6 - 15 Characters">
                                                    <span class="input-group-text bg-white">
                                                        <i class="ri-eye-line cursor-pointer" id="togglePasswordConfirm"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
                                    </form>
                                </div>
                            </div>

                            <!-- about-me -->
                            <div class="tab-pane" id="aboutme" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="profile-desk">
                                    <h5 class="text-uppercase fs-17 text-dark">{{ $user->name }}</h5>
                                    <h5 class="mt-4 fs-17 text-dark">Contact Information</h5>
                                    <table class="table table-condensed mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Url</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                        www.taskmanagement.com
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>
                                                    <a href="#" class="ng-binding">
                                                        {{ $user->email }}
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Nombre de Usuario</th>
                                                <td class="ng-binding">{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Rol asignado</th>
                                                <td class="ng-binding">{{ $user->role->name }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div>

                            <!-- profile -->
                            <div id="projects" class="tab-pane">
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="table-responsive-sm">
                                                <table class="table table-hover table-centered mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>Titulo</th>
                                                        <th>Descripción</th>
                                                        <th>Fecha de expiración</th>
                                                        <th>Usuario asignado</th>
                                                        <th>Estado</th>
                                                        <th class="text-center">Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($tasks as $task)
                                                        <tr>
                                                            <td>{{ $task->title }}</td>
                                                            <td>{{ $task->description }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($task->expiration_date)->format('Y-m-d') }}</td>
                                                            <td>{{ $task->user->name }}</td>
                                                            <td>
                                                                <h5 class="me-1">
                                                                    <a href="#" class="change-status-btn" data-id="{{ $task->id }}" data-status="{{ $task->completed }}">
                                                                        @if ($task->completed === 0)
                                                                            <span class="badge bg-danger rounded-pill">{{ $task->completed_status }}</span>
                                                                        @else
                                                                            <span class="badge bg-primary rounded-pill">{{ $task->completed_status }}</span>
                                                                        @endif
                                                                    </a>
                                                                </h5>
                                                            </td>
                                                            <td class="col-md-2">
                                                                <div class="btn-group" role="group" aria-label="Acciones">
                                                                    <h5 class="me-1">
                                                                        <a href="{{ route('tasks.show', $task->id) }}">
                                                                            <span class="badge bg-primary rounded-pill">Ver tarea</span>
                                                                        </a>
                                                                    </h5>
                                                                    {{--<a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm me-1"><i class="bi bi-eye"></i></a>--}}
                                                                    <h5 class="me-1">
                                                                        <a href="{{ route('tasks.edit', $task->id) }}">
                                                                            <span class="badge bg-info rounded-pill">Editar tarea</span>
                                                                        </a>
                                                                    </h5>
                                                                    @if($user->hasRole('admin'))
                                                                        <h5 class="me-1">
                                                                            <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <span class="badge bg-danger rounded-pill delete-btn" data-id="{{ $task->id }}" role="button">Eliminar tarea</span>
                                                                            </form>
                                                                        </h5>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div> <!-- end table-responsive-->
                                        </div> <!-- end card body-->
                                        <!-- Mostrar enlaces de paginación -->
                                        <div class="pagination pagination-rounded mb-0 justify-content-center">
                                            {{ $tasks->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
<!-- end row -->
@endsection

@section('script')
    @vite(['resources/js/pages/form-advanced.init.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password-confirm');
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const confirmPasswordMatch = document.getElementById('confirmPasswordMatch');
            const confirmPasswordMismatch = document.getElementById('confirmPasswordMismatch');
            const form = document.querySelector('form'); // Asegúrate de que este selector es el adecuado para tu formulario

            // Toggle visibility of password
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            });

            // Toggle visibility of confirm password
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmInput.setAttribute('type', type);
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            });

            // Validate password confirmation on input
            function validatePasswords() {
                if (passwordConfirmInput.value === passwordInput.value) {
                    passwordConfirmInput.classList.remove('is-invalid');
                    passwordConfirmInput.classList.add('is-valid');
                    if (confirmPasswordMatch) confirmPasswordMatch.style.display = 'block';
                    if (confirmPasswordMismatch) confirmPasswordMismatch.style.display = 'none';
                } else {
                    passwordConfirmInput.classList.remove('is-valid');
                    passwordConfirmInput.classList.add('is-invalid');
                    if (confirmPasswordMatch) confirmPasswordMatch.style.display = 'none';
                    if (confirmPasswordMismatch) confirmPasswordMismatch.style.display = 'block';
                }
            }

            passwordConfirmInput.addEventListener('input', validatePasswords);
            passwordInput.addEventListener('input', validatePasswords);

            // Prevent form submission if passwords don't match
            form.addEventListener('submit', function(event) {
                if (passwordInput.value !== passwordConfirmInput.value) {
                    event.preventDefault(); // Prevent form submission
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Las contraseñas no coinciden.',
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.change-status-btn').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const taskId = this.getAttribute('data-id');
                    const taskStatus = parseInt(this.getAttribute('data-status'), 10);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Deseas cambiar el estado de esta tarea?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, cambiar',
                        cancelButtonText: 'No, cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/tasks/change-status/${taskId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ completed: taskStatus === 0 ? 1 : 0 })
                            }).then(response => {
                                if (response.ok) {
                                    Swal.fire(
                                        'Cambiado',
                                        'El estado de la tarea ha sido cambiado.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error',
                                        'Hubo un problema al cambiar el estado de la tarea.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Añadir evento de clic a todos los elementos con la clase 'delete-btn'
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Obtener el ID de la tarea desde el atributo data-id
                    let taskId = this.getAttribute('data-id');

                    // Mostrar la alerta de confirmación
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, bórralo!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Encontrar el formulario correspondiente y enviarlo
                            document.getElementById('delete-form-' + taskId).submit();
                        }
                    });
                });
            });
        });
    </script>

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Asegúrate de que el mensaje esté escapado para evitar problemas de seguridad
                var errorMessage = @json(session('error'));

                // Formatea el mensaje de error
                var formattedMessage = errorMessage.split('\n').map(line => `<p>${line}</p>`).join('');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: formattedMessage, // Usamos html en lugar de text para permitir formato
                });
            });
        </script>
    @endif
@endsection
