<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Registrar Ciudad</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper" >
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Agregar Ciudad</h3>
                                    <div class="box-tools">
                                        <a href="ciudad_index.php" class="btn btn-danger btn-sm pull-right">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form role="form" action="ciudad_control.php" method="POST">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vcodigo" value="0">
                                        <input type="hidden" name="vpagina" value="ciudad_index.php">
                                        <div class="form-group">
                                            <label for="input1">Nombre</label>
                                            <input type="text" name="vnombre" class="form-control" id="input1" placeholder="Ingrese un Nombre" required="">
                                        </div>
                                        <div class="form-group">
                                            <?php $pais = consultas::get_datos("SELECT * FROM ref_pais ORDER BY id_pais;"); ?>                            
                                            <label for="select1">Pais</label>
                                            <select class="form-control select2" name="vpais"  required="" id="select1">
                                                <?php if (!empty($pais)) { ?>
                                                    <option value="">Seleccione Pais</option>
                                                    <?php
                                                    foreach ($pais as $pa) {
                                                        ?>
                                                        <option value="<?php echo $pa['id_pais']; ?>"> <?php echo $pa['pais_nombre']; ?> </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">No se encuentran Empleados!!!</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus"></i> Registrar
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