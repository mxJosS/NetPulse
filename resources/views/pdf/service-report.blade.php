<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Servicio #{{ $workOrder->id }}</title>
    <style>
        /* Base styles */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* Branding colors */
        .color-primary { color: #4f46e5; }
        .color-secondary { color: #0f172a; }
        .bg-muted { background-color: #f8fafc; }

        /* Header Container */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .logo-text {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #0f172a;
        }
        .logo-accent {
            color: #4f46e5;
        }
        .header-subtitle {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            margin-top: 2px;
        }
        .doc-badge {
            background-color: #f1f5f9;
            color: #334155;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #e2e8f0;
        }

        /* Hero / Title Grid */
        .hero-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .report-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }
        .report-meta {
            font-size: 10px;
            color: #64748b;
            margin-top: 5px;
        }
        .status-badge {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            display: inline-block;
        }

        /* Two columns grid using tables */
        .grid-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .grid-col {
            width: 48%;
            vertical-align: top;
        }
        .grid-space {
            width: 4%;
        }

        /* Cards styling */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #ffffff;
            margin-bottom: 15px;
            overflow: hidden;
        }
        .card-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
        }
        .card-body {
            padding: 12px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table th {
            text-align: left;
            font-weight: 600;
            color: #64748b;
            font-size: 10px;
            padding: 4px 0;
            width: 35%;
            vertical-align: top;
        }
        .info-table td {
            font-size: 10px;
            color: #0f172a;
            padding: 4px 0;
            vertical-align: top;
        }

        /* Description block */
        .description-callout {
            border-left: 3px solid #4f46e5;
            background-color: #f5f3ff;
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 30px;
        }
        .description-title {
            font-weight: bold;
            color: #4338ca;
            margin-bottom: 6px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .description-text {
            font-size: 11px;
            color: #312e81;
            margin: 0;
            line-height: 1.6;
        }

        /* Signatures section */
        .signature-table {
            width: 100%;
            margin-top: 50px;
            margin-bottom: 30px;
        }
        .signature-col {
            width: 45%;
            text-align: center;
            vertical-align: bottom;
        }
        .signature-line {
            border-bottom: 1px solid #cbd5e1;
            width: 80%;
            margin: 0 auto 8px auto;
        }
        .signature-name {
            font-weight: bold;
            color: #0f172a;
            font-size: 10px;
        }
        .signature-role {
            color: #64748b;
            font-size: 9px;
            margin-top: 2px;
        }

        /* Footer styling */
        .footer {
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
            margin-top: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <!-- Header Table -->
    <table class="header-table" cellpadding="0" cellspacing="0">
        <tr>
            <td align="left" style="vertical-align: middle;">
                <span class="logo-text">Net<span class="logo-accent">Pulse</span></span>
                <div class="header-subtitle">NOC SYSTEMS LITE</div>
            </td>
            <td align="right" style="vertical-align: middle;">
                <span class="doc-badge">DOCUMENTO DE SERVICIO DIGITAL</span>
            </td>
        </tr>
    </table>

    <!-- Hero / Title -->
    <table class="hero-table" cellpadding="0" cellspacing="0">
        <tr>
            <td align="left" style="vertical-align: middle;">
                <h1 class="report-title">BITÁCORA DE INTERVENCIÓN TÉCNICA</h1>
                <div class="report-meta">
                    <strong>Fecha Emisión:</strong> {{ now()->format('d/m/Y H:i') }} | 
                    <strong>Orden Asignada:</strong> #{{ $workOrder->id }}
                </div>
            </td>
            <td align="right" style="vertical-align: middle; width: 120px;">
                <div class="status-badge">Completado</div>
            </td>
        </tr>
    </table>

    <!-- Info Sections Grid -->
    <table class="grid-table" cellpadding="0" cellspacing="0">
        <tr>
            <!-- Column 1: Client Info & Order details -->
            <td class="grid-col">
                <div class="card">
                    <div class="card-header">Detalles de la Intervención</div>
                    <div class="card-body">
                        <table class="info-table">
                            <tr>
                                <th>Folio Orden</th>
                                <td>#{{ $workOrder->id }}</td>
                            </tr>
                            <tr>
                                <th>Fecha Cierre</th>
                                <td>{{ now()->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Técnico Asignado</th>
                                <td>{{ $workOrder->engineer->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Asunto</th>
                                <td>{{ $workOrder->title }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Datos del Cliente</div>
                    <div class="card-body">
                        <table class="info-table">
                            <tr>
                                <th>Cliente</th>
                                <td>{{ $workOrder->client->name }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $workOrder->client->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $workOrder->client->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $workOrder->client->email }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>

            <!-- Column Gap -->
            <td class="grid-space"></td>

            <!-- Column 2: Device details -->
            <td class="grid-col">
                <div class="card">
                    <div class="card-header">Especificación del Hardware</div>
                    <div class="card-body">
                        <table class="info-table">
                            <tr>
                                <th>Marca del Equipo</th>
                                <td>{{ $workOrder->device->brand }}</td>
                            </tr>
                            <tr>
                                <th>Modelo</th>
                                <td>{{ $workOrder->device->model }}</td>
                            </tr>
                            <tr>
                                <th>Número de Serie</th>
                                <td style="font-family: monospace; font-size: 11px; font-weight: bold; color: #1e1b4b;">
                                    {{ $workOrder->device->serial_number }}
                                </td>
                            </tr>
                            <tr>
                                <th>Dirección IP</th>
                                <td style="font-family: monospace;">{{ $workOrder->device->ip_address ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card" style="border: 1px dashed #cbd5e1; background-color: #f8fafc;">
                    <div class="card-header" style="background-color: #f1f5f9; border-bottom: 1px dashed #cbd5e1;">Información del SLA</div>
                    <div class="card-body" style="padding: 10px;">
                        <p style="margin: 0; font-size: 9px; color: #475569; line-height: 1.4;">
                            Este reporte representa una entrega conforme del servicio de diagnóstico. Las intervenciones sobre este hardware computan dentro del Uptime mensual contratado para la cuenta del cliente.
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Description Block -->
    <div class="description-callout">
        <div class="description-title">Diagnóstico y Resolución Técnica</div>
        <p class="description-text">{{ $workOrder->description }}</p>
    </div>

    <!-- Signatures -->
    <table class="signature-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="signature-col">
                <div class="signature-line"></div>
                <div class="signature-name">{{ $workOrder->engineer->name ?? 'Técnico NOC' }}</div>
                <div class="signature-role">Firma de Técnico Autorizado</div>
            </td>
            <td style="width: 10%;"></td>
            <td class="signature-col">
                <div class="signature-line"></div>
                <div class="signature-name">{{ $workOrder->client->name }}</div>
                <div class="signature-role">Firma de Conformidad del Cliente</div>
            </td>
        </tr>
    </table>

    <!-- Page Footer -->
    <div class="footer">
        NetPulse NOC Systems © {{ date('Y') }} - Reporte Certificado Electrónicamente - Conexión Segura SSL/TLS
    </div>

</body>
</html>
