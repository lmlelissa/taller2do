<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Editar Tipo</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Modificar Tipo de Producto</h3>
                                    <div class="box-tools">
                                        <a href="tp_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="tp_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $tipo = consultas::get_datos("SELECT * FROM ref_tipo_producto WHERE id_tipo=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion" value="2">
                                        <input type="hidden" name="vcodigo" value="<?php echo $tipo[0]['id_tipo']; ?>">
                                        <div class="form-group">
                                            <label >Nombre</label>
                                                <input class="form-control" type="text" name="vnombre" required="" value="<?php echo $tipo[0]['tip_descri']; ?>">
                                        </div> 
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-warning" type="submit">
                                            <i class="fa fa-edit"></i> Modificar
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