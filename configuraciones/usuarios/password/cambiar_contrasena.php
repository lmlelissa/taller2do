<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Sistema | Cambiar Password</title>
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
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Cambiar Contraseña</h3>
                                    <div class="box-tools">

                                    </div>
                                </div>
                                <form action="pass_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vpagina"  value="cambiar_contrasena.php">
                                        <input type="hidden" name="vusuario"  value="<?php echo $_SESSION['id_usuario'] ?>">
                                        <div class="form-group">
                                            <div class="col-sm-5 col-lg-5 col-md-5 col-xs-5">
                                                <label class="control-label">Usuario</label>
                                                <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-5 col-lg-5 col-md-5 col-xs-5">
                                                <label class="control-label">Anterior</label>
                                                <input class="form-control" type="password" name="vusupassold" required="" placeholder="Ingrese Contraseña Anterior">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-5 col-lg-5 col-md-5 col-xs-5">
                                            <label class="control-label">Nueva</label>
                                                <input class="form-control" type="text" name="vusupassnew" required="" placeholder="Ingrese Contraseña Nueva">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-save"></i> Guardar
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
        <script src="../../../funciones/funciones.js"></script>
    </BODY>
</HTML>
