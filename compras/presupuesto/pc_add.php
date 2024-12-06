<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Agregar Presupuesto</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
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
                                    <h3 class="box-title">Agregar Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="pc_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="pc_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vpresupuesto" value="0"/>
                                        <input type="hidden" name="vsucursal" value="<?= $_SESSION['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vusuario" value="<?= $_SESSION['id_usuario']; ?>"/>
                                        <input type="hidden" name="vmonto" value="0"/>
                                        <input type="hidden" name="vestado" value="PENDIENTE"/>

                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" name="vfecha" readonly="" value="<?= $fechaActual; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Pedido</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $_GET['vidped']; ?>" name="vpedido">
                                        </div>
                                        <div class="form-group">
                                            <label >Usuario</label>
                                            <input class="form-control" type="text" readonly="" value="<?= $_SESSION['nombres']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Validez</label>
                                            <input class="form-control" type="number" name="vvalidez"placeholder="Digite la validez" required="" min="0" max="7" value="7"/>
                                        </div>
                                        <div class="form-group">
                                            <label >Proveedor</label>
                                            <?php $prvs = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY id_proveedor"); ?>
                                            <select class="form-control select2" name="vproveedor" required="">
                                                <?php
                                                if (!empty($prvs)) {
                                                    foreach ($prvs as $prv) {
                                                        ?>
                                                        <option value="<?= $prv['id_proveedor']; ?>">
                                                            <?= $prv['prv_razonsocial']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">NO EXISTEN REGISTROS</option>             
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
                    'autoWidth': true
                })
                $('#example2').DataTable();
            })
        </script>
    </BODY>
</HTML>