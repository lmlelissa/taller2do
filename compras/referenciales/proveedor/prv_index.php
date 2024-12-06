<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Proveedores </title>
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
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Proveedores</h3>
                                    <div class="box-tools">
                                        <a href="prv_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="/sysmeli/compras/referenciales/index.php" class="btn btn-danger pull-right btn-sm" style="margin:1px;">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $Proveedores = consultas::get_datos("SELECT * FROM v_ref_proveedores ORDER BY id_proveedor");
                                            if (!empty($Proveedores)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Ruc</th>
                                                                <th class="text-center">Direccion</th>
                                                                <th class="text-center">Telefono</th>
                                                                <th class="text-center">Correo</th>
                                                                <th class="text-center">Ciudad</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($Proveedores AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_proveedor']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_razonsocial']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_ruc']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_direccion']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_telefono']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_correo']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['ciu_nombre']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($p['prv_estado'] == 'ACTIVO') { ?>
                                                                            <a href="prv_edit.php?vid=<?php echo $p['id_proveedor']; ?>" 
                                                                               class="btn btn-warning btn-sm" role="button"
                                                                               data-title="Editar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-edit"></span>
                                                                            </a>
                                                                            <a href="prv_desactivar.php?vid=<?php echo $p['id_proveedor']; ?>" 
                                                                               class="btn btn-danger btn-sm" role="button"
                                                                               data-title="Desactivar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <a href="prv_reactivar.php?vid=<?php echo $p['id_proveedor']; ?>" 
                                                                               class="btn btn-success btn-sm" role="button"
                                                                               data-title="Reactivar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-ok"></span>
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