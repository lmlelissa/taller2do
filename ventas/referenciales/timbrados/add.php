<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registrar Timbrado</title>
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
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Timbrado</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="controlador.php" method="POST" accept-charset="UTF-8" role="form">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_tim" value="0"/>
                                        <input type="hidden" name="vid_sucursal" value="<?php echo $_SESSION['id_sucursal'] ?>"/>
                                        <input type="hidden" name="vfecha_carga" value="<?php echo date('Y-m-d'); ?>"/>
                                        <input type="hidden" name="vnumero_actual" value="0"/>
                                        <input type="hidden" name="vpunto_expedicion" value="<?php echo '00' . $_SESSION['id_sucursal'] ?>"/>
                                        <input type="hidden" name="vestado" value="ACTIVO"/>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vsucu"><i class="fa fa-university"></i> Sucursal</label>
                                            <input class="form-control" type="text" id="vsucu" readonly="" value="<?php echo $_SESSION['sucursal']; ?>" required="">
                                        </div>
                                        <div class="form-group has-warning">
                                            <?php $cajas = consultas::get_datos("SELECT * FROM ref_cajas WHERE id_sucursal=" . $_SESSION['id_sucursal'] . " ORDER BY id_caja"); ?>
                                            <label class="control-label"><i class="fa fa-fax"></i> Cajas</label>
                                            <select class="form-control" name="vid_caja" required=""> 
                                                <?php if (!empty($cajas)) { ?>
                                                    <option value="">Seleccione un Registro</option>    
                                                    <?php foreach ($cajas as $ca) { ?>
                                                        <option value="<?php echo $ca['id_caja']; ?>"><?php echo $ca['caj_descri']; ?></option>
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
                                            <label class="control-label"><i class="fa fa-hdd-o"></i> Tipo Documento</label>
                                            <select class="form-control" name="vid_tipo_doc" required=""> 
                                                <option value="">Seleccione un Registro</option>    
                                                <option value="FACTURA">FACTURA</option>    
                                            </select>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vfecha_inicio"><i class="fa fa-calendar-check-o"></i> Fecha Inicio</label>
                                            <input class="form-control" type="date" id="vfecha_inicio" name="vfecha_inicio" required="" value="<?= date('Y-m-d');?>">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vfecha_fin"><i class="fa fa-calendar-times-o"></i> Fecha Fin</label>
                                            <input class="form-control" type="date" id="vfecha_fin" name="vfecha_fin" required="" value="<?= date('Y-m-d');?>">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vnumero_inicial"><i class="fa fa-bar-chart-o"></i> Numero Inicial</label>
                                            <input class="form-control" type="text" id="vnumero_inicial" name="vnumero_inicial" min="0" value="0" required="">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="vnumero_final"><i class="fa fa-bar-chart-o"></i> Numero Final</label>
                                            <input class="form-control" type="text" id="vnumero_final" name="vnumero_final" min="0" value="100" required="">
                                        </div>
                                        <br>
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
            </div>
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
    </BODY>
</HTML>
