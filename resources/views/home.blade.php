@extends('layouts.vertical', ['title' => 'Rastreo', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Crear', 'sub_title' => 'Rastreo'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Registrar rastreo</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="topic">Area</label>
                                        <select class="form-select mb-3" id="topic" name="topic" required>
                                            <option value="0" selected="">Abra el menú y seleccióne una opción</option>
                                            {{--@foreach($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="subTopic">Tema</label>
                                        <select class="form-select" aria-label="tema" id="subTopic" name="subTopic" required>
                                            <option value="" selected>Selecione una opcion....</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="question">Pregunta</label>
                                        <input type="text" class="form-control" id="question" name="question" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="answer">Respuesta</label>
                                        <textarea class="form-control" id="answer" name="answer" rows="12" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#" class="btn btn-secondary">Volver</a>
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

@section('script')
    @vite(['resources/js/pages/form-advanced.init.js'])
@endsection
