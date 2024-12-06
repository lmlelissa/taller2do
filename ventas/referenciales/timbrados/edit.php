<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Editar Timbrado</title>
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
                                    <h3 class="box-title">Editar Timbrado</h3>
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
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vid_tim" value="<?= $timbrados[0]['id_tim']; ?>"/>
                                        <input type="hidden" name="vid_sucursal" value="<?= $timbrados[0]['id_sucursal']; ?>"/> 
                                        <input type="hidden" name="vfecha_carga" value="<?= $timbrados[0]['fecha_carga']; ?>"/> 
                                        <input type="hidden" name="vnumero_actual" value="<?= $timbrados[0]['numero_actual']; ?>"/> 
                                        <input type="hidden" name="vpunto_expedicion" value="<?= $timbrados[0]['punto_expedicion']; ?>"/> 
                                        <input type="hidden" name="vestado" value="<?= $timbrados[0]['estado']; ?>"/> 
                                        <input type="hidden" name="vnumero_inicial" value="<?= $timbrados[0]['numero_inicial']; ?>"/> 
                                        <div class="form-group has-warning">
                                            <?php $cajas = consultas::get_datos("SELECT * FROM ref_cajas WHERE id_sucursal=" . $timbrados[0]['id_caja'] . " ORDER BY id_caja=" . $timbrados[0]['id_caja'] . " DESC"); ?>
                                            <label class="control-label"><i class="fa fa-fax"></i> Cajas</label>
                                            <select class="form-control" name="vid_caja"> 
                                                <?php if (!empty($cajas)) { ?>
                                                    <?php foreach ($cajas as $caja) { ?>
                                                        <option value="<?= $caja['id_caja']; ?>"><?= $caja['caj_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label"><i class="fa fa-hdd-o"></i> Tipo de Documento</label>
                                            <select class="form-control" name="vid_tipo_doc"> 
                                                <option value="<?= $timbrados[0]['id_tipo_doc']; ?>"><?= $timbrados[0]['id_tipo_doc']; ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vfecha_inicio"><i class="fa fa-calendar-check-o"></i> Fecha Inicio</label>
                                            <input class="form-control" type="date" id="vfecha_inicio" name="vfecha_inicio"  required="" value="<?= $timbrados[0]['fecha_inicio']; ?>">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vfecha_fin"><i class="fa fa-calendar-times-o"></i> Fecha Fin</label>
                                            <input class="form-control" type="date" id="vfecha_fin" name="vfecha_fin"  min="<?= date('Y-m-d'); ?>" required="" value="<?= $timbrados[0]['fecha_fin']; ?>">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vnumero_final"><i class="fa fa-bar-chart-o"></i> Numero Final</label>
                                            <input class="form-control" type="text" id="vnumero_final" name="vnumero_final" min="0" required="" value="<?= $timbrados[0]['numero_final']; ?>">
                                        </div>
                                        <br>
                                        <div class="box-footer">
                                            <button class="btn btn-warning" type="submit">
                                                <i class="fa fa-edit"></i> Editar
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
