<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Semanal - {{ $patient->name }}</title>
    <style>
        body { font-family: sans-serif; color: #334155; }
        .header { text-align: center; margin-bottom: 30px; }
        .period { font-weight: bold; margin-bottom: 20px; }
        .stats-grid { width: 100%; margin-bottom: 30px; border-collapse: collapse; }
        .stats-grid td { width: 33.33%; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px; }
        .stat-label { font-size: 12px; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px; }
        .stat-value { font-size: 24px; font-weight: bold; color: #0b67c2; }
        .stat-value.red { color: #ef4444; }
        .reasons-table { width: 100%; border-collapse: collapse; }
        .reasons-table th, .reasons-table td { text-align: left; padding: 10px; border-bottom: 1px solid #f1f5f9; }
        .progress-bg { background: #f1f5f9; height: 10px; border-radius: 5px; width: 100%; }
        .progress-bar { background: #ef4444; height: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte Semanal de Medicación</h1>
        <p>{{ $patient->name }}</p>
    </div>

    <div class="period">Periodo: {{ $stats['period'] }}</div>

    <table class="stats-grid">
        <tr>
            <td>
                <div class="stat-label">Tomas a tiempo</div>
                <div class="stat-value">{{ $stats['taken_percentage'] }}%</div>
                <div style="font-size: 11px; color: #94a3b8;">{{ $stats['taken'] }} de {{ $stats['total'] }} tomas</div>
            </td>
            <td>
                <div class="stat-label">Omisiones</div>
                <div class="stat-value red">{{ $stats['missed_percentage'] }}%</div>
                <div style="font-size: 11px; color: #94a3b8;">{{ $stats['missed'] }} tomas</div>
            </td>
            <td>
                <div class="stat-label">Retrasos</div>
                <div class="stat-value" style="color: #64748b;">{{ $stats['delayed_percentage'] }}%</div>
                <div style="font-size: 11px; color: #94a3b8;">{{ $stats['delayed'] }} tomas</div>
            </td>
        </tr>
    </table>

    <h3>Razones de Omisión</h3>
    <table class="reasons-table">
        <thead>
            <tr>
                <th>Razón</th>
                <th>Porcentaje</th>
                <th>Tomas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stats['reasons'] as $reason => $count)
                <tr>
                    <td>{{ $reason }}</td>
                    <td width="200">
                        <div style="margin-bottom: 5px;">{{ $stats['reasons_percentages'][$reason] }}%</div>
                        <div class="progress-bg">
                            <div class="progress-bar" style="width: {{ $stats['reasons_percentages'][$reason] }}%"></div>
                        </div>
                    </td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
