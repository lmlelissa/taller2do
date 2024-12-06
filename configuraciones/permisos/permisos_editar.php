<?php
require '../../conexion.php';
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4 class="modal-title custom_align" id="Heading"><strong><i>Editar permisos</i></strong></h4>
</div>
<div class="panel-body">
    <form action="permisos_control.php" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
        <div class="panel-body se">
            <input type="hidden" name="accion" value="2">
            <input type="hidden" name="vgru" value="<?php echo $_REQUEST['vgru'] ?>"/>
            <input type="hidden" name="vpag" value="<?php echo $_REQUEST['vpag'] ?>"/>
            <input type="hidden" name="vgrunombre" value="<?php echo $_REQUEST['vgrunombre'] ?>">
            <input type="hidden" name="pagina" value="permisos_index.php">

            <div class="form-group">
                <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1">Perfil</label>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <input type="text" class="form-control" name="grupo" placeholder="Interfaz" 
                           value="<?php echo $_REQUEST['vgrunombre'] ?>" disabled=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1">Pagina</label>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <input type="text" class="form-control" name="pagina" placeholder="Interfaz" 
                           value="<?php echo $_REQUEST['vpagina'] ?>" disabled=""/>
                </div>
            </div>
            <div class="form-group">
                <?php $paginas = consultas::get_datos("select * from v_ref_permisos where pag_cod=" . $_REQUEST['vpag'] . " and id_perfil= " . $_REQUEST['vpag']) ?>
                <label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2">Permisos</label>                               
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
            <div class="text-right" 
                 style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;
                 margin-right: -1.1em;margin-top: 1.5em;;padding-top:
                 1em;padding-right: 1em;">
                <button type="submit" class="btn btn-success">
                    <span class="fa fa-refresh"></span> Actualizar</button>
                <button type="button" data-dismiss="modal" class="btn btn-danger">
                    <span class="fa fa-close"></span> Salir
                </button>
            </div>
        </div>
    </form>
</div>