<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Modificar Ciudad</title>
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
                                    <h3 class="box-title">Modificar Ciudad</h3>
                                    <div class="box-tools">
                                        <a href="ciudad_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form role="form" action="ciudad_control.php" method="POST">
                                    <div class="box-body">
                                        <?php $ciudad = consultas::get_datos("SELECT * FROM v_ciudad WHERE id_ciudad=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion" value="2">
                                        <input type="hidden" name="vpagina" value="ciudad_index.php">
                                        <input type="hidden" name="vcodigo" value="<?php echo $ciudad[0]['id_ciudad']; ?>">
                                        <div class="form-group">
                                            <label for="input1">Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" id="input1" 
                                                   required="" value="<?= $ciudad[0]['ciu_nombre']; ?>">
                                        </div>
                                        <?php $pais = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais=" . $ciudad[0]['id_pais'] . " DESC"); ?>    
                                        <div class="form-group">
                                            <label for="select1">Pais</label>
                                            <select class="form-control select2" name="vpais"  required="" id="select1">
                                                <?php if (!empty($pais)) { ?>
                                                    <?php
                                                    foreach ($pais as $pa) {
                                                        ?>
                                                        <option value="<?= $pa['id_pais']; ?>"> <?= $pa['pais_nombre']; ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-warning" type="submit">
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