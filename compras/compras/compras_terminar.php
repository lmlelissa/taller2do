<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Terminar Compra</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-checkmark"></i>
                                    <h3 class="box-title">Terminar Compra</h3>
                                    <div class="box-tools">
                                        <a href="compras_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="compras_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $compra = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="5">
                                        <input type="hidden" name="vcompra" value="<?= $compra[0]['id_compra']; ?>"/>
                                        <input type="hidden" name="vorden" value="<?= $compra[0]['id_orden']; ?>"/>
                                        <input type="hidden" name="vusuario" value="<?= $compra[0]['id_usuario']; ?>"/>
                                        <input type="hidden" name="vsucursal" value="<?= $compra[0]['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vproveedor" value="<?= $compra[0]['id_proveedor']; ?>"/>
                                        <input type="hidden" name="vfecha" value="<?= $compra[0]['fecha_registro']; ?>"/>
                                        <input type="hidden" name="vfechafactura" value="<?= $compra[0]['fecha_entrega_factura']; ?>"/>
                                        <input type="hidden" name="vfactura" value="<?= $compra[0]['com_nro_factura']; ?>"/>
                                        <input type="hidden" name="vtimbrado" value="<?= $compra[0]['com_nro_timbrado']; ?>"/>
                                        <input type="hidden" name="vvencimiento" value="<?= $compra[0]['com_timbrado_venc']; ?>"/>
                                        <input type="hidden" name="vcondicion" value="<?= $compra[0]['com_condicion']; ?>"/>
                                        <input type="hidden" name="vcuota" value="<?= $compra[0]['com_cuota']; ?>"/>
                                        <input type="hidden" name="vintervalo" value="<?= $compra[0]['com_intervalo']; ?>"/>
                                        <input type="hidden" name="vtotiva" value="<?= $compra[0]['com_total_iva']; ?>"/>
                                        <input type="hidden" name="vtotal" value="<?= $compra[0]['com_total']; ?>"/>
                                        <input type="hidden" name="vestado" value="<?= $compra[0]['com_estado']; ?>"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $compra[0]['fecdate']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Nro Factura</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $compra[0]['com_nro_factura']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $compra[0]['prv_razonsocial']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Monto</label>
                                            <input class="form-control" type="text" readonly="" value="<?= number_format($compra[0]['com_total'], 0, '.', '.'); ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-check-circle"></i> Terminar
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
