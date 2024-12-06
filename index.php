<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema | Login</title>
        <link rel="shortcut icon" href="/sysmeli/dist/img/icono.png">
        <?php
        session_start();
        include './conexion.php';
        if ($_SESSION) {
            session_destroy();
        }
        ?>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/sysmeli/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/sysmeli/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/sysmeli/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/sysmeli/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/sysmeli/plugins/iCheck/square/blue.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="/sysmeli/bower_components/select2/dist/css/select2.min.css">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box"  style=" margin: 0;padding: 0; position: relative; left: 500px;">
            <div class="login-logo">
                <a href="/sysmeli/index.php"><b>ESQMEL</b>Tech</a>
            </div>
            <div class="login-box-body">
                <div class="panel-heading badge center-block">
                    <img width="180" height="180" src="/sysmeli/dist/img/icono1.jpg" />
                </div>
                <br>
                <?php if (!empty($_SESSION['mensaje'])) { ?>
                    <div class="alert alert-danger" role="alert" id="div_mensaje">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <?php echo $_SESSION['mensaje']; ?>
                    </div>
                <?php } ?>
                <form action="/sysmeli/acceso.php" method="post" style="height: 180px;">
                    <div class="form-group has-feedback">
                        <input type="text" name="vusuario" class="form-control" placeholder="Usuario" required="">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="vpass" class="form-control" placeholder="Contraseña" required="">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <?php $sucu = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal"); ?>         
                        <select class="form-control select2" style="width: 100%;font-size: 12px;" name="vsucursal">
                            <?php
                            if (!empty($sucu)) {
                                foreach ($sucu as $suc) {
                                    ?>
                                    <option value="<?= $suc['id_sucursal']; ?>"> <?= 'SUCURSAL ' . $suc['suc_nombre']; ?> </option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="">No existen registros</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn- btn-block btn-block">Acceder</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- jQuery 3 -->
        <script src="/sysmeli/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="/sysmeli/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="/sysmeli/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
            $("#div_mensaje").delay(2000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
    </body>
</html>
