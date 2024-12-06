<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Empleados</title>
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
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Empleados</h3>
                                    <div class="box-tools">
                                        <a href="emp_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?php
                                            $empleados = consultas::get_datos("SELECT * FROM v_ref_empleado ORDER BY id_empleado");
                                            if (!empty($empleados)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example2" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Empleado</th>
                                                                <th class="text-center">Cargo</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($empleados AS $emple) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?= $emple['per_nombre'] . ' ' . $emple['per_apellido']; ?></td>
                                                                    <td class="text-center"> <?= $emple['car_descri']; ?></td>
                                                                    <td class="text-center"> <?= $emple['estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <?php if ($emple['estado'] == 'ACTIVO') { ?>
                                                                            <a href="emp_edit.php?vid=<?= $emple['id_empleado']; ?>" 
                                                                               class="btn btn-warning btn-sm" role="button"
                                                                               data-title="Editar Cargo" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-edit"></span>
                                                                            </a>                                                                            
                                                                            <a href="emp_desactivar.php?vid=<?= $emple['id_empleado']; ?>" 
                                                                               class="btn btn-danger btn-sm" role="button"
                                                                               data-title="Desactivar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <a href="emp_reactivar.php?vid=<?= $emple['id_persona']; ?>" 
                                                                               class="btn btn-success btn-sm" role="button"
                                                                               data-title="Reactivar" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-ok"></span>
                                                                            </a>                                             
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
                                <div class="box-footer">
                                    <?php $cargos = consultas::get_datos("SELECT count(id_cargo) AS cantidad FROM ref_cargos") ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script src="../../funciones/funciones.js"></script>
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
