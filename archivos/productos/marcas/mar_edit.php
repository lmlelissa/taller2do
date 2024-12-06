<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Editar Marcas</title>
        <?php
        include '../../../sesion_ver.php';
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
                                    <h3 class="box-title">Modificar Marca</h3>
                                    <div class="box-tools">
                                        <a href="mar_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="mar_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $marcas = consultas::get_datos("SELECT * FROM ref_marcas WHERE id_marca=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion" value="2">
                                        <input type="hidden" name="vcodigo" value="<?php echo $marcas[0]['id_marca']; ?>">
                                        <div class="form-group">
                                            <label >Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" required="" value="<?php echo $marcas[0]['mar_descri']; ?>">
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