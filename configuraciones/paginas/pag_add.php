<title>Sistema</title>
<?php
include '../../conexion.php';
require '../../tools/css.php';
?>
<div class="modal-header">
    <button type= "button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"  style="padding-left: 10em;"><strong>Registrar Paginas</strong></h4>
</div>
<div class="panel-body">
    <form action="controller.php" method="post" accept-charset="utf-8" class="form-horizontal">
        <div class = "panel-body se">
            <input type = "hidden" name = "accion" value="1">
            <input type = "hidden" name = "vpag" value="0">
            <input type = "hidden" name = "pagina" value="pag_index.php">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <label class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-12">Nombre</label>
                    <input type="text" required="" placeholder="Nombre pagina" class="form-control" name="vnombre">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <label class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-12">Direccion</label>
                    <input type="text" required="" placeholder="Direccion de la pagina" class="form-control" name="vdireccion" value="/sysmeli/">
                </div>   
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <?php $modulos = consultas::get_datos("SELECT * FROM ref_modulos ORDER BY mod_cod ASC"); ?>                                 
                    <label class="control-label col-xs-12 col-sm-12 col-md-12 col-lg-12">Modulo</label>
                    <select  name="vmodulo" class="form-control select2" required="" style="width: 180px;">
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
        </div>  
        <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 15em;">
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Registrar</button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(".select2").select2();
</script>

