<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Ejecutivo {{ $period }} - NOC Lite</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0056b3; padding-bottom: 10px; margin-bottom: 20px; }
        .title { color: #0056b3; font-size: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .summary { margin-bottom: 20px; font-size: 14px; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #777; }
        .status-pending { color: #856404; }
        .status-onsite { color: #004085; }
        .status-completed { color: #155724; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">NOC Lite - Reporte Ejecutivo {{ $period }}</div>
        <div>Generado el: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="summary">
        Resumen de incidencias registradas en el periodo solicitado.
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Equipo</th>
                <th>Ingeniero</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workOrders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->device->brand }} {{ $order->device->model }}</td>
                    <td>{{ $order->engineer->name ?? 'N/A' }}</td>
                    <td class="status-{{ str_replace('_', '', $order->status) }}">
                        {{ $order->formattedStatus() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Este documento es un reporte confidencial generado por el sistema NOC Lite Network Manager.
    </div>
</body>
</html>
