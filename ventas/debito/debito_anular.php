<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Anular</title>
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
                                    <i class="fa fa-close"></i>
                                    <h3 class="box-title">Anular Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="debito_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="debito_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $notad = consultas::get_datos("SELECT * FROM v_ventas_ndebito WHERE id_nota=" . $_REQUEST['vidnota']); ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vid_nota" value="<?= $notad[0]['id_nota']; ?>"/>
                                        <input type="hidden" name="vid_apecie" value="<?= $notad[0]['id_apecie']; ?>"/>
                                        <input type="hidden" name="vid_tim" value="<?= $notad[0]['id_tim']; ?>"/>
                                        <input type="hidden" name="vid_venta" value="<?= $notad[0]['id_venta']; ?>"/>
                                        <input type="hidden" name="vid_cliente" value="<?= $notad[0]['id_cliente']; ?>"/>
                                        <input type="hidden" name="vid_motivo" value="<?= $notad[0]['id_motivo']; ?>"/>
                                        <input type="hidden" name="vnd_comprobante" value="<?= $notad[0]['nd_comprobante']; ?>"/>
                                        <input type="hidden" name="vnd_fecha" value="<?= $notad[0]['nd_fecha']; ?>"/>
                                        <input type="hidden" name="vnd_monto" value="<?= $notad[0]['nd_monto']; ?>"/>
                                        <input type="hidden" name="vnd_monto_iva" value="<?= $notad[0]['nd_monto_iva']; ?>"/>
                                        <input type="hidden" name="vnd_estado" value="<?= $notad[0]['nd_estado']; ?>"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" readonly="" value="<?= $notad[0]['fecha1']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nro Factura</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $notad[0]['nd_comprobante']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $notad[0]['cliente']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Monto</label>
                                            <input class="form-control" type="text" readonly="" value="<?= number_format($notad[0]['nd_monto'], 0, '.', '.'); ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-check"></i> Anular
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
    </BODY>
</HTML>
