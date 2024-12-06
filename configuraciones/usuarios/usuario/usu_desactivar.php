<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Desactivar Empleado</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-chevron-down"></i>
                                    <h3 class="box-title">Desactivar Usuario</h3>
                                    <div class="box-tools">
                                        <a href="usu_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="usu_control.php" method="POST" role="form">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_empleado WHERE id_empleado =" . $_GET['vid_usuario']); ?>
                                        <?php $usuarioo = consultas::get_datos("SELECT * FROM v_ref_usuarios WHERE id_usuario =" . $_GET['vid_usuario']); ?>
                                        <input type="hidden" name="vid_empleado" value="<?php echo $resultado[0]['id_empleado']; ?>"/> 
                                        <input type="hidden" name="vidpersona" value="<?php echo $resultado[0]['id_persona']; ?>"/> 
                                        <input type="hidden" name="vidcargo" value="<?php echo $resultado[0]['id_cargo']; ?>"/> 
                                        <input type="hidden" name="vusu_foto" value="<?php echo $usuarioo[0]['usu_foto']; ?>"/> 
                                        <input type="hidden" name="vusu_nick" value="<?php echo $usuarioo[0]['usu_nick']; ?>"/> 
                                        <input type="hidden" name="vusu_clave" value="<?php echo $usuarioo[0]['usu_clave']; ?>"/> 
                                        <input type="hidden" name="vid_perfil" value="<?php echo $usuarioo[0]['id_perfil']; ?>"/> 
                                        <input type="hidden" name="vid_sucursal" value="<?php echo $usuarioo[0]['id_sucursal']; ?>"/> 
                                        <input type="hidden" name="voperacion" value="2">
                                        <input type="hidden" name="vid_usuario" value="<?php echo $usuarioo[0]['id_usuario']; ?>"/> 
                                        <input type="hidden" name="vusu_estado" value="BLOQUEADO">
                                        <input type="hidden" name="vusuario" value="<?= $_SESSION['id_usuario']?>">
                                        
                                        <div class="form-group">
                                            <label>Persona</label>
                                            <input class="form-control" type="text" name="vidpersona1" required="" readonly="" value="<?php echo $resultado[0]['per_nombre'] . ' ' . $resultado[0]['per_apellido']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Cargo</label>
                                            <input class="form-control" type="text" name="vidcargo1" required="" readonly="" value="<?php echo $resultado[0]['car_descri']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
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
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
    </BODY>
</HTML>