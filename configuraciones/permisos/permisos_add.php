<?php
require '../../conexion.php';
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
    <h4 class="modal-title"><strong>Registrar Permisos</strong></h4>
</div>

<div class="panel-body">
    <form action="permisos_control.php" method="post" accept-charset="utf-8" class = "form-horizontal">
        <div class="panel-body se">
            <input type="hidden" name="accion" value="1">
            <input type="hidden" name="pagina" value="permisos_index.php">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <label class="control-label">Perfil</label>
                <?php $perfiles = consultas::get_datos("SELECT * FROM ref_perfiles ORDER BY id_perfil"); ?>                                 
                <select name="vgru" class="form-control">
                    <?php
                    if (!empty($perfiles)) {
                        foreach ($perfiles as $perfil) {
                            ?>
                            <option value="<?= $perfil['id_perfil']; ?>"><?= $perfil['perf_nombre']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar registros</option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <label class="control-label">Paginas</label>
                <?php $paginas = consultas::get_datos("SELECT * FROM ref_paginas ORDER BY pag_cod DESC"); ?>                                 
                <select name="vpag" class="form-control">
                    <?php
                    if (!empty($paginas)) {
                        foreach ($paginas as $pag) {
                            ?>
                            <option value="<?php echo $pag['pag_cod']; ?>"><?php echo $pag['pag_nombre']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar registros</option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="left: 200px">
                <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1">Permisos</label>     
                <br>
                <div class="checkbox">
                    <label>
                        <input type="hidden" value="false" name="consul" id="PermisoConsul">
                        <input type="checkbox" value="true" name="consul" id="PermisoConsul">
                        Consultar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" value="false" name="agre" id="PermisoAgre">
                        <input type="checkbox" value="true" name="agre" id="PermisoAgre">
                        Insertar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" value="false" name="editar" id="PermisoConsul">
                        <input type="checkbox" value="true" name="editar" id="PermisoConsul">
                        Actualizar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" value="false" name="borrar" id="PermisoAgre">
                        <input type="checkbox" value="true" name="borrar" id="PermisoAgre">
                        Borrar
                    </label>
                </div>
            </div>    
        </div>  
        <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-floppy-o"></i> Registrar</button>
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cerrar</button>
        </div>
    </form>
</div>

