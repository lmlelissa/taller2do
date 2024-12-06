<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Borrar Ciudad</title>
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
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Borrar Ciudad</h3>
                                    <div class="box-tools">
                                        <a href="ciudad_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form role="form" action="ciudad_control.php" method="POST">
                                    <div class="box-body">
                                        <?php $ciudad = consultas::get_datos("SELECT * FROM v_ciudad WHERE id_ciudad=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion" value="3">
                                        <input type="hidden" name="vpagina" value="ciudad_index.php">
                                        <input type="hidden" name="vcodigo" value="<?php echo $ciudad[0]['id_ciudad']; ?>">
                                        <input type="hidden" name="vpais" value="<?php echo $ciudad[0]['id_pais']; ?>">
                                        <div class="form-group">
                                            <label for="input1">Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" id="input1" required="" readonly=""
                                                   value="<?php echo $ciudad[0]['ciu_nombre']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="input2">Pais</label>
                                            <input class="form-control" type="text" id="input2" required="" readonly=""
                                                   value="<?php echo $ciudad[0]['pais_nombre']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-trash"></i> Borrar
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