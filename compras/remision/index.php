<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Nota de Remision</title>
        <?php
        include '../../sesion_ver.php';
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
                            <div id="div_mensaje"></div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Nota de Remision</h3>
                                    <div class="box-tools">
                                        <a href="add.php" class="btn btn-success pull-right btn-sm" style="margin: 1px;">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consul = consultas::get_datos("SELECT * FROM v_nota_remision WHERE sucursal_salida=" . $_SESSION['id_sucursal'] . " ORDER BY id_nr");
                                            if (!empty($consul)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Chofer</th>
                                                                <th class="text-center">Chapa</th>
                                                                <th class="text-center">Destino</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consul AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_nr']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['fecdate']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['motivo_translado']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['persona']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['veh_chapa']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['destino']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['nr_estado']; ?></td>
                                                                    <td class="text-center">
                                                                        <form action="detalle.php" method="GET">
                                                                            <input type="hidden" value="<?php echo $p['id_nr']; ?>" name="vid_nr">
                                                                            <button type="submit" class="btn btn-sm btn-primary" rel='tooltip' data-title="Detalles">
                                                                                <span class="fa fa-list"></span>
                                                                            </button>
                                                                            <?php if ($p['nr_estado'] == 'PENDIENTE') { ?>
                                                                                <a href="edit.php?vid=<?php echo $p['id_nr']; ?>" 
                                                                                   class="btn btn-warning btn-sm" role="button"
                                                                                   data-title="Editar" rel="tooltip" data-placement="top">
                                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                                </a>  
                                                                                <a href="confirmar.php?vid=<?php echo $p['id_nr']; ?>" 
                                                                                   class="btn btn-success btn-sm" role="button"
                                                                                   data-title="Confirmar" rel="tooltip" data-placement="top">
                                                                                    <span class="glyphicon glyphicon-ok-sign"></span>
                                                                                </a>
                                                                            <?php } ?>
                                                                            <?php if ($p['nr_estado'] == 'CONFIRMADO') { ?>
                                                                                <a href="anular.php?vid=<?php echo $p['id_nr']; ?>" 
                                                                                   class="btn btn-danger btn-sm" role="button"
                                                                                   data-title="Anular" rel="tooltip" data-placement="top">
                                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                                </a>
                                                                                <a href="trasladar.php?vid=<?php echo $p['id_nr']; ?>" 
                                                                                   class="btn btn-default btn-sm" role="button"
                                                                                   data-title="Trasladar" rel="tooltip" data-placement="top">
                                                                                    <span class="fa fa-car"></span>
                                                                                </a>
                                                                            <?php } ?>
                                                                        </form>
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
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script>
            $(function () {
                $('#example1').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': false,
                    'autoWidth': true
                })
                $('#example2').DataTable();
            })
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>
