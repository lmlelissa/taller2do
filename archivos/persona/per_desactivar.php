<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Desactivar Persona</title>
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
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-angle-double-down"></i>
                                    <h3 class="box-title">Desactivar Persona</h3>
                                    <div class="box-tools">
                                        <a href="per_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="per_control.php" method="POST" role="form">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona =" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vidpersona" value="<?php echo $resultado[0]['id_persona']; ?>"/> 
                                        <input type="hidden" name="vidciudad" value="<?php echo $resultado[0]['id_ciudad']; ?>"/> 
                                        <input type="hidden" name="vemail" value="<?php echo $resultado[0]['per_email']; ?>"/> 
                                        <input type="hidden" name="vfechan" value="<?php echo $resultado[0]['fecha']; ?>"/> 
                                        <input type="hidden" name="vruc" value="<?php echo $resultado[0]['per_ruc']; ?>"/> 
                                        <input type="hidden" name="vtelefono" value="<?php echo $resultado[0]['per_telefono']; ?>"/> 
                                        <div class="form-group">
                                            <label >CI</label>
                                            <input class="form-control" type="text" name="vci" required="" readonly value="<?php echo $resultado[0]['per_ci']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" required="" readonly="" value="<?php echo $resultado[0]['per_nombre']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Apellido</label>
                                            <input class="form-control" type="text" name="vapellido" required="" readonly="" value="<?php echo $resultado[0]['per_apellido']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-minus-square"></i> Dar de baja
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