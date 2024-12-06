<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Nota de Debito</title>
        <?php
        include '../../sesion_ver.php';
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
                            <div id="div_mensaje"></div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="debito_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;" title="Sin Orden">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consultagral = consultas::get_datos("SELECT * FROM v_compras_debito WHERE id_sucursal=".$_SESSION['id_sucursal']." ORDER BY id_nota");
                                            if (!empty($consultagral)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Comprobante</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Iva</th>
                                                                <th class="text-center">Monto</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consultagral AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_nota']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['nc_comprobante']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_razonsocial']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['fecdate']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['mot_descri']; ?></td>
                                                                    <td class="text-center"> <?php echo number_format($p['nc_monto_iva'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> <?php echo number_format($p['nc_monto'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> <?php echo $p['nc_estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <form action="debito_detalle.php" method="GET">
                                                                            <input type="hidden" value="<?php echo $p['id_nota']; ?>" name="vid_nota">
                                                                            <button type="submit" class="btn btn-sm btn-warning" rel='tooltip' data-title="Detalles">
                                                                                <span class="fa fa-list"></span>
                                                                            </button>
                                                                            <?php if ($p['nc_estado'] == 'PENDIENTE') { ?>
                                                                                <?php
                                                                                $consultadetalle = consultas::get_datos("SELECT * FROM v_compras_credito_detalle WHERE id_nota=" . $p['id_nota']);
                                                                                if (!empty($consultadetalle)) {
                                                                                    ?>
                                                                                    <a href="debito_confirmar.php?vidnota=<?php echo $p['id_nota'] . "&vcompra=" . $p['id_compra']; ?>" 
                                                                                       class="btn btn-success btn-sm" role="button"
                                                                                       data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                        <span class="glyphicon glyphicon-ok-sign"></span>
                                                                                    </a>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                            <?php if ($p['nc_estado'] == 'CONFIRMADO') { ?>
                                                                                <a href="debito_anular.php?vidnota=<?php echo $p['id_nota'] . "&vcompra=" . $p['id_compra']; ?>" 
                                                                                   class="btn btn-danger btn-sm" role="button"
                                                                                   data-title="Anular" rel="tooltip" data-placement="top">
                                                                                    <span class="glyphicon glyphicon-remove"></span>
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
