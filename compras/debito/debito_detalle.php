<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Detalle Nota</title>
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
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="debito_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $nota = $_REQUEST['vid_nota'];
                                        $ncab = consultas::get_datos("SELECT * FROM compras_debito WHERE id_nota=$nota");
                                        $nconsultadetalle = consultas::get_datos("SELECT * FROM v_compras_debito_detalle WHERE id_nota=$nota");
                                        if (!empty($nconsultadetalle)) {
                                            if ($ncab[0]['nc_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="debito_confirmar.php?vidnota=<?php echo $nota ?>" 
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
                                            $notac = consultas::get_datos("SELECT * FROM v_compras_debito WHERE id_nota=" . $nota);
                                            if (!empty($notac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>                       
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Comprobante</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notac AS $notacab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $notacab['id_nota']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['fecdate']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['prv_razonsocial']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['com_nro_factura']; ?></td>
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
                                        $notacdetalle = consultas::get_datos("SELECT * FROM v_compras_debito_detalle WHERE id_nota=$nota");
                                        if (!empty($notacdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">P.Unit</th>
                                                            <th class="text-center">Descuento</th>
                                                            <th class="text-center">Subtotal</th>
                                                            <th class="text-center">Exentas</th>
                                                            <th class="text-center">Iva 5%</th>
                                                            <th class="text-center">Iva 10%</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($notacdetalle AS $nc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $nc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $nc['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['descuento'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['subtotal'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['exentas'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['iva5'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['iva10'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($notacab['nc_estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="editar(this)" data-datos2='<?= json_encode($nc); ?>'
                                                                           class="btn btn-warning" rel='tooltip' data-title="Editar" 
                                                                           data-toggle="modal" data-target="#editar">
                                                                            <span class="fa fa-edit"></span>
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
                                                <span class="glyphicon glyphicon-info-sign"></span> No tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--DETALLE-->
                            <!--editar-->
                            <div id="editar" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                            <h4 class="modal-title"><strong>Descuento Nota de Debito</strong></h4>
                                        </div>
                                        <div class="panel-body">
                                            <form action="debito_detalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal"> 
                                                <input name="voperacion" value="1" type="hidden"/>
                                                <input type="hidden" name="vid_nota" id="vid_nota">
                                                <input type="hidden" name="vid_producto" id="vid_producto">
                                                <input type="hidden" name="vid_deposito" id="vid_deposito">
                                                <input type="hidden" name="vcantidad" id="vcantidad">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-2 col-sm-1 col-xs-1">Precio Unitario:</label> 
                                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                                        <input class="form-control" type="number" readonly="" name="vprecio" 
                                                               id="vprecio_real" style="width: 100px;">
                                                    </div>
                                                    <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1" style="position:relative;right:30px;">Descuento:</label> 
                                                    <div class="col-lg-3 col-md-5 col-sm-6 col-xs-6">
                                                        <input class="form-control" type="number" required="" name="vdescuento" min='0' style="width: 100px;" value="0">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" data-dismiss="modal" class="btn btn-danger pull-left">
                                                        <i class="fa fa-close "></i> Cerrar</button>
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-refresh"></i> Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--fin editar-->
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script>
            function editar(datos) {
                var dat = $(datos).data('datos2');
                $('#vid_nota').val(dat.id_nota);
                $('#vid_producto').val(dat.id_producto);
                $('#vid_deposito').val(dat.id_deposito);
                $('#vcantidad').val(dat.cantidad);
                $('#vprecio_desc').val(dat.precio);
                $('#vprecio_real').val(dat.precio);
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>