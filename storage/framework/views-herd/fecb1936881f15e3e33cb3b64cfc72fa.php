<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Semanal - <?php echo e($patient->name); ?></title>
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
        <p><?php echo e($patient->name); ?></p>
    </div>

    <div class="period">Periodo: <?php echo e($stats['period']); ?></div>

    <table class="stats-grid">
        <tr>
            <td>
                <div class="stat-label">Tomas a tiempo</div>
                <div class="stat-value"><?php echo e($stats['taken_percentage']); ?>%</div>
                <div style="font-size: 11px; color: #94a3b8;"><?php echo e($stats['taken']); ?> de <?php echo e($stats['total']); ?> tomas</div>
            </td>
            <td>
                <div class="stat-label">Omisiones</div>
                <div class="stat-value red"><?php echo e($stats['missed_percentage']); ?>%</div>
                <div style="font-size: 11px; color: #94a3b8;"><?php echo e($stats['missed']); ?> tomas</div>
            </td>
            <td>
                <div class="stat-label">Retrasos</div>
                <div class="stat-value" style="color: #64748b;"><?php echo e($stats['delayed_percentage']); ?>%</div>
                <div style="font-size: 11px; color: #94a3b8;"><?php echo e($stats['delayed']); ?> tomas</div>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats['reasons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($reason); ?></td>
                    <td width="200">
                        <div style="margin-bottom: 5px;"><?php echo e($stats['reasons_percentages'][$reason]); ?>%</div>
                        <div class="progress-bg">
                            <div class="progress-bar" style="width: <?php echo e($stats['reasons_percentages'][$reason]); ?>%"></div>
                        </div>
                    </td>
                    <td><?php echo e($count); ?></td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/pdf/weekly-report.blade.php ENDPATH**/ ?>