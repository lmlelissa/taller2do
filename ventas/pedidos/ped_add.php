<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Agregar Venta</title>
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
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Pedido</h3>
                                    <div class="box-tools">
                                        <a href="ped_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="ped_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_pedido"  value="0">
                                        <input type="hidden" name="vid_sucursal" value="<?= $_SESSION['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vid_usuario" value="<?= $_SESSION['id_usuario']; ?>"/>
                                        <input type="hidden" name="vestado" value="PENDIENTE"/>
                                        <input type="hidden" name="vtotal" value="0"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" name="vfecha" readonly="" value="<?= $fechaActual; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Clientes</label>
                                            <?php $clie = consultas::get_datos("SELECT * FROM v_ref_clientes WHERE id_cliente > 0 ORDER BY id_cliente"); ?>
                                            <select class="form-control select2" name="vid_cliente" required="">
                                                <?php if (!empty($clie)) { ?>
                                                    <option value="">SELECCIONE CLIENTE</option> 
                                                    <?php foreach ($clie as $cli) {
                                                        ?>
                                                        <option value="<?= $cli['id_cliente']; ?>">
                                                            <?= $cli['cliente'] . ' (' . $cli['per_ci'] . ')'; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">NO EXISTEN REGISTROS</option>             
                                                <?php }
                                                ?>
                                            </select>
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
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>