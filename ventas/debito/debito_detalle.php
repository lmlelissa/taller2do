<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Detalles</title>
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
                            <div id="div_mensaje"></div>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cabecera</h3>
                                    <div class="box-tools">
                                        <a href="debito_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $nota = $_REQUEST['vid_nota'];
                                        $ncab = consultas::get_datos("SELECT * FROM ventas_ndebito WHERE id_nota=$nota");
                                        $nconsultadetalle = consultas::get_datos("SELECT * FROM ventas_ndebito_detalle WHERE id_nota=$nota");
                                        if (!empty($nconsultadetalle)) {
                                            if ($ncab[0]['nd_estado'] == 'PENDIENTE') {
                                                if ($ncab[0]['nd_monto'] > 0) {
                                                    ?>
                                                    <a href="debito_confirmar.php?vidnota=<?= $nota ?>" 
                                                       class="btn btn-success btn-sm" role="button" data-title="Confirmar" rel="tooltip" data-placement="top"
                                                       style="margin-right:2px;">
                                                        <span class="glyphicon glyphicon-ok-sign"></span>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $notac = consultas::get_datos("SELECT * FROM v_ventas_ndebito WHERE id_nota=" . $nota);
                                            if (!empty($notac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>                       
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Factura</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notac AS $notacab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $notacab['id_nota']; ?></td>
                                                                    <td class="text-center"><?= $notacab['fecha1']; ?></td>
                                                                    <td class="text-center"><?= $notacab['cliente']; ?></td>
                                                                    <td class="text-center"><?= $notacab['nro_factura']; ?></td>
                                                                    <td class="text-center"><?= number_format($notacab['nd_monto'], 0, '.', '.'); ?></td>
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
                                        $notaddetalle = consultas::get_datos("SELECT * FROM v_ventas_ndebito_detalle WHERE id_nota=$nota");
                                        if (!empty($notaddetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Concepto</th>
                                                            <th class="text-center">Monto Concepto</th>
                                                            <th class="text-center">Monto a Cobrar</th>
                                                            <th class="text-center">Monto Final</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($notaddetalle AS $nd) { ?>
                                                            <tr><?php
                                                                if (!empty($nd['pro_descri'])) {
                                                                    $concepto = $nd['pro_descri'];
                                                                } else {
                                                                    $concepto = $nd['servi_descri'];
                                                                }
                                                                ?>
                                                                <td class="text-center"> <?= $concepto; ?></td>
                                                                <td class="text-center"> <?= number_format($nd['monto_concepto'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($nd['monto_descuento'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($nd['monto_final'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($notacab['nd_estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="editar(this)" data-datos2='<?= json_encode($nd); ?>'
                                                                           class="btn btn-sm btn-warning" rel='tooltip' data-title="A aplicar" 
                                                                           data-toggle="modal" data-target="#editar">
                                                                            <span class="fa fa-percent"></span>
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
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                                            <h4 class="modal-title"><strong>Agregar Costo</strong></h4>
                                        </div>
                                        <div class="panel-body">
                                            <form action="debito_detalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal"> 
                                                <input name="voperacion" value="1" type="hidden"/>
                                                <input type="hidden" name="vid_nota" id="vid_nota">
                                                <input type="hidden" name="vid_producto" id="vid_producto">
                                                <input type="hidden" name="vid_deposito" id="vid_deposito">
                                                <input type="hidden" name="vid_ser" id="vid_ser">
                                                <input type="hidden" name="vcantidad" id="vcantidad">
                                                <input type="hidden" name="vmonto_concepto" id="vmonto_concepto">
                                                <input type="hidden" name="vmonto_final" id="vmonto_final">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3">Monto Concepto:</label> 
                                                    <div class="col-lg-6">
                                                        <input class="form-control" type="text" required="" id="vmonto_ce" readonly="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-3">Monto a aplicar:</label> 
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <input class="form-control" type="number" required="" name="vmonto_descuento" value="0">
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
                            <!--FIN editar-->
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
                $('#vid_ser').val(dat.id_ser);
                $('#vcantidad').val(dat.cantidad);
                $('#vmonto_concepto').val(dat.monto_concepto);
                $('#vmonto_ce').val(dat.monto_concepto);
                $('#vmonto_descuento').val(dat.monto_descuento);
                $('#vmonto_final').val(dat.monto_final);
            }
            $("#mensaje").delay(2000).slideUp(200, function () {
                $(this).alert('close');
            });
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>