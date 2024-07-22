@extends('layouts.vertical', ['title' => 'Tarea', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Ver', 'sub_title' => 'Tarea'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Ver detalles de la Tarea</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" name="title" disabled="" value="{{ $task->title }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="description">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description" disabled="" value="{{ $task->description }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="expiration_date">Fecha de vencimiento</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date" disabled value="{{ \Carbon\Carbon::parse($task->expiration_date)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="user_id">Usuario asignado</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" disabled="" value="{{ $task->user->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection

