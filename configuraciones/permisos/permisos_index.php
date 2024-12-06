<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Permisos</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                            <div id="div_mensaje">

                            </div>
                            <h3 class="page-header">Permisos
                                <a style="margin: 2px" data-toggle="modal" data-target="#registrar" 
                                   onclick="registrar_permisos()" 
                                   class="btn btn-xs btn-success btn-circle pull-right" 
                                   rel='tooltip' title="Añadir">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a> 
                            </h3>
                        </div>     
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <?php $paginas = consultas::get_datos("SELECT * FROM v_ref_permisos"); ?>
                                <?php if (!empty($paginas)) { ?>                     
                                    <div class="panel-body">
                                        <?php foreach ($paginas as $pagina) { ?>                        
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="list-group-item-heading" style="width: 87%;">
                                                        <div class="col-lg-2"> <i><?= $pagina['perf_nombre']; ?></i></div>
                                                        <div class="col-lg-2"> <i><strong><?= $pagina['pag_nombre']; ?></strong></i></div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Consultar:</strong> 
                                                                    <?php
                                                                    if ($pagina['leer'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Insertar:</strong> 
                                                                    <?php
                                                                    if ($pagina['insertar'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Actualizar:</strong> <?php
                                                                    if ($pagina['editar'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <small>
                                                                <i><strong>Borrar:</strong> <?php
                                                                    if ($pagina['borrar'] == 't') {
                                                                        echo ("SI");
                                                                    } else {
                                                                        echo ("NO");
                                                                    }
                                                                    ?></i>
                                                            </small>
                                                        </div>                                      
                                                    </div>
                                                    <div class="media-right media-middle" 
                                                         style="padding-left: 58px;">
                                                        <div class="pull-right action-buttons">
                                                            <a onclick="editpag(<?= "'" . $pagina['id_perfil'] . "_" . $pagina['pag_cod'] . "_" . $pagina['perf_nombre'] . "_" . $pagina['pag_nombre'] . "'"; ?>)"
                                                               class="btn btn-xs btn-warning" role="button" data-title="Editar"
                                                               data-placement="top" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                            <a onclick="borrar(<?= "'" . $pagina['id_perfil'] . "_" . $pagina['pag_cod'] . "_" . $pagina['perf_nombre'] . "_" . $pagina['pag_nombre'] . "'"; ?>)"
                                                               class="btn btn-xs btn-danger" role="button" data-title="Borrar"
                                                               data-placement="top" rel="tooltip" data-toggle="modal" data-target="#delete">
                                                                <span class="glyphicon  glyphicon-trash"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div>
                                        <?php } ?> 
                                    <?php } else { ?>
                                        <div class="alert alert-danger">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            No se han autorizado interfaces...
                                        </div>
                                    <?php } ?>                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--registrar-->
                    <div id="registrar" class="modal fade" role="dialog">
                        <div class="modal-dialog" >
                            <div class="modal-content" id="detalles_registrar">

                            </div>
                        </div>
                    </div>  
                    <!--registrar-->
                    <!--editar permisos--->
                    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" id="detalles_edit">

                            </div>
                        </div>
                    </div>
                    <!--editar permisos--->
                    <!--borrar-->
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning" id="confirmacion"></div>
                                </div>
                                <div class="modal-footer">
                                    <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!--borrar-->
                </div>
            </div> 
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script src="../../configuraciones/permisos/permisos_funciones.js"></script>
        <script src="../../funciones/funciones.js"></script>
    </body>
</html>