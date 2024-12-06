<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Confirmar Cobro</title>
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
                                    <i class="fa fa-check"></i>
                                    <h3 class="box-title">Confirmar Cobro</h3>
                                    <div class="box-tools">
                                        <a href="cobros_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="cobros_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php
                                        $id_cobro = $_REQUEST['vid_cobro'];
                                        $cobros = consultas::get_datos("SELECT * FROM v_cobros WHERE id_cobro=$id_cobro");
                                        ?>
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vid_cobro"  value="<?= $cobros[0]['id_cobro']; ?>">
                                        <input type="hidden" name="vid_apecie" value="<?= $cobros[0]['id_apecie']; ?>"/>
                                        <input type="hidden" name="vid_cliente" value="<?= $cobros[0]['id_cliente']; ?>"/>
                                        <input type="hidden" name="vfecha" value="<?= $cobros[0]['fecha']; ?>"/>
                                        <input type="hidden" name="vestado" value="<?= $cobros[0]['estado']; ?>"/>
                                        <input type="hidden" name="vexentas" value="<?= $cobros[0]['exentas']; ?>"/>
                                        <input type="hidden" name="viva5" value="<?= $cobros[0]['iva5']; ?>"/>
                                        <input type="hidden" name="viva10" value="<?= $cobros[0]['iva10']; ?>"/>
                                        <input type="hidden" name="vivatotal" value="<?= $cobros[0]['ivatotal']; ?>"/>
                                        <input type="hidden" name="vtotal" value="<?= $cobros[0]['total']; ?>"/>
                                        <input type="hidden" name="vnro_recibo" value="<?= $cobros[0]['nro_recibo']; ?>"/>
                                        <input type="hidden" name="vcondicion" value="<?= $cobros[0]['condicion']; ?>"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $cobros[0]['fecha1']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Cliente</label>
                                            <input class="form-control" type="text" value="<?= $cobros[0]['cliente']; ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label >Condicion</label>
                                            <input class="form-control" type="text" value="<?= $cobros[0]['condicion']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-thumbs-up"></i> Confirmar
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