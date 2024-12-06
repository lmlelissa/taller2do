<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Ventas</title>
        <?php
        session_start();
        include '../../conexion.php';
        require '../../tools/css.php';
        $apertura = consultas::get_datos("SELECT * FROM v_ventas_apertura WHERE id_usuario = " . $_SESSION['id_usuario'] . "and id_sucursal =" . $_SESSION['id_sucursal'] . "AND cierre_fecha IS NULL;");
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <?php if (empty($apertura)) { ?>
                        <label class="text-danger"><i class="fa fa-exclamation-circle"></i> No se encuentra una apertura de caja...</label>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <div id="div_mensaje">

                                </div>
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Factura de Ventas</h3>
                                        <div class="box-tools">
                                           
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <?php
                                                $consultagral = consultas::get_datos("SELECT * FROM v_ventas_factura WHERE id_sucursal=" . $_SESSION['id_sucursal'] . " ORDER BY id_venta");
                                                if (!empty($consultagral)) {
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th class="text-center">N° Pedido</th>
                                                                    <th class="text-center">Fecha</th>
                                                                    <th class="text-center">Nro Factura</th>
                                                                    <th class="text-center">Cliente</th>
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">Estado</th>
                                                                    <th class="text-center">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($consultagral AS $p) { ?>
                                                                    <tr>
                                                                        <td class="text-center"> <?= $p['id_venta']; ?></td>
                                                                        <td class="text-center"> <?= $p['id_pedido']; ?></td>
                                                                        <td class="text-center"> <?= $p['fecha1']; ?></td>
                                                                        <td class="text-center"> <?= $p['nro_factura']; ?></td>
                                                                        <td class="text-center"> <?= '(' . $p['per_ci'] . ')-' . $p['cliente']; ?></td>
                                                                        <td class="text-center"> <?= number_format($p['total'], 0, '.', '.'); ?></td>
                                                                        <td class="text-center"> <?= $p['estado']; ?></td>
                                                                        <td class="text-center">
                                                                            <form action="ventas_detalle.php" method="GET">
                                                                                <input type="hidden" value="<?= $p['id_venta']; ?>" name="vid_venta">
                                                                                <button type="submit" class="btn btn-sm btn-primary" rel='tooltip' data-title="Detalles">
                                                                                    <span class="fa fa-list"></span>
                                                                                </button>
                                                                                <?php if ($p['estado'] == 'PENDIENTE') { ?>
                                                                                    <?php
                                                                                    $consultadetalle = consultas::get_datos("SELECT * FROM ventas_factura WHERE id_venta=" . $p['id_venta']);
                                                                                    if (!empty($consultadetalle)) {
                                                                                        ?>
                                                                                        <a href="ventas_confirmar.php?vid_venta=<?= $p['id_venta']; ?>" 
                                                                                           class="btn btn-success btn-sm" role="button"
                                                                                           data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                            <span class="fa fa-check"></span>
                                                                                        </a>
                                                                                        <a href="ventas_anular.php?vid_venta=<?= $p['id_venta']; ?>" 
                                                                                           class="btn btn-danger btn-sm" role="button"
                                                                                           data-title="Anular" rel="tooltip" data-placement="top">
                                                                                            <span class="fa fa-close"></span>
                                                                                        </a>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                                <?php
                                                                                if ($p['estado'] == 'CONFIRMADO') {
                                                                                    $cuentas = consultas::get_datos("SELECT * FROM ventas_ctas_cobrar WHERE id_venta=" . $p['id_venta'] . " AND cta_estado NOT IN('PAGADO')");
                                                                                    if (!empty($cuentas)) {
                                                                                        ?>
                                                                                        <a href="ventas_anular.php?vid_venta=<?= $p['id_venta']; ?>" 
                                                                                           class="btn btn-danger btn-sm" role="button"
                                                                                           data-title="Anular" rel="tooltip" data-placement="top">
                                                                                            <span class="fa fa-close"></span>
                                                                                        </a>
                                                                                    <?php } ?>
                                                                                    <a href="imprimir.php?id_venta=<?= $p['id_venta']; ?>" target="_blank" class="btn btn-sm btn-success" title="Imprimir Factura">
                                                                                        <i class="fa fa-print"></i>
                                                                                    </a>
                                                                                <?php } ?>
                                                                                <?php if ($p['estado'] == 'CON NOTA DEBITO') { ?>
<!--                                                                                    <a href="imprimir_debito.php/?id_venta=<?= $p['id_venta']; ?>" target="_blank" class="btn btn-sm btn-warning" title="Imprimir Nota de Debito">
                                                                                        <i class="fa fa-print"></i>
                                                                                    </a>-->
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
                    <?php } ?>
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
