<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registrar Usuario</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Usuario</h3>
                                    <div class="box-tools">
                                        <a href="usu_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <form action="usu_control.php" method="GET">
                                        <input type="hidden" name="voperacion" value="1">
                                        <input type="hidden" name="vid_usuario" value="0">
                                        <input type="hidden" name="vusu_estado" value="ACTIVO">
                                        <input type="hidden" name="vusuario" value="<?= $_SESSION['id_usuario']?>">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Empleado</label>
                                                <select class="form-control select2" style="width: 100%;" name="vid_empleado" required="" autofocus="">
                                                    <?php
                                                    $emple = consultas::get_datos("SELECT * FROM v_ref_empleado WHERE id_empleado not in (select id_empleado from ref_usuarios)ORDER BY id_empleado");
                                                    if (!empty($emple)) {
                                                        ?>
                                                        <option value="">Seleccione un registro</option>
                                                        <?php foreach ($emple AS $emp) {
                                                            ?>
                                                            <option value="<?= $emp['id_empleado']; ?>"><?= $emp['persona']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">No existen registros!!!</option>     
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Perfil</label>
                                                <select class="form-control select2" style="width: 100%;" name="vid_perfil" required="" autofocus="">
                                                    <?php
                                                    $perfil = consultas::get_datos("SELECT * FROM ref_perfiles ORDER BY id_perfil");
                                                    if (!empty($perfil)) {
                                                        ?>
                                                        <option value="">Seleccione un registro</option>
                                                        <?php foreach ($perfil AS $perfils) {
                                                            ?>
                                                            <option value="<?= $perfils['id_perfil']; ?>"><?= $perfils['perf_nombre']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">No existen registros!!!</option>     
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Sucursal</label>
                                                <select class="form-control select2" style="width: 100%;" name="vid_sucursal" required="" autofocus="">
                                                    <?php
                                                    $sucursal = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal");
                                                    if (!empty($sucursal)) {
                                                        ?>
                                                        <option value="">Seleccione un registro</option>
                                                        <?php foreach ($sucursal AS $sucursals) {
                                                            ?>
                                                            <option value="<?= $sucursals['id_sucursal']; ?>"><?= $sucursals['suc_nombre']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">No existen registros!!!</option>     
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="vusu_nick">Nick</label>
                                                <input type="text" name="vusu_nick" id="vusu_nick" class="form-control" placeholder="Ingrese un Nick" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="vusu_clave">Clave</label>
                                                <input type="text" name="vusu_clave" id="vusu_clave" class="form-control" placeholder="Ingrese Clave" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="vusu_foto">Foto</label>
                                                <input type="file" name="vusu_foto" id="vusu_foto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-success" type="submit" style="position: relative;left: 330px;">
                                                <i class="fa fa-plus"></i> Registrar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
