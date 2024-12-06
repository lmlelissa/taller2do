<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Cuentas a Cobrar</title>
        <?php
        session_start();
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cuentas a Cobrar</h3>
                                    <div class="box-tools">

                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consultagral = consultas::get_datos("SELECT * FROM v_ventas_ctas_cobrar WHERE cta_estado IN('PENDIENTE', 'ANULADO') ORDER BY id_cta");
                                            if (!empty($consultagral)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Factura</th>
                                                                <th class="text-center">Cuota N°</th>
                                                                <th class="text-center">Vencimiento</th>
                                                                <th class="text-center">Monto</th>
                                                                <th class="text-center">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consultagral AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?= $p['cliente']; ?></td>
                                                                    <td class="text-center"> <?= $p['nro_factura']; ?></td>
                                                                    <td class="text-center"> <?= $p['cta_cuota']; ?></td>
                                                                    <td class="text-center"> <?= $p['fecha1']; ?></td>
                                                                    <td class="text-center"> <?= number_format($p['cta_importe'], 0, '.', '.'); ?></td>
                                                                    <?php if ($p['cta_estado'] == 'PENDIENTE') { ?>
                                                                        <td class="text-center" style="background-color: greenyellow;"> <?= $p['cta_estado']; ?></td>
                                                                    <?php } ?>
                                                                    <?php if ($p['cta_estado'] == 'ANULADO') { ?>
                                                                        <td class="text-center" style="background-color: red;"> <?= $p['cta_estado']; ?></td>
                                                                    <?php } ?>
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
    </BODY>
</HTML>
