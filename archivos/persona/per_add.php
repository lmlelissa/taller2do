<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Agregar Persona</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Persona</h3>
                                    <div class="box-tools">
                                        <a href="per_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="per_control.php" method="POST" role="form">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vidpersona" value="0"/> 
                                        <!--<input type="hidden" name="vcliente" value="<?php echo $_SESSION['id_cliente']; ?>"/> -->
                                        <div class="form-group">
                                            <label>CI</label>
                                            <input class="form-control" type="text" name="vci" required="" placeholder="Digite CI" maxlength="7" autofocus="">
                                        </div>
                                        <div class="form-group">
                                            <label>Nacimiento</label>
                                            <input class="form-control" type="date" name="vfechan" required="" max="<?= date("Y-m-d"); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" required="" placeholder="Ingrese Nombre">
                                        </div>
                                        <div class="form-group">
                                            <label >Apellido</label>
                                            <input class="form-control" type="text" name="vapellido" required="" placeholder="Ingrese Apellido">
                                        </div>
                                        <div class="form-group">
                                            <label>Ruc</label>
                                            <input class="form-control" type="text" name="vruc" required="" placeholder="Digite RUC" value="123456789-0" maxlength="11">
                                        </div>
                                        <div class="form-group">
                                            <label >Telefono</label>
                                            <input class="form-control" type="text" name="vtelefono" required="" placeholder="Ingrese Telefono" maxlength="10">
                                        </div>
                                        <div class="form-group">
                                            <label >Email</label>
                                            <input class="form-control" type="email" name="vemail" required="" placeholder="Ingrese correo"> 
                                        </div>
                                        <div class="form-group">
                                            <?php $ciudads = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad"); ?>
                                            <label >Ciudad</label>
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
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-save"> </i>  Registrar
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
