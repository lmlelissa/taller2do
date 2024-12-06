<?php
require '../../../conexion.php';
if (!empty($_POST['idpersona'])) {
    $idpersona = $_POST['idpersona'];
    $detalles = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona=$idpersona");
    ?>
    <div class="form-group">
        <label class="control-label"><i class="fa fa-user"></i> Nombre y Apellido</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="vper_nombres" value="<?php echo $detalles[0]['per_nombre'] . ' ' . $detalles[0]['per_apellido'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><i class="fa fa-qrcode"></i> Cedula de Identidad</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="vper_ci" value="<?php echo $detalles[0]['per_ci'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><i class="fa fa-phone"></i> Telefono</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="vper_telefono" value="<?php echo $detalles[0]['per_telefono'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label"><i class="fa fa-facebook"></i> Correo</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input class="form-control" type="text" name="vper_correo" value="<?php echo $detalles[0]['per_email'] ?>">
        </div>
    </div>
    <br>
<?php } ?>

<script type="text/javascript">
    $(".select2").select2();
</script>



