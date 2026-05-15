<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Servicio</title>
</head>
<body>
    <h2>Hola, {{ $workOrder->client->name }}</h2>
    <p>Adjunto a este correo encontrará la bitácora del servicio realizado recientemente.</p>
    
    <h3>Detalles del Servicio:</h3>
    <ul>
        <li><strong>Orden #:</strong> {{ $workOrder->id }}</li>
        <li><strong>Equipo:</strong> {{ $workOrder->device->brand }} {{ $workOrder->device->model }} (SN: {{ $workOrder->device->serial_number }})</li>
        <li><strong>Título:</strong> {{ $workOrder->title }}</li>
        <li><strong>Descripción:</strong> {{ $workOrder->description }}</li>
        <li><strong>Estado Final:</strong> Completado</li>
    </ul>

    <p>Gracias por confiar en NOC Lite.</p>
</body>
</html>
