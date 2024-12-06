<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Orden Detalle</title>
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Orden</h3>
                                    <div class="box-tools">
                                        <a href="orden_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $orden = $_REQUEST['vidord'];
                                        $cab = consultas::get_datos("SELECT * FROM compras_orden WHERE id_orden=$orden");
                                        $consultadetalle = consultas::get_datos("SELECT * FROM v_compras_orden_detalle WHERE id_orden=$orden");
                                        if (!empty($consultadetalle)) {
                                            if ($cab[0]['ord_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="orden_confirmar.php?vid=<?php echo $orden ?>" 
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
                                            $ordenc = consultas::get_datos("SELECT * FROM v_compras_orden WHERE id_orden=" . $orden);
                                            if (!empty($ordenc)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($ordenc AS $ordencab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $ordencab['id_orden']; ?></td>
                                                                    <td class="text-center"><?php echo $ordencab['fecdate']; ?></td>
                                                                    <td class="text-center"><?php echo number_format($ordencab['ord_total'], 0, '.', '.'); ?></td>
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
                                        $ocdetalle = consultas::get_datos("SELECT * FROM v_compras_orden_detalle WHERE id_orden=$orden");
                                        if (!empty($ocdetalle)) {
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
                                                            <?php if ($ordencab['ord_estado'] == 'PENDIENTE') { ?>
                                                                <?php if (empty($oc[0]['ped'])) { ?>
                                                                    <th class="text-center">Acciones</th>    
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($ocdetalle AS $oc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $oc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $oc['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $oc['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo number_format($oc['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($oc['subtotal'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($ordencab['ord_estado'] == 'PENDIENTE') { ?>
                                                                        <?php if (empty($oc['ped'])) { ?>
                                                                            <a onclick="quitar(<?php echo "'" . $oc['id_orden'] . "_" . $oc['id_producto'] . "_" . $oc['id_deposito'] . "'"; ?>);"
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
                            <?php if ($ordencab['ord_estado'] == 'PENDIENTE') { ?>
                                <div class="box box-primary" style="width: 510px; height: 400px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Detalle</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="orden_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <input type="hidden" name="voperacion" value="1"/>
                                                    <input type="hidden" name="vidorden" value="<?php echo $orden; ?>"/>
                                                    <div class="form-group">
                                                        <label>Deposito</label>
                                                        <?php $depo = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                        <select class="form-control select2" name="viddeposito" required="" onchange="productos();" id="iddeposito">
                                                            <?php if (!empty($depo)) { ?>
                                                                <option value = "">Seleccione Deposito</option>
                                                                <?php foreach ($depo AS $dep) {
                                                                    ?>
                                                                    <option value="<?php echo $dep['id_deposito']; ?>"><?php echo $dep['dep_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe insertar registros...</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div id="detalles">

                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="submit" class="btn btn-success center-block">
                                                        <span class="glyphicon glyphicon-plus"></span>Agregar
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
            function quitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'orden_detalle_control.php?vidorden=' + dat[0] + '&vidproducto=' + dat[1] + '&viddeposito=' + dat[2] + '&vcantidad=0&vprecio=0&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el registro del detalle <i><strong>' + dat[2] + '</strong></i>?');
            }
            function productos() {
                var iddeposito = $("#iddeposito").val();
                $.ajax({
                    type: "POST", url: "producto_deposito.php", data: {iddeposito: iddeposito}
                }).done(function (datos) {
                    $("#detalles").html(datos);
                });
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>
