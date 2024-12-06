<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Clientes</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div id="div_mensaje"></div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Clientes</h3>
                                    <div class="box-tools">
                                        <a href="add.php" class="btn btn-success pull-right btn-sm" style="margin:1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="/sysmeli/ventas/referenciales/index.php" class="btn btn-danger pull-right btn-sm" style="margin:1px;">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consul = consultas::get_datos("SELECT * FROM v_ref_clientes ORDER BY id_cliente");
                                            if (!empty($consul)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Ci</th>
                                                                <th class="text-center">Ruc</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consul AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_cliente']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['cliente']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_ci']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['per_ruc']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($p['estado'] == 'ACTIVO') { ?>
                                                                            <a href="edit.php?vid=<?php echo $p['id_cliente']; ?>" 
                                                                               class="btn btn-warning btn-sm" role="button"
                                                                               data-title="Editar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-edit"></span>
                                                                            </a>
                                                                            <a href="desactivar.php?vid=<?php echo $p['id_cliente']; ?>" 
                                                                               class="btn btn-danger btn-sm" role="button"
                                                                               data-title="Desactivar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                            </a>                                         
                                                                        <?php } ?>
                                                                        <?php if ($p['estado'] == 'INACTIVO') { ?>
                                                                            <a href="activar.php?vid=<?php echo $p['id_cliente']; ?>" 
                                                                               class="btn btn-success btn-sm" role="button"
                                                                               data-title="Desactivar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-check"></span>
                                                                            </a>   
                                                                        <?php } ?>
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
        <script src="../../../funciones/funciones.js"></script>
    </BODY>
</HTML>
