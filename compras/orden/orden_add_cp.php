<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Agregar Orden con Presupuesto</title>
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Orden con Pedido</h3>
                                    <div class="box-tools">
                                        <a href="/sysmeli/compras/presupuesto/pc_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="orden_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vorden" value="0"/>
                                        <input type="hidden" name="vpresu" value="<?php echo $_GET['vidpres']; ?>"/>
                                        <input type="hidden" name="vusuario" value="<?php echo $_SESSION['id_usuario']; ?>"/>
                                        <input type="hidden" name="vsucursal" value="<?php echo $_SESSION['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vestado" value="PENDIENTE"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo $fechaActual; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label >Presupuesto</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $_GET['vidpres']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <?php $prvs = consultas::get_datos("SELECT * FROM v_compras_presupuesto WHERE id_presupuesto=" . $_GET['vidpres']); ?>
                                            <label>Pedido</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $prvs[0]['id_pedido']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label >Proveedor</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $prvs[0]['prv_razonsocial']; ?>"/>
                                            <input class="form-control" type="hidden" readonly="" value="<?php echo $prvs[0]['id_proveedor']; ?>" name="vproveedor"/>
                                            <input type="hidden" name="vped" value="<?php echo $prvs[0]['id_pedido']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Monto</label>
                                            <input class="form-control" type="hidden" readonly="" value="<?php echo $prvs[0]['pres_monto']; ?>" name="vmonto"/>
                                            <input class="form-control" type="number" readonly="" value="<?php echo$prvs[0]['pres_monto']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-save"></i> Registrar
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
