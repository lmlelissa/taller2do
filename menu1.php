<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema | Menu</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        require './tools/css.php';
        require './conexion.php';
        ?>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require './tools/header.php'; ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1 style="font-size: 18px;">
                        Bienvenido/a <?= $_SESSION['nombres'] ?>
                        <small style="font-size: 15px;">Menu Principal</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> SYS</a></li>
                        <li class="active">Menu</li>
                    </ol>
                </section>
                <div class="box box-primary">
                      <div id="div_mensaje">

                            </div>
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Cambiar Contraseña</h3>
                                    <div class="box-tools">

                                    </div>
                                </div>
                                <form action="pass_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="4">
                                        <input type="hidden" name="vpagina"  value="">
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
            <?php require './tools/footer.php'; ?>
        </div>
        <?php require './tools/js.php'; ?>
    </body>
</html>
