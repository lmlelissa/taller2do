<?php
session_start();
require '../../conexion.php';
?>
<div class="modal-header">
    <button type="button" class="close" 
            data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"><strong>Registrar Apertura</strong></h4>
</div>
<form action="apertura_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
    <div class="panel-body se">
        <input type="hidden" name="accion"  value="1">
        <input type="hidden" name="vcod" value="0"/> 
        <div class="row">
            <div class="col-md-6" style="left: 100px">
                <label class="control-label">Monto Inicial:</label>
                <input type="number" required="" placeholder="Ingrese monto" min="10000" class="form-control" 
                       value="0" name="apemonto" autofocus="" style="width: 50%">
            </div>
            <div class="col-md-6">
                <label class="control-label">Caja:</label>
                <?php $cajas = consultas::get_datos("select * from ref_cajas where id_sucursal=" . $_SESSION['id_sucursal'] . " and caj_estado='CERRADA'"); ?> 
                <br>
                <select name="vcaja" class="form-control select2" style="width: 200px" required="">
                    <?php
                    if (!empty($cajas)) {
                        foreach ($cajas as $caja) {
                            ?>
                            <option value="<?php echo $caja['id_caja']; ?>"><?php echo $caja['caj_descri']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">No hay cajas cerradas</option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-center"><i class="fa fa-floppy-o"></i> Registrar</button>
    </div>
</form>