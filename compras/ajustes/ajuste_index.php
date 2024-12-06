<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Ajustes de Inventario</title>
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
                            <div id="div_mensaje"></div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Ajustes de Inventario</h3>
                                    <div class="box-tools">
                                        <a href="ajuste_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consultagral = consultas::get_datos("SELECT * FROM v_compras_ajuste WHERE id_deposito IN (SELECT id_deposito FROM ref_deposito WHERE id_sucursal=".$_SESSION['id_sucursal'].") ORDER BY id_ajuste");
                                            if (!empty($consultagral)) {
                                                ?>
                                                <div class="table-responsive">
                                                     <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Deposito</th>
                                                                <th class="text-center">Producto</th>
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consultagral AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_ajuste']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['fecdate']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['pro_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['dep_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['mj_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['aj_cantidad']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['aj_estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($p['aj_estado'] == 'PENDIENTE') { ?>
                                                                            <a href="ajuste_confirmar.php?vidajuste=<?php echo $p['id_ajuste']; ?>" 
                                                                               class="btn btn-success btn-sm" role="button"
                                                                               data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-ok-sign"></span>
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($p['aj_estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="ajuste_anular.php?vidajuste=<?php echo $p['id_ajuste']; ?>" 
                                                                               class="btn btn-danger btn-sm" role="button"
                                                                               data-title="Anular" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-remove"></span>
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
                $('#example2').DataTable();
            })
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>
