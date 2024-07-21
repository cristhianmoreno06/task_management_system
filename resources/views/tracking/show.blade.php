@extends('layouts.vertical', ['title' => 'Rastreo', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', ['page_title' => 'Ver', 'sub_title' => 'Rastreo'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Ver Pregunta y Respuesta</h4>
                </div>
                <div class="card-body">
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
                                <input type="text" class="form-control" id="company" name="company" disabled="" value="{{ $tracking->company }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="identification_number">Número de Identificación del cliente</label>
                                <input type="text" class="form-control" id="identification_number" name="identification_number" disabled="" value="{{ $tracking->identification_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="name">Nombres del cliente</label>
                                <input type="text" class="form-control" id="name" name="name" disabled="" value="{{ $tracking->name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="lastname">Apellidos del cliente</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" disabled="" value="{{ $tracking->lastname }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="address">Dirección del cliente</label>
                                <input type="text" class="form-control" id="address" name="address" disabled="" value="{{ $tracking->address }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="number_phone">Teléfono del cliente</label>
                                <input type="text" class="form-control" id="number_phone" name="number_phone" disabled="" value="{{ $tracking->number_phone }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="shipping_characteristics">Características del envío</label>
                                <input type="text" class="form-control" id="shipping_characteristics" name="shipping_characteristics" disabled="" value="{{ $tracking->shipping_characteristics }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status">Estado del envío</label>
                                <input type="text" class="form-control" name="status" disabled="" value="{{ $tracking->getStatusAttribute() }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('tracking.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection

