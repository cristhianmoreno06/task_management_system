@extends('layouts.vertical', ['title' => 'Tareas', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Listado','sub_title' => 'Tareas'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center"> <!-- Utiliza align-items-center para centrar verticalmente -->
                        <div class="col-md-3">
                            <h4 class="header-title">Listado de Tareas</h4>
                        </div>
                        <div class="col-md-6"> <!-- Utiliza col-md-3 para la barra de búsqueda -->
                            <div class="app-search"> <!-- Utiliza flexbox para centrar horizontalmente -->
                                <form action="{{ route('tasks.index') }}" method="GET" id="search-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInputTask" name="search" placeholder="Buscar en la tabla..." value="{{ request('search') }}">
                                        <span type="submit" class="ri-search-line search-icon text-muted"></span>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="checkbox" id="completedCheckbox" name="completed" value="1" {{ request('completed') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="completedCheckbox">Completadas</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="checkbox" id="notCompletedCheckbox" name="not_completed" value="1" {{ request('not_completed') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="notCompletedCheckbox">No Completadas</label>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="userSelect">Usuario:</label>
                                        <select id="userSelect" name="user_id" class="form-control">
                                            <option value="">Todos los usuarios</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end"> <!-- Utiliza col-md-3 para el botón y d-flex + justify-content-end para alinear a la derecha -->
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nueva Tarea</a>
                        </div>
                    </div>
                </div>
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
                                            {{--<a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i></a>--}}
                                            <h5 class="me-1">
                                                <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <span class="badge bg-danger rounded-pill delete-btn" data-id="{{ $task->id }}" role="button">Eliminar tarea</span>
                                                </form>
                                            </h5>
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
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
@endsection

@section('script')
    @vite(['resources/js/pages/form-advanced.init.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#searchInputTask').on('input', function () {
                var searchText = $(this).val().toLowerCase();
                $('table tbody tr').each(function () {
                    var textContent = $(this).text().toLowerCase();
                    $(this).toggle(textContent.includes(searchText));
                });
            });

            $('#completedCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#notCompletedCheckbox').prop('checked', false);
                }
                $('#search-form').submit();
            });

            $('#notCompletedCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#completedCheckbox').prop('checked', false);
                }
                $('#search-form').submit();
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
                Swal.fire({
                    icon: 'error',
                    title: 'Error 500',
                    text: '{{ session('error') }}',
                });
            });
        </script>
    @endif
@endsection
