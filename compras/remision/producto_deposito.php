<?php
require '../../conexion.php';
if (!empty($_POST['iddeposito'])) {
    $iddeposito = $_POST['iddeposito'];
    $suc_destino = $_POST['suc_destino'];
    ?>
    <div class="form-group">
        <label >Producto</label>
        <?php $stock = consultas::get_datos("SELECT * from v_stock WHERE id_deposito=" . $iddeposito); ?>
        <select class="form-control select2" name="vid_producto" required="" id="idproducto">
            <?php if (!empty($stock)) { ?>
                <?php
                foreach ($stock AS $pro) {
                    ?>
                    <option value="<?php echo $pro['id_producto']; ?>"><?php echo $pro['pro_descri']; ?></option>
                    <?php
                }
            } else {
                ?>
                <option value="">Debe insertar registros...</option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label >Cantidad</label>
        <input class="form-control" type="number" min="1" name="vcantidad" value="1">
    </div>
    <div class="form-group">
        <label>Deposito Entrante</label>
        <?php $depo = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=$suc_destino") ?>
        <select class="form-control select2" name="vid_deposito_entrada" required="">
            <?php if (!empty($depo)) { ?>
                <option value = "">Seleccione Deposito</option>
                <?php foreach ($depo AS $dep) {
                    ?>
                    <option value="<?php echo $dep['id_deposito']; ?>"><?php echo $dep['dep_descri']; ?></option>
                    <?php
                }
            } else {
                ?>
                <option value="">Debe insertar registros...</option>
            <?php } ?>
        </select>
    </div>


    <script type="text/javascript">
        $(".select2").select2();
    </script>

<?php } ?>


