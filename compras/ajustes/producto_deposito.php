<?php
require '../../conexion.php';
if (!empty($_POST['iddeposito'])) {
    $iddeposito = $_POST['iddeposito'];
    ?>
    <input type="hidden" id="iddeposito" value="<?php echo $iddeposito ?>"/>
    <div class="form-group">
        <label >Producto</label>
        <?php $stock = consultas::get_datos("SELECT * from v_stock WHERE id_deposito=" . $iddeposito); ?>
        <select class="form-control select2" name="vid_producto" required="" id="idproducto" onchange="cant_stock();">
            <?php if (!empty($stock)) { ?>
                <option value="">Seleccione un producto...</option>
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
    <div id="cantidad_stock">

    </div>
<?php } ?>

<script type="text/javascript">
    $(".select2").select2();

    function cant_stock() {
        var iddeposito = $("#iddeposito").val();
        var idproducto = $("#idproducto").val();
        $.ajax({
            type: "POST", url: "cantidad_stock.php", data: {iddeposito: iddeposito, idproducto: idproducto}
        }).done(function (datos) {
            $("#cantidad_stock").html(datos);
        });
    }
</script>



