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
            <?php require './tools/aside.php'; ?>
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
                <section class="content">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <?php $ventas = consultas::get_datos("SELECT count(*) as totcompras FROM compras") ?>
                                    <h3><?= $ventas[0]['totcompras'] ?></h3>
                                    <p>Compras</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mas Info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                                    <p>Cobros Efectivo</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mas Info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <?php $usuarios = consultas::get_datos("SELECT count(*) as totusu FROM ref_usuarios") ?>
                                    <h3><?= $usuarios[0]['totusu'] ?></h3>
                                    <p>Usuario(s)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">Mas Info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                   <!-- Tarjeta de Ayuda -->
                   <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>?</h3>
                                    <p>Ayuda</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-question-circle"></i>
                                </div>
                                <a href="archivos/manuales/ayuda_manual.pdf" target="_blank" class="small-box-footer">
                                    Ver Manual <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require './tools/footer.php'; ?>
        </div>
        <?php require './tools/js.php'; ?>
    </body>
</html>