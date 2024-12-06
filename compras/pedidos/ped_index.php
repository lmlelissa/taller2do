<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Pedidos</title>
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
                                    <h3 class="box-title">Pedidos de Compra</h3>
                                    <div class="box-tools">
                                        <a href="ped_add.php" class="btn btn-success pull-right btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consultagral = consultas::get_datos("SELECT * FROM v_compras_pedidos ORDER BY id_pedido");
                                            if (!empty($consultagral)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Sucursal</th>
                                                                <th class="text-center">Usuario</th>
                                                                <th class="text-center">Obs</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consultagral AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_pedido']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['fecdate']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['suc_nombre']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['usu_nick']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['pc_obs']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['pc_estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <form action="ped_detalle.php" method="GET">
                                                                            <input type="hidden" value="<?php echo $p['id_pedido']; ?>" name="vid">
                                                                            <button type="submit" class="btn btn-sm btn-warning" rel='tooltip' data-title="Detalles">
                                                                                <span class="fa fa-list"></span>
                                                                            </button>
                                                                            <?php if ($p['pc_estado'] == 'PENDIENTE') { ?>
                                                                                <?php
                                                                                $consultadetalle = consultas::get_datos("SELECT * FROM compras_pedidos_detalle WHERE id_pedido=" . $p['id_pedido']);
                                                                                if (!empty($consultadetalle)) {
                                                                                    ?>
                                                                                    <a href="ped_confirmar.php?vid=<?php echo $p['id_pedido']; ?>" 
                                                                                       class="btn btn-success btn-sm" role="button"
                                                                                       data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                        <span class="glyphicon glyphicon-ok-sign"></span>
                                                                                    </a>
                                                                                <?php } else { ?>
                                                                                    <a href="ped_anular.php?vid=<?php echo $p['id_pedido']; ?>" 
                                                                                       class="btn btn-danger btn-sm" role="button"
                                                                                       data-title="Anular" rel="tooltip" data-placement="top">
                                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                                    </a>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                            <?php if ($p['pc_estado'] == 'CONFIRMADO') { ?>
                                                                                <a href="/sysmeli/compras/presupuesto/pc_add.php?vidped=<?php echo $p['id_pedido']; ?>" 
                                                                                   class="btn btn-success btn-sm" role="button"
                                                                                   data-title="Presupuesto" rel="tooltip" data-placement="top">
                                                                                    <span class="glyphicon glyphicon-bitcoin"></span>
                                                                                </a>
                                                                            <?php } ?>
                                                                        </form>
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
