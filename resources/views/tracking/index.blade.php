@extends('layouts.vertical', ['title' => 'Rastreo', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    @include('layouts.shared/page-title',['page_title' => 'Listado','sub_title' => 'Rastreo'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center"> <!-- Utiliza align-items-center para centrar verticalmente -->
                        <div class="col-md-3">
                            <h4 class="header-title">Listado de rastreo</h4>
                        </div>
                        <div class="col-md-6"> <!-- Utiliza col-md-3 para la barra de búsqueda -->
                            <div class="app-search"> <!-- Utiliza flexbox para centrar horizontalmente -->
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInputTracking" placeholder="Buscar en la tabla...">
                                        <span class="ri-search-line search-icon text-muted"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end"> <!-- Utiliza col-md-3 para el botón y d-flex + justify-content-end para alinear a la derecha -->
                            <a href="{{ route('tracking.create') }}" class="btn btn-primary">Nuevo Rastreo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                            <tr>
                                <th>Número de rastreo</th>
                                <th>Empresa</th>
                                <th>Identificación del cliente</th>
                                <th>Nombres del cliente</th>
                                <th>Apellidos del cliente</th>
                                <th>Dirección del cliente</th>
                                <th>Teléfono del cliente</th>
                                <th>Características del envío</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tracking as $track)
                                <tr>
                                    <td>{{ $track->number_tracking }}</td>
                                    <td>{{ $track->company }}</td>
                                    <td>{{ $track->identification_number }}</td>
                                    <td>{{ $track->name }}</td>
                                    <td>{{ $track->lastname }}</td>
                                    <td>{{ $track->address }}</td>
                                    <td>{{ $track->number_phone }}</td>
                                    <td>{{ $track->shipping_characteristics }}</td>
                                    <td>
                                        {{ $track->getStatusAttribute() }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a href="{{ route('tracking.show', $track->id) }}" class="btn btn-info btn-sm me-1"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('tracking.edit', $track->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i></a>
                                            <form id="delete-form-{{ $track->id }}" action="{{ route('tracking.delete', $track->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $track->id }}"><i class="bi bi-trash2"></i></button>
                                            </form>
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
                    {{ $tracking->links() }}
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
            document.getElementById("searchInputTracking").addEventListener("input", function () {
                var searchText = this.value.toLowerCase();
                var tables = document.querySelectorAll('table');

                tables.forEach(function (table) {
                    var rows = table.querySelectorAll("tbody tr");

                    rows.forEach(function (row) {
                        var textContent = row.textContent.toLowerCase();
                        if (textContent.includes(searchText)) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let trackId = button.getAttribute('data-id'); // Obtener el ID desde el atributo data-id
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
                            document.getElementById('delete-form-' + trackId).submit(); // Envía el formulario correspondiente
                        }
                    });
                });
            });
        });
    </script>
@endsection
