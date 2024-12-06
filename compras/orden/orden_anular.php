<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Anular Orden</title>
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
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-close"></i>
                                    <h3 class="box-title">Anular Orden de Compra</h3>
                                    <div class="box-tools">
                                        <a href="orden_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="orden_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $orden = consultas::get_datos("SELECT * FROM v_compras_orden WHERE id_orden=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="4">
                                        <input type="hidden" name="vorden" value="<?= $orden[0]['id_orden']; ?>"/>
                                        <input type="hidden" name="vpresu" value="<?= $orden[0]['id_presupuesto']; ?>"/>
                                        <input type="hidden" name="vped" value="<?= $orden[0]['id_pedido']; ?>"/>
                                        <input type="hidden" name="vproveedor" value="<?= $orden[0]['id_proveedor']; ?>"/>
                                        <input type="hidden" name="vusuario" value="<?= $orden[0]['id_usuario']; ?>"/>
                                        <input type="hidden" name="vsucursal" value="<?= $orden[0]['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vfecha" value="<?= $orden[0]['ord_fecha']; ?>"/>
                                        <input type="hidden" name="vmonto" value="<?= $orden[0]['ord_total']; ?>"/>
                                        <input type="hidden" name="vestado" value="<?= $orden[0]['ord_estado']; ?>"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" readonly="" value="<?= $orden[0]['fecdate']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $orden[0]['usu_nick']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $orden[0]['prv_razonsocial']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Monto</label>
                                            <input class="form-control" type="text" readonly="" 
                                                   value="<?= number_format($orden[0]['ord_total'], 0, '.', '.'); ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-close"></i> Anular
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
