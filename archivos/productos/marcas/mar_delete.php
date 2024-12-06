<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Borrar Marca</title>
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Borrar Marca</h3>
                                    <div class="box-tools">
                                        <a href="mar_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="mar_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <?php $marcas = consultas::get_datos("SELECT * FROM ref_marcas WHERE id_marca=" . $_GET['vid']); ?>
                                            <input type="hidden" name="voperacion" value="3">
                                            <input type="hidden" name="vcodigo" value="<?php echo $marcas[0]['id_marca']; ?>">
                                            <label class="control-label col-sm-2 col-md-2 col-lg-2 col-xs-2">Nombre</label>
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8">
                                                <input class="form-control" type="text" name="vnombre" required="" readonly=""
                                                       value="<?php echo $marcas[0]['mar_descri']; ?>">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-remove"></i> Borrar
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