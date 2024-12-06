<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Detalle Presupuesto</title>
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
                            <div id="div_mensaje">

                            </div>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="pc_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $cab = consultas::get_datos("SELECT * FROM compras_presupuesto WHERE id_presupuesto=" . $_REQUEST['vidpc']);
                                        $consultadetalle = consultas::get_datos("SELECT * FROM compras_presupuesto_detalle WHERE id_presupuesto=" . $_REQUEST['vidpc']);
                                        if (!empty($consultadetalle)) {
                                            if ($cab[0]['pres_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="pc_confirmar.php?vid=<?php echo $_REQUEST['vidpc']; ?>" 
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
                                            $id = $_REQUEST['vidpc'];
                                            $vcompre = consultas::get_datos("SELECT * FROM v_compras_presupuesto WHERE id_presupuesto=" . $id);
                                            if (!empty($vcompre)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Pedido</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($vcompre AS $pc) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pc['id_presupuesto']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['fecdate']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['id_pedido']; ?></td>
                                                                    <td class="text-center"> <?php echo number_format($pc['pres_monto'], 0, '.', '.'); ?></td>
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
                                        $id = $_REQUEST['vidpc'];
                                        $pcdetalle = consultas::get_datos("SELECT * FROM v_compras_presupuesto_detalle WHERE id_presupuesto=$id");
                                        if (!empty($pcdetalle)) {
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
                                                            <?php if ($pc['pres_estado'] == 'PENDIENTE') { ?>
                                                                <th class="text-center">Acciones</th>    
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pcdetalle AS $prode) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $prode['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $prode['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $prode['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo number_format($prode['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($prode['subtotal'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($pc['pres_estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="editar(this)" data-datos2='<?= json_encode($prode); ?>'
                                                                           class="btn btn-sm btn-warning" rel='tooltip' data-title="Editar" 
                                                                           data-toggle="modal" data-target="#editar">
                                                                            <span class="glyphicon glyphicon-erase"></span>
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
                                            <button type="button" class="close" 
                                                    data-dismiss="modal" arial-label="Close">x</button>
                                            <h4 class="modal-title"><strong>Editar Presupuesto</strong></h4>
                                        </div>
                                        <div class="panel-body">
                                            <form action="pc_detalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal"> 
                                                <input name="voperacion" value="1" type="hidden"/>
                                                <input type="hidden" name="pagina" value="pc_detalle.php"> 
                                                <input type="hidden" name="vidpresu" id="vcod_pres">
                                                <input type="hidden" name="vproducto" id="vart">
                                                <input type="hidden" name="vdeposito" id="vdep">
                                                <input type="hidden" name="vcantidad" id="vcant">
                                                <input type="hidden" name="vprecio" id="vprecio">
                                                <input type="hidden" name="vsubtotal" id="vsubtotal">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-3">Precio Unitario:</label> 
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <input class="form-control" type="text" required="" name="vprecio" id="vprecio_edi" min='1'>
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
        <script src="../../funciones/funciones.js"></script>
        <script>
            function editar(datos) {
                var dat = $(datos).data('datos2');
                $('#vcod_pres').val(dat.id_presupuesto);
                $('#vart').val(dat.id_producto);
                $('#vdep').val(dat.id_deposito);
                $('#vcant').val(dat.cantidad);
                $('#vprecio_edi').val(dat.precio);
                $('#vsubtotal').val(dat.subtotal);
            }
        </script>
    </BODY>
</HTML>

