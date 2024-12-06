<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Anular Pedido</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
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
                                <i class="ion ion-ban-outline"></i>
                                <h3 class="box-title">Anular Pedido</h3>
                                <div class="box-tools">
                                    <a href="ped_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>
                            <form action="ped_control.php" method="POST" accept-charset="UTF-8">
                                <div class="box-body">
                                    <?php $pedidos = consultas::get_datos("SELECT * FROM v_compras_pedidos WHERE id_pedido=" . $_GET['vid']); ?>
                                    <input type="hidden" name="voperacion"  value="3">
                                    <input type="hidden" name="vpedido" value="<?= $pedidos[0]['id_pedido']; ?>"/>
                                    <input type="hidden" name="vusuario" value="<?= $pedidos[0]['id_usuario']; ?>"/>
                                    <input type="hidden" name="vsucursal" value="<?= $pedidos[0]['id_sucursal']; ?>"/>
                                    <input type="hidden" name="vfecha" value="<?= $pedidos[0]['pc_fecha']; ?>"/>
                                    <div class="form-group">
                                        <label >Fecha</label>
                                        <?php $fechaActual = date('d-m-Y'); ?>
                                        <input class="form-control" type="text" readonly="" value="<?= $pedidos[0]['fecdate']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Sucursal</label>
                                        <input class="form-control" type="text" readonly="" value="<?= $pedidos[0]['suc_nombre']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label >Usuario</label>
                                        <input class="form-control" type="text" readonly="" value="<?= $pedidos[0]['usu_nick']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label >Observacion</label>
                                        <input class="form-control" type="text" readonly="" value="<?= $pedidos[0]['pc_obs']; ?>" name="vobs">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-remove"></i> Anular
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
