<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Confirmar Ajuste</title>
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
                                    <h3 class="box-title">Confirmar Ajuste</h3>
                                    <div class="box-tools">
                                        <a href="ajuste_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="ajuste_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $ajustes = consultas::get_datos("SELECT * FROM v_compras_ajuste WHERE id_ajuste=" . $_REQUEST['vidajuste']); ?>
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vid_ajuste" value="<?php echo $_REQUEST['vidajuste']; ?>"/>
                                        <input type="hidden" name="vid_producto" value="<?php echo $ajustes[0]['id_producto']; ?>"/>
                                        <input type="hidden" name="vid_deposito" value="<?php echo $ajustes[0]['id_deposito']; ?>"/>
                                        <input type="hidden" name="vid_mj" value="<?php echo $ajustes[0]['id_mj']; ?>"/>
                                        <input type="hidden" name="vid_usuario" value="<?php echo $ajustes[0]['id_usuario']; ?>"/>
                                        <input type="hidden" name="vaj_fecha" value="<?php echo $ajustes[0]['aj_fecha']; ?>"/>
                                        <input type="hidden" name="vaj_observacion" value="<?php echo $ajustes[0]['aj_observacion']; ?>"/>
                                        <input type="hidden" name="vaj_cantidad" value="<?php echo $ajustes[0]['aj_cantidad']; ?>"/>
                                        <input type="hidden" name="vaj_estado" value="<?php echo $ajustes[0]['aj_estado']; ?>"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $ajustes[0]['fecdate']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $ajustes[0]['pro_descri']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $ajustes[0]['aj_cantidad']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-sm-1 col-xs-1">Motivo</label>
                                            <input class="form-control" type="text" readonly="" value="<?php echo $ajustes[0]['mj_descri']; ?>">
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
