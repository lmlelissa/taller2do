<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Libro IVA </title>
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Libro IVA</h3>
                                    <div class="box-tools">

                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $consultagral = consultas::get_datos("SELECT * FROM v_compras_libro WHERE id_sucursal=" . $_SESSION['id_sucursal'] . " ORDER BY id_libro");
                                            if (!empty($consultagral)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Compra</th>
                                                                <th class="text-center">Nro Factura</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Iva 5</th>
                                                                <th class="text-center">Iva 10</th>
                                                                <th class="text-center">Exentas</th>
                                                                <th class="text-center">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($consultagral AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['id_libro']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['id_compra']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['com_nro_factura']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['prv_razonsocial']; ?></td>
                                                                    <td class="text-center"> <?php echo number_format($p['total_iva5'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> <?php echo number_format($p['total_iva10'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> <?php echo number_format($p['total_exenta'], 0, '.', '.'); ?></td>                                                            
                                                                    <td class="text-center"> <?php echo $p['lib_estado']; ?></td>
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
