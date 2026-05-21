<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicio NOC</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            width: 100% !important;
        }
        table {
            border-collapse: collapse;
        }
        .wrapper {
            background-color: #f3f4f6;
            padding: 40px 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            padding: 30px 40px;
            text-align: left;
        }
        .logo-text {
            color: #ffffff;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0;
        }
        .logo-accent {
            color: #818cf8;
        }
        .header-subtitle {
            color: #a5b4fc;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 4px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px;
        }
        .greeting {
            color: #0f172a;
            font-size: 20px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 12px;
        }
        .intro-text {
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 24px;
            padding: 20px;
        }
        .card-title {
            color: #334155;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin-top: 0;
            margin-bottom: 12px;
            text-transform: uppercase;
        }
        .detail-row {
            border-bottom: 1px solid #f1f5f9;
            padding: 8px 0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
            width: 30%;
            display: inline-block;
            vertical-align: top;
        }
        .detail-value {
            color: #0f172a;
            font-size: 12px;
            width: 68%;
            display: inline-block;
            vertical-align: top;
        }
        .status-badge {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 6px;
            display: inline-block;
            font-size: 11px;
            font-weight: bold;
            padding: 2px 8px;
            text-transform: uppercase;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 10px;
        }
        .btn {
            background-color: #4f46e5;
            border-radius: 8px;
            color: #ffffff !important;
            display: inline-block;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 30px;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }
        .attachment-note {
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
            margin-top: 30px;
            padding-top: 15px;
            text-align: center;
        }
        .footer {
            color: #94a3b8;
            font-size: 11px;
            padding-top: 20px;
            text-align: center;
        }
        .footer a {
            color: #4f46e5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" class="wrapper">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" class="container">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <h1 class="logo-text">Net<span class="logo-accent">Pulse</span></h1>
                            <div class="header-subtitle">Bitácora de Intervención Técnica</div>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td class="content">
                            <h2 class="greeting">¡Hola, {{ $workOrder->client->name }}!</h2>
                            <p class="intro-text">
                                Te informamos que el reporte técnico correspondiente al servicio de mantenimiento preventivo y correctivo de tu equipo ha sido generado con éxito. Adjunto a este correo electrónico encontrarás el documento oficial en formato **PDF** con todas las especificaciones y firmas digitales correspondientes.
                            </p>
                            
                            <!-- Detail Card -->
                            <div class="card">
                                <h3 class="card-title">Resumen de la Orden</h3>
                                
                                <div class="detail-row">
                                    <span class="detail-label">Orden #:</span>
                                    <span class="detail-value" style="font-weight: bold;">#{{ $workOrder->id }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Título:</span>
                                    <span class="detail-value">{{ $workOrder->title }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Hardware:</span>
                                    <span class="detail-value">{{ $workOrder->device->brand }} {{ $workOrder->device->model }} (S/N: {{ $workOrder->device->serial_number }})</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Técnico:</span>
                                    <span class="detail-value">{{ $workOrder->engineer->name ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Estado:</span>
                                    <span class="detail-value">
                                        <span class="status-badge">Completado</span>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="btn-container">
                                <a href="{{ url('/login') }}" class="btn">Ver en el Dashboard</a>
                            </div>
                            
                            <p class="attachment-note">
                                📎 El archivo adjunto contiene la firma del ingeniero a cargo y de aceptación. Por favor guárdalo para futuros diagnósticos técnicos de red.
                            </p>
                        </td>
                    </tr>
                </table>
                
                <!-- Footer -->
                <table width="100%" cellpadding="0" cellspacing="0" class="footer">
                    <tr>
                        <td align="center">
                            <p>© {{ date('Y') }} NetPulse NOC Systems. Todos los derechos reservados.</p>
                            <p>Has recibido este correo debido a una orden de servicio asignada a tu cuenta de cliente en NetPulse.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
