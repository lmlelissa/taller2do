<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Ref. Compras</title>
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
                        <small>Compras</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/sysmeli/menu.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li><a href="#">Compras</a></li>
                        <li class="active">Referenciales</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <?php $prv = consultas::get_datos("SELECT count(id_proveedor) AS cantidad FROM ref_proveedor") ?>
                                    <a class="btn btn-app" href="/sysmeli/compras/referenciales/proveedor/prv_index.php">
                                        <span class="badge bg-purple"><?php echo $prv[0]['cantidad']; ?></span>
                                        <i class="fa fa-users"></i> Proveedores
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
