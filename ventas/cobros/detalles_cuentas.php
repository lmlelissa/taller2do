<?php
require '../../conexion.php';
session_start();
$vid_cta = $_POST['vid_cta'];
if (!empty($vid_cta)) {
    $cuentas = consultas::get_datos("SELECT * FROM v_ventas_ctas_cobrar WHERE id_cta=".$vid_cta);
    ?>
    <div class="form-group">
        <label>Importe</label>
        <input type="hidden" value="<?= $cuentas[0]['cta_importe']; ?>" name="vmonto">
        <input class="form-control" type="text" value="<?=  number_format($cuentas[0]['cta_importe'], 0, '.', '.'); ?>" readonly="">
    </div>
    <div class="form-group">
        <label>Vencimiento</label>
        <input class="form-control" type="text" value="<?= $cuentas[0]['fecha1']; ?>" readonly="">
    </div>
<?php } ?>

