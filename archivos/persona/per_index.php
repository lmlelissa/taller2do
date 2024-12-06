<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Personas</title>
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
                        <div class="col-xs-12">
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">Personas</h3>
                                    <div class="box-tools">
                                        <a href="per_add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php
                                    $productos = consultas::get_datos("SELECT * FROM v_ref_persona ORDER BY id_persona LIMIT 100");
                                    if (!empty($productos)) {
                                        ?>
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nombres</th>
                                                    <th class="text-center">Nacimiento</th>
                                                    <th class="text-center">CI</th>
                                                    <th class="text-center">Ciudad</th>
                                                    <th class="text-center">Telefono</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody  class="text-center">
                                                <?php foreach ($productos AS $p) { ?>
                                                    <tr>
                                                        <td class="text-center"> <?= $p['per_nombre'] . ' ' . $p['per_apellido']; ?></td>
                                                        <td class="text-center"> <?= $p['fecha']; ?></td>
                                                        <td class="text-center"> <?= $p['per_ci']; ?></td>
                                                        <td class="text-center"> <?= $p['ciu_nombre']; ?></td>
                                                        <td class="text-center"> <?= $p['per_telefono']; ?></td>
                                                        <td class="text-center"> <?= $p['per_estado']; ?></td>
                                                        <td class="text-center">
                                                            <?php if ($p['per_estado'] == 'ACTIVO') { ?>
                                                                <a href="per_edit.php?vid=<?= $p['id_persona']; ?>" 
                                                                   class="btn btn-warning btn-sm" role="button"
                                                                   data-title="Editar" rel="tooltip" data-placement="top">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                                <a href="per_desactivar.php?vid=<?= $p['id_persona']; ?>" 
                                                                   class="btn btn-danger btn-sm" role="button"
                                                                   data-title="Desactivar" rel="tooltip" data-placement="top">
                                                                    <i class="fa fa-minus-square"></i>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="per_reactivar.php?vid=<?= $p['id_persona']; ?>" 
                                                                   class="btn btn-success btn-sm" role="button"
                                                                   data-title="Reactivar" rel="tooltip" data-placement="top">
                                                                    <span class="glyphicon glyphicon-ok"></span>
                                                                </a>                                             
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">Nombres</th>
                                                    <th class="text-center">Nacimiento</th>
                                                    <th class="text-center">CI</th>
                                                    <th class="text-center">Ciudad</th>
                                                    <th class="text-center">Telefono</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script src="../../funciones/funciones.js"></script>
        <script>
            $(function () {
                $('#example1').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'autoWidth': false
                })
            })
        </script>
    </BODY>
</HTML>
