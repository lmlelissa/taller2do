<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Agregar Nota</title>
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
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Nota de Remision</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="controlador.php" method="POST" accept-charset="UTF-8" role="form">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_nr" value="0"/> 
                                        <input type="hidden" name="vid_usuario" value="<?php echo $_SESSION['id_usuario'] ?>"/> 
                                        <input type="hidden" name="vnr_fecha" value="<?php echo date('Y-m-d'); ?>"/> 
                                        <input type="hidden" name="vfecha_fin_translado" value="2023-06-24T00:26"/> 
                                        <input type="hidden" name="vsucursal_salida" value="<?php echo $_SESSION['id_sucursal'] ?>"/>
                                        <input type="hidden" name="vnr_estado" value="PENDIENTE"/>
                                        <div class="form-group has-success">
                                            <label class="control-label" for="ntimb"><i class="fa fa-check"></i>Numero de Timbrado</label>
                                            <input type="text" class="form-control" id="ntimb" placeholder="Ingrese Timbrado..." name="vnr_timbrado" readonly="" value="1">
                                        </div>
                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <select class="form-control" name="vmotivo_translado">
                                                <option>TRASLADO</option>
                                                <option>FALTA DE INSUMOS</option>
                                            </select>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="finicio"><i class="fa fa-clock-o"></i>Inicio</label>
                                            <input type="datetime-local" class="form-control" id="finicio" name="vfecha_inicio_translado" required="">
                                        </div>
                                        <div class="form-group">
                                            <?php $chofer = consultas::get_datos("SELECT * FROM v_empleados ORDER BY id_empleado"); ?>
                                            <label>Chofer</label>
                                            <select class="form-control" name="vid_empleado">
                                                <?php if (!empty($chofer)) { ?>
                                                    <?php foreach ($chofer as $chof) {
                                                        ?>
                                                        <option value="<?php echo $chof['id_empleado']; ?>"><?php echo $chof['per_ci'] . '-' . $chof['per_nombre'] . ' ' . $chof['per_apellido']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <?php $vehi = consultas::get_datos("SELECT * FROM v_vehiculos ORDER BY id_vehiculo"); ?>
                                            <label>Vehiculo</label>
                                            <select class="form-control" name="vid_vehiculo">
                                                <?php if (!empty($vehi)) { ?>
                                                    <?php foreach ($vehi as $vehi) {
                                                        ?>
                                                        <option value="<?php echo $vehi['id_vehiculo']; ?>"><?php echo $vehi['veh_chapa'] . '-' . $vehi['mod_descri'] . '-' . $vehi['cv_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="sucu"><i></i>Sucursal Salida</label>
                                            <input type="text" class="form-control" id="sucu" value="<?php echo $_SESSION['sucursal'] ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <?php $destino = consultas::get_datos("SELECT * FROM ref_sucursal WHERE id_sucursal NOT IN(" . $_SESSION['id_sucursal'] . ")"); ?>
                                            <label>Sucursal Destino</label>
                                            <select class="form-control" name="vsucursal_entrada">
                                                <?php if (!empty($destino)) { ?>
                                                    <?php foreach ($destino as $dest) {
                                                        ?>
                                                        <option value="<?php echo $dest['id_sucursal']; ?>"><?php echo $dest['suc_nombre']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="box-footer">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-save"></i> Registrar</button>
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
