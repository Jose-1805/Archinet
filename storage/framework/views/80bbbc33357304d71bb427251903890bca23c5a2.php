<table style="/*width: 20px;*/">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Modulo</th>
            <th>Evento</th>
            <th>Datos anteriores</th>
            <th>Datos nuevos</th>
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