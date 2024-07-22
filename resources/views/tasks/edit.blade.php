@extends('layouts.vertical', ['title' => 'Tarea', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Editar', 'sub_title' => 'Tarea'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Edición de Tarea</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="title">Titulo</label>
                                        <input type="text" class="form-control" id="title" name="title"  value="{{ $task->title }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="description">Descripción</label>
                                        <input type="text" class="form-control" id="description" name="description"  value="{{ $task->description }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="expiration_date">Fecha de vencimiento</label>
                                        <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ \Carbon\Carbon::parse($task->expiration_date)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="assign_user">Usuario asignado</label>
                                        <select class="form-select mb-3" id="user_id" name="user_id" required>
                                            <option value="" disabled>Seleccione un usuario</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Volver</a>
                                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1 fs-16 lh-1"></i>Guardar cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
