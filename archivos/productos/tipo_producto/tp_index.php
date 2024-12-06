<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Tipo Producto</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div id="div_mensaje">
                                
                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Tipo Producto</h3>
                                    <div class="box-tools">
                                        <a href="tp_add.php" class="btn btn-success btn-sm pull-right" style="margin:1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="/sysmeli/archivos/productos/pro_index.php" class="btn btn-danger pull-right btn-sm" style="margin:1px;">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <?php
                                            $tipos = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipo");
                                            if (!empty($tipos)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($tipos AS $tp) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $tp['id_tipo']; ?></td>
                                                                    <td class="text-center"><?php echo $tp['tip_descri']; ?></td>
                                                                    <td class="text-center">
                                                                        <a href="tp_edit.php?vid=<?php echo $tp['id_tipo']; ?>" 
                                                                           class="btn btn-warning btn-sm" role="button"
                                                                           data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a href="tp_delete.php?vid=<?php echo $tp['id_tipo'] ?>" 
                                                                           class="btn btn-danger btn-sm" role="button"
                                                                           data-title="Borrar" rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-danger flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han encontrado registros...
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
        <script src="../../../funciones/funciones.js"></script>
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
                $('#example2').DataTable();
            })
        </script>
    </BODY>
</HTML>