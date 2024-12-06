<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Confirmar Presupuesto</title>
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
                                    <h3 class="box-title">Confirmar Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="pc_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="pc_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <div class=row">
                                            <?php $presup = consultas::get_datos("SELECT * FROM v_compras_presupuesto WHERE id_presupuesto=" . $_GET['vid']); ?>
                                            <input type="hidden" name="voperacion"  value="2">
                                            <input type="hidden" name="vpresupuesto" value="<?= $presup[0]['id_presupuesto']; ?>"/>
                                            <input type="hidden" name="vsucursal" value="<?= $presup[0]['id_sucursal']; ?>"/>
                                            <input type="hidden" name="vusuario" value="<?= $presup[0]['id_usuario']; ?>"/>
                                            <input type="hidden" name="vproveedor" value="<?= $presup[0]['id_proveedor']; ?>"/>
                                            <input type="hidden" name="vpedido" value="<?= $presup[0]['id_pedido']; ?>"/>
                                            <input type="hidden" name="vfecha" value="<?= $presup[0]['pres_fecha']; ?>"/>
                                            <input type="hidden" name="vvalidez" value="<?= $presup[0]['pres_validez']; ?>"/>
                                            <input type="hidden" name="vmonto" value="<?= $presup[0]['pres_monto']; ?>"/>
                                            <input type="hidden" name="vestado" value="CONFIRMADO"/>
                                            <div class="form-group">
                                                <label>Fecha</label>
                                                <?php $fechaActual = date('d-m-Y'); ?>
                                                <input class="form-control" type="text" readonly="" value="<?= $presup[0]['fecdate']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Usuario</label>
                                                <input class="form-control" type="text" readonly="" value="<?= $presup[0]['usu_nick']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Pedido</label>
                                                <input class="form-control" type="text" readonly="" value="<?= $presup[0]['id_pedido']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Proveedor</label>
                                                <input class="form-control" type="text" readonly="" value="<?= $presup[0]['prv_razonsocial']; ?>">
                                            </div>

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
