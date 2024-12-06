<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Desactivar</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Desactivar Caja</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="controlador.php" method="POST" accept-charset="UTF-8" role="form">
                                        <?php
                                        $codigo = $_REQUEST['vid'];
                                        $cajas = consultas::get_datos("SELECT * FROM v_ref_cajas WHERE id_caja=$codigo");
                                        ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vid_caja" value="<?= $cajas[0]['id_caja']; ?>"/> 
                                        <input type="hidden" name="vid_sucursal" value="<?= $cajas[0]['id_sucursal']; ?>"/> 
                                        <input type="hidden" name="vestado" value="INACTIVO"/> 
                                        <div class="form-group has-success">
                                            <label class="control-label" for="vdescripcion"><i class="fa fa-check"></i>Descripcion</label>
                                            <input type="text" class="form-control" id="vdescripcion" name="vdescripcion" readonly="" value="<?= $cajas[0]['caj_descri']; ?>">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vsucursal"><i class="fa fa-check"></i>Sucursal</label>
                                            <input type="text" class="form-control" id="vsucursal" readonly="" value="<?= $cajas[0]['suc_nombre']; ?>">
                                        </div>
                                        <div class="box-footer" style="text-align: center;">
                                            <button class="btn btn-danger" type="submit">Desactivar
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
    </BODY>
</HTML>
