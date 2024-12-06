<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Sistema - Paginas</title>
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
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3>Paginas
                                        <a style="margin: 2px" data-toggle="modal" data-target="#registrar" onclick="registrar_paginas()" 
                                           class="btn btn-success btn-xs pull-right" rel='tooltip' title="Añadir">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </a>    
                                    </h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $paginas = consultas::get_datos("select * from v_ref_paginas ORDER by pag_cod DESC");
                                            if (!empty($paginas)) {
                                                ?>                         
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Modulo</th>
                                                                <th class="text-center">Direccion</th>   
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="buscar">
                                                            <?php foreach ($paginas as $pag) { ?> 
                                                                <tr>
                                                                    <td class="text-center"><?= $pag['pag_cod']; ?></td>
                                                                    <td class="text-center"><?= $pag['pag_nombre']; ?></td>
                                                                    <td class="text-center"><?= $pag['mod_nombre']; ?></td>
                                                                    <td class="text-center"><?= $pag['pag_direc']; ?></td>
                                                                    <td class="text-center">
                                                                        <a onclick="editar_paginas(<?= "'" . $pag['pag_cod']. "'"; ?>)" 
                                                                           class="btn btn-xs btn-warning" rel="tooltip" title="Editar Pagina" 
                                                                           data-toggle="modal" data-target="#editar">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a onclick="borrar(<?= "'" . $pag['pag_cod'] . "_" . $pag['mod_cod'] . "_" . $pag['pag_nombre'] . "'"; ?>)" 
                                                                           class="btn btn-xs btn-danger" rel="tooltip" title="Borrar Pagina" 
                                                                           data-toggle="modal" data-target="#delete">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>                         
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <strong>No se encontraron registros....!</strong>
                                                </div>
                                            <?php } ?>  
                                        </div>
                                    </div>
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
                    <!--editar-->
                    <div id="editar" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content" id="detalles_editar">

                            </div>
                        </div>
                    </div> 
                    <!--editar-->
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
        <script>
            $(function () {
                $('#example1').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'autoWidth': true
                })
            })
        </script>
        <script src="../../funciones/funciones.js"></script>
        <script src="funciones.js"></script>
    </body>
</html>