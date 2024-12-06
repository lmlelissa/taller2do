<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Modificar Pais</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
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
                                    <h3 class="box-title">Modificar Pais</h3>
                                    <div class="box-tools">
                                        <a href="pais_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form role="form" action="pais_control.php" method="POST">
                                    <div class="box-body">
                                        <?php $pais = consultas::get_datos("SELECT * FROM ref_pais WHERE id_pais=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion" value="2">
                                        <input type="hidden" name="vcodigo" value="<?php echo $pais[0]['id_pais']; ?>">
                                        <div class="form-group">
                                            <label for="input1">Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" id="input1" 
                                                   required="" value="<?php echo $pais[0]['pais_nombre']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-warning">
                                            <i class="fa fa-save"></i> Modificar
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