<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Envío</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-7 col-xl-5">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Estado del Envío</h3>
                        <div class="info">
                            <p><strong>Número de seguimiento:</strong> {{ $trackingDetail->number_tracking }}</p>
                            <p><strong>Estado:</strong> {{ $trackingDetail->getStatusAttribute() }}</p>
                            <p><strong>Nombres del destinatario:</strong> {{ $trackingDetail->name }}</p>
                            <p><strong>Apellidos del destinatario:</strong> {{ $trackingDetail->lastname }}</p>
                            <p><strong>Teléfono del destinatario:</strong> {{ $trackingDetail->number_phone }}</p>
                            <p><strong>Dirección de destino:</strong> {{ $trackingDetail->address }}</p>
                            <p><strong>Fecha de envio:</strong> {{ $trackingDetail->created_at }}</p>
                            <p><strong>Caracteristicas del envio:</strong> {{ $trackingDetail->shipping_characteristics }}</p>
                        </div>
                        <div class="pt-1 mb-4">
                            <button class="btn btn-primary btn-lg btn-block" onclick="window.print();">Imprimir estado</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
