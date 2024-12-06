<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Compra Detalle</title>
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
                            <div id="div_mensaje"></div>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Compra</h3>
                                    <div class="box-tools">
                                        <a href="compras_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $compra = $_REQUEST['vidcompra'];
                                        $cab = consultas::get_datos("SELECT * FROM compras WHERE id_compra=$compra");
                                        $consultadetalle = consultas::get_datos("SELECT * FROM v_compras_detalle WHERE id_compra=$compra");
                                        if (!empty($consultadetalle)) {
                                            if ($cab[0]['com_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="compras_confirmar.php?vid=<?php echo $compra ?>" 
                                                   class="btn btn-success btn-sm" role="button" data-title="Confirmar" rel="tooltip" data-placement="top"
                                                   style="margin-right:2px;">
                                                    <span class="glyphicon glyphicon-ok-sign"></span>
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
                                            $comprac = consultas::get_datos("SELECT * FROM v_compras WHERE id_compra=" . $compra);
                                            if (!empty($comprac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <?php if (!empty($comprac[0]['id_orden'])) { ?>
                                                                    <th class="text-center">Orden</th>
                                                                <?php } ?>                          
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Iva</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($comprac AS $compracab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $compracab['id_compra']; ?></td>
                                                                    <?php if (!empty($comprac[0]['id_orden'])) { ?>
                                                                        <td class="text-center"><?php echo $compracab['id_orden']; ?></td>
                                                                    <?php } ?> 
                                                                    <td class="text-center"><?php echo $compracab['fecdate']; ?></td>
                                                                    <td class="text-center"><?php echo number_format($compracab['com_total_iva'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"><?php echo number_format($compracab['com_total'], 0, '.', '.'); ?></td>
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
                                        $cdetalle = consultas::get_datos("SELECT * FROM v_compras_detalle WHERE id_compra=$compra");
                                        if (!empty($cdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">Subtotal</th>
                                                            <th class="text-center">Iva 5</th>
                                                            <th class="text-center">Iva 10</th>
                                                            <th class="text-center">Exentas</th>
                                                            <?php if ($compracab['com_estado'] == 'PENDIENTE') { ?>
                                                                <th class="text-center">Acciones</th>    
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cdetalle AS $c) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $c['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $c['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $c['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo number_format($c['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($c['subtotal'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($c['iva5'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($c['iva10'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($c['exenta'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($compracab['com_estado'] == 'PENDIENTE') { ?>
                                                                        <?php if (empty($c['ord'])) { ?>
                                                                            <a onclick="quitar(<?= "'" . $c['id_compra'] . "_" . $c['id_producto'] . "_" . $c['pro_descri'] . "_" . $c['id_deposito'] . "'"; ?>);"
                                                                               class="btn btn-danger btn-sm" role="button" data-title="Quitar"
                                                                               rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
                                                                                <i class="fa fa-times"></i>
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
                            <?php if ($compracab['com_estado'] == 'PENDIENTE') { ?>
                                <div class="box box-primary" style="width: 510px; height: 400px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Detalle</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="compras_detalle_control.php" method="POST" accept-charset="UTF-8">
                                                <div class="box-body">
                                                    <input type="hidden" name="voperacion" value="1"/>
                                                    <input type="hidden" name="vidcompra" value="<?= $compra; ?>"/>
                                                    <div class="form-group">
                                                        <label >Producto</label>
                                                        <?php $prod = consultas::get_datos("SELECT * FROM ref_producto WHERE id_producto NOT IN(SELECT id_producto FROM compras_detalle WHERE id_compra=" . $compra . ") ORDER BY id_producto"); ?>
                                                        <select class="form-control select2" name="vidproducto" required="">
                                                            <?php if (!empty($prod)) { ?>
                                                                <?php
                                                                foreach ($prod AS $pro) {
                                                                    ?>
                                                                    <option value="<?php echo $pro['id_producto']; ?>"><?php echo $pro['pro_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">NO HAY PRODUCTOS DISPONIBLES!!!</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Deposito</label>
                                                        <?php $depo = consultas::get_datos("SELECT * from ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']); ?>
                                                        <select class="form-control select2" name="viddeposito" required="">
                                                            <?php if (!empty($depo)) { ?>
                                                                <?php
                                                                foreach ($depo AS $dep) {
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
                                                        <label >Cantidad</label>
                                                        <input class="form-control" type="number" min="1" name="vcantidad" value="1" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Precio</label>
                                                        <input class="form-control" type="number" min="1" name="vprecio" value="1000" required="">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="submit" class="btn btn-success center-block">
                                                        <span class="glyphicon glyphicon-plus"></span> Agregar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                            <a id="si" role="button" class="btn btn-primary">
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
            function quitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'compras_detalle_control.php?vidcompra=' + dat[0] + '&vidproducto=' + dat[1] + '&viddeposito=' + dat[3] + '&vcantidad=0&vprecio=0&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el registro del detalle <i><strong>' + dat[2] + '</strong></i>?');
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>
