<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title> Productos</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-blue sidebar-mini">
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
                                    <h3 class="box-title">Productos</h3>
                                    <div class="box-tools">
                                        <a href="pro_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <?php
                                            $productos = consultas::get_datos("SELECT * FROM v_ref_productos ORDER BY id_producto");
                                            if (!empty($productos)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Codigo</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Tipo</th>
                                                                <th class="text-center">Marca</th>
                                                                <th class="text-center">Tamaño</th>
                                                                <th class="text-center">P.Compra</th>
                                                                <th class="text-center">P.Venta</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($productos AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_producto']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['pro_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['tip_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['mar_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['serie_descri']; ?></td>
                                                                    <td class="text-center"><?php echo number_format($p['precio_compra'], 0, ',', '.'); ?></td>
                                                                    <td class="text-center"><?php echo number_format($p['precio_venta'], 0, ',', '.'); ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($p['pro_estado'] == 'ACTIVO') { ?>
                                                                            <a href="pro_edit.php?vid=<?php echo $p['id_producto']; ?>" 
                                                                               class="btn btn-warning btn-sm" role="button"
                                                                               data-title="Editar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-edit"></span>
                                                                            </a>
                                                                            <a href="pro_delete.php?vid=<?php echo $p['id_producto']; ?>" 
                                                                               class="btn btn-danger btn-sm" role="button"
                                                                               data-title="Borrar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-trash"></span>
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
                                                    No se han encontrado productos!!!
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="position: relative; width: 350px; left: 300px;">
                                    <?php $marcas = consultas::get_datos("SELECT count(id_marca) AS cantidad FROM ref_marcas") ?>
                                    <a class="btn btn-app" href="/sysmeli/archivos/productos/marcas/mar_index.php">
                                        <span class="badge bg-blue-active"><?php echo $marcas[0]['cantidad']; ?></span>
                                        <i class="fa fa-cc-jcb"></i> Marcas
                                    </a>
                                    
                                    <?php $tam = consultas::get_datos("SELECT count(id_serie) AS cantidad FROM ref_serie") ?>
                                    <a class="btn btn-app" href="/sysmeli/archivos/productos/serie/serie_index.php">
                                        <span class="badge bg-fuchsia-active"><?php echo $tam[0]['cantidad']; ?></span>
                                        <i class="fa fa-signal"></i> serie
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
