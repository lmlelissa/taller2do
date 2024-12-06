<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Empleados</title>
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
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Usuarios</h3>
                                    <div class="box-tools">
                                        <a href="usu_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?php
                                            $usuario = $_SESSION['id_usuario'];
                                            $consulta = consultas::get_datos("SELECT * FROM v_ref_usuarios where id_usuario <> $usuario ORDER BY id_usuario");
                                        if (!empty($consulta)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example2" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                        <th>Empleado</th>
                                                        <th>Usuario</th>
                                                        <th>Cargo</th>
                                                        <th>Foto</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php foreach ($consulta as $usuario) { ?>
                                                        <tr class="text-center">
                                                            <td><?= $usuario['id_usuario'] ?></td>
                                                            <td><?= $usuario['nombres'] ?></td>
                                                            <td><?= $usuario['usu_nick'] ?></td>
                                                            <td><?= $usuario['perf_nombre'] ?></td>
                                                            <td><img src="<?= $usuario['usu_foto'] ?>" width="50px" height="50px"/></td>
                                                            <td><?= $usuario['usu_estado'] ?></td>
                                                            <td>
                                                                <?php if ($usuario['usu_estado'] == 'ACTIVO') { ?>
                                                                    <a href="usu_desactivar.php?vid_usuario=<?= $usuario['id_usuario']; ?>"  
                                                                   class="btn btn-danger btn-sm" role="button"
                                                                   data-title="Desactivar" rel="tooltip" data-placement="top">
                                                                    <i class="fa fa-minus-square"></i>
                                                                    </a>
                                                                    
                                                                <?php } ?>
                                                                <?php if ($usuario['usu_estado'] == 'BLOQUEADO') { ?>
                                                                    <a href="usu_reactivar.php?vid_usuario=<?= $usuario['id_usuario']; ?>"  
                                                                   class="btn btn-success btn-sm" role="button"
                                                                   data-title="Reactivar" rel="tooltip" data-placement="top">
                                                                    <span class="glyphicon glyphicon-ok"></span>
                                                                </a>  
                                                                <?php } ?>
                                                                <?php if ($usuario['usu_estado'] == 'ACTIVO') { ?>
                                                                   
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>   
                                                </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-danger flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han encontrado registros...
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
        <script src="../../../funciones/funciones.js"></script>
        <script>
            $(function () {
                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'autoWidth': true
                })
            })
        </script>
    </BODY>
</HTML>
