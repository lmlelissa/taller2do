<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Agregar Pais</title>
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Agregar Pais</h3>
                                    <div class="box-tools">
                                        <a href="pais_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form role="form" action="pais_control.php" method="POST">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vcodigo" value="0">
                                        <div class="form-group">
                                            <label for="input1">Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" id="input1" required="" autofocus="">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-save"></i> Registrar
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