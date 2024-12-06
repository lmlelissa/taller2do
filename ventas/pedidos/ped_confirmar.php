<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Anular Pedido</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-close"></i>
                                    <h3 class="box-title">Confirmar Pedido</h3>
                                    <div class="box-tools">
                                        <a href="ped_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="ped_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php
                                        $id_pedido = $_REQUEST['vid_pedido'];
                                        $pedidos = consultas::get_datos("SELECT * FROM v_ventas_pedidos WHERE id_pedido=$id_pedido");
                                        ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vid_pedido"  value="<?= $pedidos[0]['id_pedido']; ?>">
                                        <input type="hidden" name="vid_sucursal" value="<?= $pedidos[0]['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vid_usuario" value="<?= $pedidos[0]['id_usuario']; ?>"/>
                                        <input type="hidden" name="vid_cliente" value="<?= $pedidos[0]['id_cliente']; ?>"/>
                                        <input type="hidden" name="vfecha" value="<?= $pedidos[0]['fecha']; ?>"/>
                                        <input type="hidden" name="vtotal" value="<?= $pedidos[0]['total']; ?>"/>
                                        <input type="hidden" name="vestado" value="CONFIRMADO"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $pedidos[0]['fecha_corta1']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Cliente</label>
                                            <input class="form-control" type="text" value="<?= $pedidos[0]['cliente']; ?>" readonly="">
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
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>