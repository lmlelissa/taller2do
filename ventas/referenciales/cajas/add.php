<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registrar Caja</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Caja</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="controlador.php" method="POST" accept-charset="UTF-8" role="form">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_caja" value="0"/> 
                                        <input type="hidden" name="vestado" value="CERRADA"/>
                                        <div class="form-group has-success">
                                            <label class="control-label" for="vdescripcion"><i class="fa fa-check"></i>Descripcion</label>
                                            <input type="text" class="form-control" id="vdescripcion" placeholder="Ingrese Descripcion..." name="vdescripcion" required="">
                                        </div>
                                        <div class="form-group has-warning">
                                            <?php $suc = consultas::get_datos("SELECT * FROM ref_sucursal WHERE id_sucursal=" . $_SESSION['id_sucursal']); ?>
                                            <label class="control-label"><i class="fa fa-check"></i>Sucursal</label>
                                            <select class="form-control" name="vid_sucursal">
                                                <?php if (!empty($suc)) { ?>
                                                    <?php foreach ($suc as $su) {
                                                        ?>
                                                        <option value="<?php echo $su['id_sucursal']; ?>"><?php echo $su['suc_nombre']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="box-footer" style="text-align: center;">
                                            <button class="btn btn-success" type="submit">Registrar
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
