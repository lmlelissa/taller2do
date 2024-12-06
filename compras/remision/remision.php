<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Remision</title>
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
                                    <h3 class="box-title">Remision de  Productos</h3>
                                    <div class="box-tools">

                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consul = consultas::get_datos("SELECT * FROM v_nota_remision WHERE sucursal_entrada=" . $_SESSION['id_sucursal'] . " ORDER BY id_nr");
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
                                                                <?php if ($consul[0]['nr_estado'] == 'TRASLADANDO') { ?>
                                                                    <th class="text-center">Acciones</th>
                                                                <?php } ?>
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
                                                                    <?php if ($p['nr_estado'] == 'TRASLADANDO') { ?>
                                                                        <td class="text-center">
                                                                            <?php if ($p['nr_estado'] == 'TRASLADANDO') { ?>
                                                                                <a href="remision_detalle.php?vid_nr=<?php echo $p['id_nr']; ?>" 
                                                                                   class="btn btn-primary btn-sm" role="button"
                                                                                   data-title="Detalle" rel="tooltip" data-placement="top">
                                                                                    <span class="fa fa-list"></span>
                                                                                </a>
                                                                                <a href="confirmar_remision.php?vid=<?php echo $p['id_nr']; ?>" 
                                                                                   class="btn btn-success btn-sm" role="button"
                                                                                   data-title="Confirmar Remision" rel="tooltip" data-placement="top">
                                                                                    <span class="glyphicon glyphicon-ok-sign"></span>
                                                                                </a>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php } ?>
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