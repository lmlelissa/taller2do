<?php
require '../../conexion.php';
if (!empty($_POST['iddeposito'])) {
    $iddeposito = $_POST['iddeposito'];
    ?>
    <div class="form-group">
        <label>Producto</label>
        <?php $stock = consultas::get_datos("SELECT * from v_stock WHERE id_deposito=" . $iddeposito); ?>
        <select class="form-control select2" name="vidproducto" required="" id="idproducto">
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
        <input class="form-control" type="number" min="1" name="vcantidad" required="">
    </div>
    <div class="form-group">
        <label>Precio</label>
        <input class="form-control" type="number" min="1" name="vprecio" required="">
    </div>
<?php } ?>

<script type="text/javascript">
    $(".select2").select2();
</script>



