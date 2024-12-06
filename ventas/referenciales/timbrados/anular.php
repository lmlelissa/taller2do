<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Anular Timbrado</title>
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
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <i class="ion ion-close"></i>
                                    <h3 class="box-title">Anular Timbrado</h3>
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
                                        $timbrados = consultas::get_datos("SELECT * FROM v_ref_timbrados WHERE id_tim=$codigo");
                                        ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vid_tim" value="<?= $timbrados[0]['id_tim']; ?>"/>
                                        <input type="hidden" name="vid_sucursal" value="<?= $timbrados[0]['id_sucursal']; ?>"/> 
                                        <input type="hidden" name="vfecha_carga" value="<?= $timbrados[0]['fecha_carga']; ?>"/> 
                                        <input type="hidden" name="vnumero_inicial" value="<?= $timbrados[0]['numero_inicial']; ?>"/> 
                                        <input type="hidden" name="vnumero_final" value="<?= $timbrados[0]['numero_final']; ?>"/> 
                                        <input type="hidden" name="vnumero_actual" value="<?= $timbrados[0]['numero_actual']; ?>"/> 
                                        <input type="hidden" name="vpunto_expedicion" value="<?= $timbrados[0]['punto_expedicion']; ?>"/> 
                                        <input type="hidden" name="vestado" value="ANULADO"/> 
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vtim"><i class="fa fa-check"></i> Timbrado</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control" type="text" id="vtim" name="vid_tim" value="<?= $timbrados[0]['id_tim']; ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vfecha_inicio"><i class="fa fa-calendar-check-o"></i> Fecha Inicio</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control" type="date" id="vfecha_inicio" name="vfecha_inicio" value="<?= $timbrados[0]['fecha_inicio']; ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vfecha_fin"><i class="fa fa-calendar-times-o"></i> Fecha Fin</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control" type="date" id="vfecha_fin" name="vfecha_fin"  value="<?= $timbrados[0]['fecha_fin']; ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vcajas"><i class="fa fa-fax"></i> Cajas</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" name="vid_caja" value="<?= $timbrados[0]['id_caja']; ?>">
                                                <input class="form-control" type="text" id="vcajas" value="<?= $timbrados[0]['caj_descri']; ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vtipo"><i class="fa fa-hdd-o"></i> Tipo Documento</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" name="vid_tipo_doc" value="<?= $timbrados[0]['id_tipo_doc']; ?>">
                                                <input class="form-control" type="text" id="vtipo" value="<?= $timbrados[0]['id_tipo_doc']; ?>" readonly="">
                                            </div>
                                        </div>
                                        <br>
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
            </div>
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
    </BODY>
</HTML>
