<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Desactivar Empleado</title>
        <?php
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-chevron-down"></i>
                                    <h3 class="box-title">Desactivar Empleado</h3>
                                    <div class="box-tools">
                                        <a href="emp_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="emp_control.php" method="POST" role="form">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_empleado WHERE id_empleado =" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vidempleado" value="<?php echo $resultado[0]['id_empleado']; ?>"/> 
                                        <input type="hidden" name="vidpersona" value="<?php echo $resultado[0]['id_persona']; ?>"/> 
                                        <input type="hidden" name="vidcargo" value="<?php echo $resultado[0]['id_cargo']; ?>"/> 
                                        <div class="form-group">
                                            <label>Persona</label>
                                            <input class="form-control" type="text" name="vidpersona1" required="" readonly="" value="<?php echo $resultado[0]['per_nombre'] . ' ' . $resultado[0]['per_apellido']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Cargo</label>
                                            <input class="form-control" type="text" name="vidcargo1" required="" readonly="" value="<?php echo $resultado[0]['car_descri']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-check-circle"></i> Desactivar
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