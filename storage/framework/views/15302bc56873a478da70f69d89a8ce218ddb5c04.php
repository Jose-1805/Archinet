<table style="/*width: 20px;*/">
    <thead>
        <tr>
            <th colspan="2">
                <img height="100" src="<?php echo e(public_path('imagenes/logos/logo_sena.png')); ?>" />
            </th>
            <th colspan="2"></th>
            <th colspan="2">
                <img height="100" src="<?php echo e(public_path('imagenes/logos/logoarchinet.png')); ?>" />
            </th>
        </tr>
        <tr>
            <th colspan="6" height="25" style="text-align: center;">
                HISTORIAL DE EVENTOS
            </th>
        </tr>
        <tr style="background-color: #ff0000;">
            <th height="25" width="40" style="border: 1px solid #000;color: #FFFFFF;">Usuario</th>
            <th height="25" width="25" style="border: 1px solid #000;color: #FFFFFF;">Fecha</th>
            <th height="25" width="40" style="border: 1px solid #000;color: #FFFFFF;">Modulo</th>
            <th height="25" width="20" style="border: 1px solid #000;color: #FFFFFF;">Evento</th>
            <th height="25" width="30" style="border: 1px solid #000;color: #FFFFFF;">Datos anteriores</th>
            <th height="25" width="40" style="border: 1px solid #000;color: #FFFFFF;">Datos nuevos</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="border: 1px solid #000;"><?php echo $item->user->fullName().' ('.$item->rol->nombre.')'; ?></td>
                <td style="border: 1px solid #000;"><?php echo $item->created_at; ?></td>
                <td style="border: 1px solid #000;"><?php echo $item->modulo.($item->registro_afectado?' - '.$item->registro_afectado:''); ?></td>
                <td style="border: 1px solid #000;"><?php echo $item->tipo; ?></td>
                <td style="border: 1px solid #000;"><?php echo $item->printDiferencias(false); ?></td>
                <td style="border: 1px solid #000;"><?php echo $item->printDiferencias(); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>