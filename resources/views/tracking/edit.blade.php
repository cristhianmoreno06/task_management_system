@extends('layouts.vertical', ['title' => 'Rastreo', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Crear', 'sub_title' => 'Rastreo'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Creación de Rastreo</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('tracking.update', $tracking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="number_tracking">Número de rastreo</label>
                                        <input type="text" class="form-control" id="number_tracking" name="number_tracking" disabled="" value="{{ $tracking->number_tracking }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="company">Empresa</label>
                                        <input type="text" class="form-control" id="company" name="company" required value="{{ $tracking->company }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="identification_number">Número de Identificación del cliente</label>
                                        <input type="text" class="form-control" id="identification_number" name="identification_number" required value="{{ $tracking->identification_number }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name">Nombres del cliente</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="{{ $tracking->name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lastname">Apellidos del cliente</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required value="{{ $tracking->lastname }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address">Dirección del cliente</label>
                                        <input type="text" class="form-control" id="address" name="address" required value="{{ $tracking->address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="number_phone">Teléfono del cliente</label>
                                        <input type="text" class="form-control" id="number_phone" name="number_phone" required value="{{ $tracking->number_phone }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="shipping_characteristics">Características del envío</label>
                                        <input type="text" class="form-control" id="shipping_characteristics" name="shipping_characteristics" required value="{{ $tracking->shipping_characteristics }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status">Estado</label>
                                        <select class="form-select mb-3" name="status" required>
                                            <option value="" disabled {{ is_null($tracking->status) ? 'selected' : '' }}>Abra el menú y seleccione una opción</option>
                                            <option value="0" {{ $tracking->status == 0 ? 'selected' : '' }}>Enviado</option>
                                            <option value="1" {{ $tracking->status == 1 ? 'selected' : '' }}>En curso</option>
                                            <option value="2" {{ $tracking->status == 2 ? 'selected' : '' }}>Entregado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('tracking.index') }}" class="btn btn-secondary">Volver</a>
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
