<?php
require '../../conexion.php';
if (!empty($_REQUEST['iddeposito'])) {
    $iddeposito = $_REQUEST['iddeposito'];
    $idproducto = $_REQUEST['idproducto'];
    $stocks = consultas::get_datos("select * from v_stock WHERE id_deposito=" . $iddeposito . " AND id_producto=" . $idproducto);
    ?>
    <?php if (!empty($stocks)) { ?>
        <div class="form-group">
            <label >Cantidad</label>
            <input class="form-control" type="number" min="1" name="vaj_cantidad" 
            value="<?php echo $stocks[0]['cantidad_actual'] ?>" max="<?php echo $stocks[0]['cantidad_actual'] ?>">
        </div>
        <div class="form-group">
            <label >Observacion</label>
                <input class="form-control" type="text" name="vaj_observacion" placeholder="Ingrese una observacion" required="">
            </div>
        </div>
    <?php } ?>
<?php } ?>
