<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Editar Nota</title>
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
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Editar Nota de Remision</h3>
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
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vid_nr" value="<?php echo $notar[0]['id_nr']; ?>"/> 
                                        <input type="hidden" name="vnr_timbrado" value="<?php echo $notar[0]['nr_timbrado']; ?>"/> 
                                        <input type="hidden" name="vid_usuario" value="<?php echo $_SESSION['id_usuario'] ?>"/> 
                                        <input type="hidden" name="vnr_fecha" value="<?php echo $notar[0]['nr_fecha']; ?>"/> 
                                        <input type="hidden" name="vfecha_fin_translado" value="<?php echo $notar[0]['fecha_fin_translado']; ?>"/> 
                                        <input type="hidden" name="vsucursal_salida" value="<?php echo $_SESSION['id_sucursal'] ?>"/>
                                        <input type="hidden" name="vnr_estado" value="<?php echo $notar[0]['nr_estado']; ?>"/>
                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <select class="form-control" name="vmotivo_translado">
                                                <option>TRASLADO</option>
                                                <option>FALTA DE INSUMOS</option>
                                            </select>
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="finicio"><i class="fa fa-clock-o"></i>Inicio</label>
                                            <input type="datetime-local" class="form-control" id="finicio" name="vfecha_inicio_translado" required="" value="<?php echo $notar[0]['fecha_inicio_translado']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <?php $chofer = consultas::get_datos("SELECT * FROM v_empleados ORDER BY id_empleado=" . $notar[0]['id_empleado'] . " DESC"); ?>
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
                                            <?php $vehi = consultas::get_datos("SELECT * FROM v_vehiculos ORDER BY id_vehiculo=" . $notar[0]['id_vehiculo'] . " DESC"); ?>
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
                                            <?php $destino = consultas::get_datos("SELECT * FROM ref_sucursal WHERE id_sucursal NOT IN(" . $_SESSION['id_sucursal'] . ") ORDER BY id_sucursal=" . $notar[0]['sucursal_entrada'] . " DESC"); ?>
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
                                            <button class="btn btn-warning" type="submit">
                                                <i class="fa fa-edit"></i> Editar</button>
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
