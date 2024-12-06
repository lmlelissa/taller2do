<?php
require '../../conexion.php';
$idcliente = $_POST['idcliente'];
if ($idcliente != NULL) {
    ?>
    <label >Factura</label>
    <?php $ventas = consultas::get_datos("SELECT * from v_ventas_factura WHERE estado='CONFIRMADO' AND id_cliente = $idcliente"); ?>  
    <select name="vid_venta" class="form-control select2" required="">
        <?php if (!empty($ventas)) { ?>
            <option value="">SELECCIONE FACTURA</option>
            <?php
            foreach ($ventas as $venta) {
                ?>
                <option value="<?= $venta['id_venta']; ?>"><?= 'Nº ' . $venta['nro_factura'] .' - de fecha '. $venta['fecha1']; ?>
                </option>
                <?php
            }
        } else {
            ?>
            <option value="">NO EXISTEN FACTURAS CONFIRMADAS</option>
        <?php } ?>
    </select>
    
    <script type="text/javascript">
        $(".select2").select2();
    </script>
<?php } ?>
