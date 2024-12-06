<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Confirmar Nota</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-checkmark"></i>
                                    <h3 class="box-title">Confirmar Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="debito_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="debito_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $notac = consultas::get_datos("SELECT * FROM v_compras_debito WHERE id_nota=" . $_REQUEST['vidnota']); ?>
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vid_nota" value="<?= $notac[0]['id_nota']; ?>"/>
                                        <input type="hidden" name="vnc_comprobante" value="<?= $notac[0]['nc_comprobante']; ?>"/>
                                        <input type="hidden" name="vid_proveedor" value="<?= $notac[0]['id_proveedor']; ?>"/>
                                        <input type="hidden" name="vid_compra" value="<?= $notac[0]['id_compra']; ?>"/>
                                        <input type="hidden" name="vid_usuario" value="<?= $notac[0]['id_usuario']; ?>"/>
                                        <input type="hidden" name="vid_sucursal" value="<?= $notac[0]['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vnc_fecha_sistema" value="<?= $notac[0]['nc_fecha_sistema']; ?>"/>
                                        <input type="hidden" name="vnc_fecha_recibido" value="<?= $notac[0]['nc_fecha_recibido']; ?>"/>
                                        <input type="hidden" name="vnc_nro_timbrado" value="<?= $notac[0]['nc_nro_timbrado']; ?>"/>
                                        <input type="hidden" name="vnc_timbrado_venc" value="<?= $notac[0]['nc_timbrado_venc']; ?>"/>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-sm-1 col-xs-1">Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" readonly="" value="<?= $notac[0]['fecdate']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-sm-1 col-xs-1">Nro Factura</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $notac[0]['com_nro_factura']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-sm-1 col-xs-1">Proveedor</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $notac[0]['prv_razonsocial']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-sm-1 col-xs-1">Monto</label>
                                            <input class="form-control" type="text" readonly="" value="<?= number_format($notac[0]['nc_monto'], 0, '.', '.'); ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-check"></i> Confirmar
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
