<?php
require '../../conexion.php';
$prv_cod = $_POST['prv_cod'];
if (!empty($prv_cod)) {
    ?>
    <label>Factura</label>
    <?php $compras = consultas::get_datos("SELECT * from v_compras WHERE com_estado='TERMINADO' AND id_proveedor = $prv_cod"); ?>  
    <select name="vid_compra" class="form-control select2" required="">
        <?php if (!empty($compras)) { ?>
            <option value="">Seleccione factura</option>
            <?php
            foreach ($compras as $compra) {
                ?>
                <option value="<?php echo $compra['id_compra']; ?>">
                    <?php echo 'Compra ' . $compra['id_compra'] . '- Nº Factura ' . $compra['com_nro_factura']; ?>
                </option>
                <?php
            }
        } else {
            ?>
            <option value="">No hay registros</option>
        <?php } ?>
    </select>
    <input type="hidden" name="vnc_comprobante" value="<?php echo $compras[0]['com_nro_factura']; ?>"/>


    <script type="text/javascript">
        $(".select2").select2();
    </script>
<?php } ?>
