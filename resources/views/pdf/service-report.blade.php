<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicio #{{ $workOrder->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0056b3; padding-bottom: 10px; margin-bottom: 20px; }
        .title { color: #0056b3; font-size: 24px; font-weight: bold; }
        .section-title { font-size: 18px; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;}
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { text-align: left; padding: 8px; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; width: 30%; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">NOC Lite</div>
        <div>Bitácora de Servicio Técnico</div>
    </div>

    <div class="section-title">Detalles de la Orden</div>
    <table>
        <tr><th>Orden No.</th><td>#{{ $workOrder->id }}</td></tr>
        <tr><th>Fecha de Cierre</th><td>{{ now()->format('d/m/Y H:i') }}</td></tr>
        <tr><th>Ingeniero Asignado</th><td>{{ $workOrder->engineer->name ?? 'N/A' }}</td></tr>
        <tr><th>Título</th><td>{{ $workOrder->title }}</td></tr>
    </table>

    <div class="section-title">Información del Cliente</div>
    <table>
        <tr><th>Cliente</th><td>{{ $workOrder->client->name }}</td></tr>
        <tr><th>Email</th><td>{{ $workOrder->client->email }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $workOrder->client->phone ?? 'N/A' }}</td></tr>
        <tr><th>Dirección</th><td>{{ $workOrder->client->address ?? 'N/A' }}</td></tr>
    </table>

    <div class="section-title">Información del Equipo</div>
    <table>
        <tr><th>Marca / Modelo</th><td>{{ $workOrder->device->brand }} {{ $workOrder->device->model }}</td></tr>
        <tr><th>Número de Serie</th><td>{{ $workOrder->device->serial_number }}</td></tr>
        <tr><th>Dirección IP</th><td>{{ $workOrder->device->ip_address ?? 'N/A' }}</td></tr>
    </table>

    <div class="section-title">Descripción del Trabajo Realizado</div>
    <p>{{ $workOrder->description }}</p>

    <div class="footer">
        Generado automáticamente por NOC Lite.
    </div>
</body>
</html>
