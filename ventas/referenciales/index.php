<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Referenciales</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Referenciales
                        <small>Ventas</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/sysmeli/menu.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li><a href="#">Ventas</a></li>
                        <li class="active">Referenciales</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <?php $cajas = consultas::get_datos("SELECT count(id_caja) AS cantidad FROM ref_cajas") ?>
                                    <a class="btn btn-app" href="/sysmeli/ventas/referenciales/cajas/index.php">
                                        <span class="badge bg-aqua"><?php echo $cajas[0]['cantidad']; ?></span>
                                        <i class="fa fa-money"></i> Cajas
                                    </a>
                                    <?php $clientes = consultas::get_datos("SELECT count(id_cliente) AS cantidad FROM ref_clientes") ?>
                                    <a class="btn btn-app" href="/sysmeli/ventas/referenciales/clientes/index.php">
                                        <span class="badge bg-purple"><?php echo $clientes[0]['cantidad']; ?></span>
                                        <i class="fa fa-users"></i> Clientes
                                    </a>
                                    <?php $timbrados = consultas::get_datos("SELECT count(id_tim) AS cantidad FROM ref_timbrados WHERE id_caja IN (SELECT id_caja FROM ref_cajas WHERE id_sucursal=" . $_SESSION['id_sucursal'] .")") ?>
                                    <a class="btn btn-app" href="/sysmeli/ventas/referenciales/timbrados/index.php">
                                        <span class="badge bg-yellow"><?php echo $timbrados[0]['cantidad']; ?></span>
                                        <i class="fa fa-bullhorn"></i> Timbrados
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
    </BODY>
</HTML>
