<title>Sistema - Editar Pagina</title>
<?php
session_start();
include '../../conexion.php';
require '../../tools/css.php';
?>
<div class="modal-header">
    <button type= "button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"  style="padding-left: 10em;"><strong>Editar Paginas</strong></h4>
</div>
<div class="panel-body">
    <form action="controller.php" method="POST" accept-charset="utf-8" class="form-horizontal">
        <div class="panel-body se">
            <?php $paginas = consultas::get_datos("SELECT * FROM v_ref_paginas WHERE pag_cod=" . $_REQUEST['vpag_cod']) ?>
            <input type="hidden" name="accion" value="3">
            <input type="hidden" name="vpag" value="<?= $paginas[0]['pag_cod'] ?>">
            <input type="hidden" name="pagina" value="pag_index.php">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label class="control-label">Nombre</label>
                <input type="text" required="" class="form-control" name="vnombre" value="<?= $paginas[0]['pag_nombre'] ?>">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label class="control-label">Direccion</label>
                <input type="text" required="" class="form-control" name="vdireccion" value="<?= $paginas[0]['pag_direc'] ?>">
            </div>   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php $modulos = consultas::get_datos("SELECT * FROM ref_modulos ORDER BY mod_cod=" . $paginas[0]['mod_cod'] . " DESC"); ?>                                 
                <label class="control-label">Modulo</label>
                <select  name="vmodulo" class="form-control select2" required="">
                    <?php
                    if (!empty($modulos)) {
                        foreach ($modulos as $modulo) {
                            ?>
                            <option value="<?php echo $modulo['mod_cod']; ?>"> <?php echo $modulo['mod_nombre']; ?> </option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">No existen registros</option>
                    <?php } ?>
                </select>
            </div>
        </div>  
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(".select2").select2();
</script>

