<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Detalle de Pedido</title>
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
                                    <h3 class="box-title">Pedidos</h3>
                                    <div class="box-tools">
                                        <a href="ped_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $cab = consultas::get_datos("SELECT * FROM compras_pedidos WHERE id_pedido=" . $_REQUEST['vid']);
                                        $consultadetalle = consultas::get_datos("SELECT * FROM compras_pedidos_detalle WHERE id_pedido=" . $_REQUEST['vid']);
                                        if (!empty($consultadetalle)) {
                                            if ($cab[0]['pc_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="ped_confirmar.php?vid=<?= $_REQUEST['vid']; ?>" 
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
                                            $id = $_REQUEST['vid'];
                                            $vcomped = consultas::get_datos("SELECT * FROM v_compras_pedidos WHERE id_pedido=" . $id);
                                            if (!empty($vcomped)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Usuario</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($vcomped AS $pc) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?= $pc['id_pedido']; ?></td>
                                                                    <td class="text-center"> <?= $pc['fecdate']; ?></td>
                                                                    <td class="text-center"> <?= $pc['usu_nick']; ?></td>
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
                                        $id = $_REQUEST['vid'];
                                        $pcdetalle = consultas::get_datos("SELECT * FROM v_compras_pedidos_detalle WHERE id_pedido=$id");
                                        if (!empty($pcdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Marca</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <?php if ($pc['pc_estado'] == 'PENDIENTE') { ?>
                                                                <th class="text-center">Acciones</th>    
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pcdetalle AS $fc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?= $fc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?= $fc['mar_descri']; ?></td>
                                                                <td class="text-center"> <?= $fc['dep_descri']; ?></td>
                                                                <td class="text-center"> <?= $fc['cantidad']; ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($pc['pc_estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="quitar(<?= "'" . $fc['id_pedido'] . "_" . $fc['id_producto'] . "_" . $fc['id_deposito'] . "'"; ?>);"
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
                            <?php if ($pc['pc_estado'] == 'PENDIENTE') { ?>
                                <div class="box box-success" style="width: 510px; height: 400px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Detalle</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="ped_detalle_control.php" method="POST" accept-charset="UTF-8">
                                                <div class="box-body" style="left: 1000px;">
                                                    <input type="hidden" name="voperacion" value="1"/>
                                                    <input type="hidden" name="vidpedido" value="<?= $_REQUEST['vid']; ?>"/>
                                                    <div class="form-group">
                                                        <label >Deposito</label>
                                                        <?php $depo = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                        <select class="form-control select2" name="vdeposito" required="">
                                                            <?php if (!empty($depo)) { ?>
                                                                <option value = "">Seleccione Deposito</option>
                                                                <?php foreach ($depo AS $dep) {
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
                                                        <select class="form-control select2" name="vproducto" required="" id="idproducto" onchange="detalles()">
                                                            <option value="">Seleccione Producto</option>
                                                            <?php
                                                            if (!empty($prod)) {
                                                                foreach ($prod AS $pro) {
                                                                    ?>
                                                                    <option value="<?= $pro['id_producto']; ?>"><?= $pro['pro_descri']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe insertar registros...</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group" id="detalles">

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cantidad</label>
                                                        <input class="form-control" type="number" min="1" name="vcantidad" value="1">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="submit" class="btn btn-success">
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
        <script src="../../funciones/funciones.js"></script>
        <script>
            function quitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'ped_detalle_control.php?vidpedido=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&vcantidad=0&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el registro del detalle <i><strong>' + dat[2] + '</strong></i>?');
            }
            function detalles() {
                var idproducto = $("#idproducto").val();
                $.ajax({
                    type: "POST", url: "pro_detalle.php", data: {idproducto: idproducto}
                }).done(function (datos) {
                    $("#detalles").html(datos);
                });
            }
        </script>

    </BODY>
</HTML>