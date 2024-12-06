<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Detalles de Venta</title>
        <?php
        session_start();
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
                            <div id="div_mensaje">

                            </div>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Factura de Ventas</h3>
                                    <div class="box-tools">
                                        <a href="ventas_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $id = $_REQUEST['vid_venta'];
                                        $cab = consultas::get_datos("SELECT * FROM v_ventas_factura WHERE id_venta=$id");
                                        $consultadetalle = consultas::get_datos("SELECT * FROM v_ventas_factura_detalle WHERE id_venta=" . $_REQUEST['vid_venta']);
                                        if (!empty($consultadetalle)) {
                                            if ($cab[0]['estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="ventas_confirmar.php?vid_venta=<?= $_REQUEST['vid_venta']; ?>" 
                                                   class="btn btn-success btn-sm" role="button" data-title="Confirmar" rel="tooltip" data-placement="top"
                                                   style="margin-right:2px;">
                                                    <span class="fa fa-check"></span>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $ventascab = consultas::get_datos("SELECT * FROM v_ventas_factura WHERE id_venta=" . $id);
                                            if (!empty($ventascab)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°Factura</th>
                                                                <th class="text-center">Cliente</th> 
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($ventascab AS $vp) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?= $vp['nro_factura']; ?></td>
                                                                    <td class="text-center"> <?= $vp['cliente']; ?></td>
                                                                    <td class="text-center"> <?= number_format($vp['total'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> <?= $vp['estado']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--CABECERA--> 

                            <!--DETALLE-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Detalles</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $id = $_REQUEST['vid_venta'];
                                        $vpdetalle = consultas::get_datos("SELECT * FROM v_ventas_factura_detalle WHERE id_venta=$id");
                                        if (!empty($vpdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Concepto</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">Subtotal</th>
                                                            <th class="text-center">Iva 5</th>
                                                            <th class="text-center">Iva 10</th>
                                                            <th class="text-center">Exentas</th>
                                                            <?php if ($vp['estado'] == 'PENDIENTE') { ?>
                                                                <th class="text-center">Acciones</th>    
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($vpdetalle AS $fc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?= $fc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?= $fc['cantidad']; ?></td>
                                                                <td class="text-center"> <?= number_format($fc['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($fc['subtotal'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($fc['iva5'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($fc['iva10'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($fc['exenta'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($vp['estado'] == 'PENDIENTE') { ?>
                                                                        <?php if ($fc['ped'] == 'f') { ?>
                                                                            <a onclick="quitar(<?= "'" . $fc['id_venta'] . "_" . $fc['id_producto'] . "_" . $fc['id_deposito'] . "_" . $fc['pro_descri'] . "'"; ?>);"
                                                                               class="btn btn-danger btn-sm" role="button" data-title="Quitar"
                                                                               rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($fc['id_deposito'] == 0) { ?>
                                                                            <a onclick="agregar_deposito(this)" data-datos2='<?= json_encode($fc); ?>'
                                                                               class="btn btn-sm btn-success" rel='tooltip' data-title="Agregar Deposito" title="Agregar Deposito" 
                                                                               data-toggle="modal" data-target="#modal-deposito">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-danger flat">
                                                <span class="glyphicon glyphicon-info-sign"></span> No tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--DETALLE-->

                            <!--AGREGAR DETALLE-->
                            <?php if (!empty($vp)) { ?>
                                <?php if ($vp['estado'] == 'PENDIENTE') { ?>
                                    <div class="box box-success" style="width: 510px; height: 400px;margin: 0 auto;">
                                        <div class="box-header">
                                            <i class="ion ion-clipboard"></i>
                                            <h3 class="box-title">Agregar Detalle</h3>
                                        </div>
                                        <div class="box-body no-padding">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="ventas_detalle_control.php" method="GET" accept-charset="UTF-8">
                                                    <input type="hidden" name="vid_venta" value="<?= $_REQUEST['vid_venta']; ?>"/>
                                                    <input type="hidden" name="vid_cliente" id="vid_cliente" value="<?= $vp['id_cliente']; ?>"/>
                                                    <div class="box-body">
                                                        <input type="hidden" name="voperacion" value="1"/>
                                                        <div class="form-group">
                                                            <label >Deposito</label>
                                                            <?php $depos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_deposito>0 AND id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                            <select class="form-control select2" name="vid_deposito" required="">
                                                                <?php if (!empty($depos)) { ?>
                                                                    <?php foreach ($depos AS $dep) {
                                                                        ?>
                                                                        <option value="<?= $dep['id_deposito']; ?>"><?= $dep['dep_descri']; ?></option>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <option value="">Debe insertar registros...</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Producto</label>
                                                            <?php $prod = consultas::get_datos("SELECT * FROM v_ref_productos ORDER BY id_producto") ?>
                                                            <select class="form-control select2" name="vid_producto" required="">
                                                                <?php if (!empty($prod)) { ?>
                                                                    <option value="">Seleccione Producto</option>
                                                                    <?php
                                                                    foreach ($prod AS $pro) {
                                                                        ?>
                                                                        <option value="<?= $pro['id_producto']; ?>"><?= $pro['pro_descri'] . ' - ' . $pro['mar_descri']; ?></option>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <option value="">Debe insertar registros...</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cantidad</label>
                                                            <input class="form-control" type="number" min="1" name="vcantidad" value="1" max="100">
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-success">
                                                            <span class="fa fa-save"></span> Grabar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <!--AGREGAR DETALLE-->

                            <!-- MODAL DE QUITAR -->
                            <div class="modal fade" id="quitar" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
                                            <h4 class="modal-title custom_align" id="Heading">Atencion!!!</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger" id="confirmacion"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <a id="si" role="button" class="btn btn-success">
                                                <span class="glyphicon glyphicon-ok-sign"></span>Si
                                            </a>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <span class="glyphicon glyphicon-remove"></span>No
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL DE QUITAR -->
                            <!--MODAL DEPOSITO-->
                            <div class="modal fade" id="modal-deposito">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Agregar Deposito</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="ventas_detalle_control.php" method="GET">
                                                <input type="hidden" name="voperacion" value="3" >
                                                <input type="hidden" name="vid_venta" id="vid_venta1">
                                                <input type="hidden" name="vid_producto" id="vid_producto1">
                                                <input type="hidden" name="vcantidad" id="vcantidad1">
                                                <div class="form-group">
                                                    <label>Deposito</label>
                                                    <select class="form-control select2" style="width: 100%" name="vid_deposito" required="">
                                                        <?php
                                                        $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_deposito > 0 ORDER BY id_deposito");
                                                        if (!empty($depositos)) {
                                                            ?>
                                                            <?php foreach ($depositos AS $depo) { ?>
                                                                <option value="<?= $depo['id_deposito']; ?>"><?= $depo['dep_descri']; ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No existen deposito</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-warning" type="submit"> 
                                                        <i class="fa fa-save"></i> Guardar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--MODAL DEPOSITO-->
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script>
            function quitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'ventas_detalle_control.php?vid_venta=' + dat[0] + '&vid_producto=' + dat[1] + '&vid_deposito=' + dat[2] + '&vcantidad=0&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el registro del detalle <i><strong>' + dat[3] + '</strong></i>?');
            }
        </script>
        <script>
            function agregar_deposito(datos) {
                var dat = $(datos).data('datos2');
                $('#vid_venta1').val(dat.id_venta);
                $('#vid_producto1').val(dat.id_producto);
                $('#vcantidad1').val(dat.cantidad);
                $('#vprecio1').val(dat.precio);
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>