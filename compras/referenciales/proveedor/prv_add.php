<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Agregar Proveedor</title>
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
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Proveedor</h3>
                                    <div class="box-tools">
                                        <a href="prv_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="prv_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vidproveedor" value="0"/> 
                                        <div class="form-group">
                                            <label>Ruc</label>
                                            <input class="form-control" type="text" name="vruc" required="" placeholder="Digite RUC">
                                        </div>
                                        <div class="form-group">
                                            <label>Razon Soc.</label>
                                            <input class="form-control" type="text" name="vrazon" required="" placeholder="Ingrese Razon Social">
                                        </div>
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input class="form-control" type="text" name="vdireccion" required="" placeholder="Digite Direccion">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input class="form-control" type="text" name="vtelefono" required="" placeholder="Ingrese Telefono" maxlength="10">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="vemail" required="" placeholder="Ingrese correo"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Ciudad</label>
                                            <?php $ciudads = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                            <select class="form-control select2" name="vidciudad" required="">
                                                <?php
                                                if (!empty($ciudads)) {
                                                    foreach ($ciudads as $ciu) {
                                                        ?>
                                                        <option value="<?php echo $ciu['id_ciudad']; ?>"><?php echo $ciu['ciu_nombre']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
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
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
    </BODY>
</HTML>
