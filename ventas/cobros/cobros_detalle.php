<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Detalles de Cobros</title>
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
                                    <h3 class="box-title">Cobros</h3>
                                    <div class="box-tools">
                                        <a href="cobros_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $id = $_REQUEST['vid_cobro'];
                                        $cab = consultas::get_datos("SELECT * FROM v_cobros WHERE id_cobro=$id");
                                        $consultadetalle = consultas::get_datos("SELECT * FROM cobros_detalle WHERE id_cobro=" . $_REQUEST['vid_cobro']);
                                        if (!empty($consultadetalle)) {
                                            if ($cab[0]['estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="cobros_confirmar.php?vid_cobro=<?= $_REQUEST['vid_cobro']; ?>" 
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
                                            $cobroscab = consultas::get_datos("SELECT * FROM v_cobros WHERE id_cobro=" . $id);
                                            if (!empty($cobroscab)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Cliente</th> 
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($cobroscab AS $cc) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?= $cc['fecha1']; ?></td>
                                                                    <td class="text-center"> <?= $cc['cliente']; ?></td>
                                                                    <td class="text-center"> <?= number_format($cc['total'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> <?= $cc['estado']; ?></td>
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
                                        $id = $_REQUEST['vid_cobro'];
                                        $cobdetalle = consultas::get_datos("SELECT * FROM v_cobros_detalle WHERE id_cobro=$id");
                                        if (!empty($cobdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Cuenta</th>
                                                            <th class="text-center">Nro Factura</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Vencimiento</th>
                                                            <?php if ($cc['estado'] == 'PENDIENTE') { ?>
                                                                <th class="text-center">Acciones</th>    
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cobdetalle AS $cobdet) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?= $cobdet['id_cta']; ?></td>
                                                                <?php $venta = consultas::get_datos("SELECT id_venta FROM v_ventas_factura_detalle WHERE nro_factura='" . $cobdet['nro_factura'] . "'"); ?>
                                                                <td class="text-center" onclick="redirigir('/systec/ventas/ventas/ventas_detalle.php?vid_venta=<?= $venta[0]['id_venta']; ?>')"><?= $cobdet['nro_factura']; ?></td>
                                                                <td class="text-center"> <?= number_format($cobdet['cta_importe'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= $cobdet['cta_vto1']; ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($cc['estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="quitar_cta(<?= "'" . $cobdet['id_cobro'] . "_" . $cobdet['id_cta'] . "_" . $cobdet['nro_factura'] . "_" . $cobdet['cta_importe']. "'"; ?>);"
                                                                           class="btn btn-danger btn-sm" role="button" data-title="Quitar"
                                                                           rel="tooltip" data-placement="top" data-toggle="modal" data-target="#quitar">
                                                                            <i class="fa fa-times"></i>
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

                            <!--AGREGAR DETALLE-->
                            <?php if ($cc['estado'] == 'PENDIENTE') { ?>
                                <div class="box box-success" style="width: 500px; height: 350px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Detalle</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="cobros_detalle_control.php" method="GET" accept-charset="UTF-8">
                                                <input type="hidden" name="voperacion" value="1"/>
                                                <input type="hidden" name="vid_cobro" value="<?= $_REQUEST['vid_cobro']; ?>"/>
                                                <input type="hidden" name="vid_cliente" id="vid_cliente" value="<?= $cc['id_cliente']; ?>"/>
                                                <input type="hidden" name="vgravada_5" value="0"/>
                                                <input type="hidden" name="vgravada_10" value="0"/>
                                                <input type="hidden" name="vexenta" value="0"/>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label >Cuentas a Cobrar</label>
                                                        <?php $cuentas = consultas::get_datos("SELECT * FROM v_ventas_ctas_cobrar WHERE cta_estado='PENDIENTE' AND condicion='".$cc['condicion'] ."' AND id_cliente=" . $cc['id_cliente'] ." ORDER BY cta_vto"); ?>
                                                        <select class="form-control select2" name="vid_cta" required="" onchange="detallescta()" id="vid_cta">
                                                            <?php if (!empty($cuentas)) { ?>
                                                                <option value="">Seleccione una Cuenta</option> 
                                                                <?php foreach ($cuentas as $cta) {
                                                                    ?>
                                                                    <option value="<?= $cta['id_cta']; ?>"><?= $cta['nro_factura'] . ' - de Fecha : ' . $cta['fechaventa']. ' - Cuota : ' . $cta['cta_cuota']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">NO EXISTEN REGISTROS</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div id="detallescta">
                                                        
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
            function redirigir(url) {
                window.location.href = url;
            }

            function quitar_cta(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'cobros_detalle_control.php?vid_cobro=' + dat[0] + '&vid_cta=' + dat[1] +'&vmonto='+ dat[3] +'&vgravada_5=0&vgravada_10=0&vexenta=0&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar la factura <i><strong>' + dat[2] + '</strong></i>?');
            }
            function detallescta() {
                var vid_cta = $("#vid_cta").val();
                $.ajax({
                    type: "POST", url: "detalles_cuentas.php", data: {vid_cta: vid_cta}
                }).done(function (datos) {
                    $("#detallescta").html(datos);
                });
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>