<?php
require '../../conexion.php';
if (!empty($_POST['idproducto'])) {
    $idproducto = $_POST['idproducto'];
    $productos = consultas::get_datos("SELECT * from v_ref_productos WHERE id_producto=" . $idproducto);
    ?>
    <div class="form-group">
        <label >Detalles</label>
        <input class="form-control" type="text" readonly="" value="<?=
               'TIPO: ' . $productos[0]['tip_descri'] .
               ' - MARCA: ' . $productos[0]['mar_descri'] . ' - SERIE: ' . $productos[0]['serie_descri'];
               ?>">
    </div>
<?php } ?>

