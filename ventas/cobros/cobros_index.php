<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Cobros</title>
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
                                        <h3 class="box-title">Cobros</h3>
                                        <div class="box-tools">
                                            <a href="cobros_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;" title="Agregar">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <?php
                                                $consultagral = consultas::get_datos("SELECT * FROM v_cobros WHERE id_sucursal=" . $_SESSION['id_sucursal'] . " ORDER BY id_cobro");
                                                if (!empty($consultagral)) {
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th class="text-center">Fecha</th>
                                                                    <th class="text-center">Apertura</th>
                                                                    <th class="text-center">Cliente</th>
                                                                    <th class="text-center">Condicion</th>
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">Estado</th>
                                                                    <th class="text-center">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($consultagral AS $p) { ?>
                                                                    <tr>
                                                                        <td class="text-center"> <?= $p['id_cobro']; ?></td>
                                                                        <td class="text-center"> <?= $p['fecha1']; ?></td>
                                                                        <td class="text-center"> <?= $p['id_apecie']; ?></td>
                                                                        <td class="text-center"> <?= '(' . $p['per_ci'] . ')-' . $p['cliente']; ?></td>
                                                                        <td class="text-center"> <?= $p['condicion']; ?></td>
                                                                        <td class="text-center"> <?= number_format($p['total'], 0, '.', '.'); ?></td>
                                                                        <td class="text-center"> <?= $p['estado']; ?></td>
                                                                        <td class="text-center">
                                                                            <form action="cobros_detalle.php" method="GET">
                                                                                <input type="hidden" value="<?= $p['id_cobro']; ?>" name="vid_cobro">
                                                                                <button type="submit" class="btn btn-sm btn-primary" rel='tooltip' data-title="Cuentas" title="Cuentas">
                                                                                    <span class="fa fa-list"></span>
                                                                                </button>
                                                                                <?php if ($p['estado'] == 'PENDIENTE') { ?>
                                                                                    <a href="cobros_confirmar.php?vid_cobro=<?= $p['id_cobro']; ?>" 
                                                                                       class="btn btn-success btn-sm" role="button"
                                                                                       data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                        <span class="fa fa-check"></span>
                                                                                    </a>
                                                                                    <a href="cobros_anular.php?vid_cobro=<?= $p['id_cobro']; ?>" 
                                                                                       class="btn btn-danger btn-sm" role="button"
                                                                                       data-title="Anular" rel="tooltip" data-placement="top">
                                                                                        <span class="fa fa-close"></span>
                                                                                    </a>
                                                                                <?php } ?>
                                                                                <?php if ($p['estado'] == 'CONFIRMADO' || $p['estado'] == 'PAGADO') { ?>
                                                                                    <a href="cobros_forma.php?vid_cobro=<?= $p['id_cobro']; ?>" 
                                                                                       class="btn btn-success btn-sm" role="button"
                                                                                       data-title="Formas de Cobro" rel="tooltip" data-placement="top" title="Formas de Cobro">
                                                                                        <span class="fa fa-money"></span>
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
