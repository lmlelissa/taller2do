<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Ciudad</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Ciudad</h3>
                                    <div class="box-tools">
                                        <a href="ciudad_add.php" class="btn btn-success btn-sm pull-right" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <?php
                                            $consul = consultas::get_datos("SELECT * FROM v_ciudad ORDER BY id_ciudad");
                                            if (!empty($consul)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Pais</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consul AS $con) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $con['id_ciudad']; ?></td>
                                                                    <td class="text-center"><?php echo $con['ciu_nombre']; ?></td>
                                                                    <td class="text-center"><?php echo $con['pais_nombre']; ?></td>
                                                                    <td class="text-center">
                                                                        <a href="ciudad_edit.php?vid=<?php echo $con['id_ciudad']; ?>" 
                                                                           class="btn btn-warning btn-sm" role="button"
                                                                           data-title="Editar" rel="tooltip" data-placement="top">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a href="ciudad_delete.php?vid=<?php echo $con['id_ciudad'] ?>" 
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
                                <div class="box-footer">
                                    <?php $paises = consultas::get_datos("SELECT count(id_pais) AS cantidad FROM ref_pais") ?>
                                    <a class="btn btn-app" href="/sysmeli/archivos/pais/pais_index.php"> 
                                        <span class="badge bg-blue-active"><?php echo $paises[0]['cantidad']; ?></span>
                                        <i class="fa fa-flag-o"></i> Paises
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script src="../../funciones/funciones.js"></script>
        <script>
//            $(function () {
//                $('#example1').DataTable({
//                    'paging': true,
//                    'lengthChange': false,
//                    'searching': true,
//                    'ordering': true,
//                    'info': false,
//                    'autoWidth': true
//                    })
//                $('#example2').DataTable();
//            })
        </script>
    </BODY>
</HTML>