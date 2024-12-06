<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Traslado</title>
        <?php
        include '../../sesion_ver.php';
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <i class="fa fa-car"></i>
                                    <h3 class="box-title">Trasladar Productos</h3>
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
                                        $notar = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_nr=$codigo");
                                        ?>
                                        <input type="hidden" name="voperacion" value="5">
                                        <input type="hidden" name="vid_nr" value="<?php echo $notar[0]['id_nr']; ?>"/> 
                                        <input type="hidden" name="vnr_timbrado" value="<?php echo $notar[0]['nr_timbrado']; ?>"/> 
                                        <input type="hidden" name="vid_usuario" value="<?php echo $_SESSION['id_usuario'] ?>"/> 
                                        <input type="hidden" name="vid_vehiculo" value="<?php echo $notar[0]['id_vehiculo']; ?>"/>
                                        <input type="hidden" name="vnr_fecha" value="<?php echo $notar[0]['nr_fecha']; ?>"/>
                                        <input type="hidden" name="vid_empleado" value="<?php echo $notar[0]['id_empleado']; ?>">
                                        <input type="hidden" name="vfecha_inicio_translado" value="<?php echo $notar[0]['fecha_inicio_translado']; ?>"/> 
                                        <input type="hidden" name="vfecha_fin_translado" value="<?php echo $notar[0]['fecha_fin_translado']; ?>"/> 
                                        <input type="hidden" name="vsucursal_salida" value="<?php echo $notar[0]['sucursal_salida']; ?>"/>
                                        <input type="hidden" name="vsucursal_entrada" value="<?php echo $notar[0]['sucursal_entrada']; ?>"/>
                                        <input type="hidden" name="vnr_estado" value="TRASLADANDO"/>
                                        <div class="form-group">
                                            <label class="control-label" for="vmotivo_translado"><i class="fa fa-list"></i>Motivo</label>
                                            <input type="text" class="form-control" id="vmotivo_translado" name="vmotivo_translado" value="<?php echo $notar[0]['motivo_translado']; ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="vid_empleado"><i class="fa fa-user"></i>Chofer</label>
                                            <input type="text" class="form-control" id="vid_empleado" value="<?php echo $notar[0]['persona']; ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="vid_vehiculo"><i class="fa fa-car"></i>Vehiculo</label>
                                            <input type="text" class="form-control" id="vid_vehiculo" value="<?php echo $notar[0]['veh_chapa']; ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="vsucursal_entrada"><i class="fa fa-map"></i>Destino</label>
                                            <input type="text" class="form-control" id="vsucursal_entrada" value="<?php echo $notar[0]['salida']; ?>" readonly="">
                                        </div>
                                        <div class="box-footer">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-car"></i> Trasladar
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
