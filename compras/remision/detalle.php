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
                                    <h3 class="box-title">Nota de Remision</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $nota = $_REQUEST['vid_nr'];
                                        $ncab = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_nr=$nota");
                                        $nconsultadetalle = consultas::get_datos("SELECT * FROM v_nota_remision_detalle WHERE id_nr=$nota");
                                        if (!empty($nconsultadetalle)) {
                                            if ($ncab[0]['nr_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="confirmar.php?vid=<?= $nota ?>" 
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
                                            $notac = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_nr=" . $nota);
                                            if (!empty($notac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>                       
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Destino</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notac AS $notacab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $notacab['id_nr']; ?></td>
                                                                    <td class="text-center"><?= $notacab['fecdate']; ?></td>
                                                                    <td class="text-center"><?= $notacab['motivo_translado']; ?></td>
                                                                    <td class="text-center"><?= $notacab['destino']; ?></td>
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
                                        $notacdetalle = consultas::get_datos("SELECT * FROM v_nota_remision_detalle WHERE id_nr=$nota");
                                        if (!empty($notacdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito Saliente</th>
                                                            <th class="text-center">Deposito Entrante</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($notacdetalle AS $nc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?= $nc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?= $nc['salida']; ?></td>
                                                                <td class="text-center"> <?= $nc['entrada']; ?></td>
                                                                <td class="text-center"> <?= $nc['cantidad']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($notacab['nr_estado'] == 'PENDIENTE') { ?>
                                                                        <a onclick="quitar(<?= "'" . $nc['id_nr'] . "_" . $nc['id_producto'] . "_" . $nc['id_deposito_salida'] . "_" . $nc['id_deposito_entrada'] . "'"; ?>);"
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
                            <?php if ($notacab['nr_estado'] == 'PENDIENTE') { ?>
                                <div class="box box-primary" style="width: 510px; height: 450px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Detalle</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="detalle_control.php" method="POST" accept-charset="UTF-8">
                                                <div class="box-body">
                                                    <input type="hidden" name="voperacion" value="1"/>
                                                    <input type="hidden" name="vid_nr" value="<?= $nota; ?>"/>
                                                    <input type="hidden" id="suc_destino" value="<?= $notacab['sucursal_entrada'] ?>"/>
                                                    <input type="hidden" name="vestado" value="PENDIENTE"/>
                                                    <div class="form-group">
                                                        <label >Deposito Saliente</label>
                                                        <?php
                                                        $sucursal_salida = $notacab['sucursal_salida'];
                                                        $depo = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=$sucursal_salida")
                                                        ?>
                                                        <select class="form-control select2" name="vid_deposito_salida" required="" onchange="productos();" id="iddeposito">
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
                                                    <div id="detalles">

                                                    </div>
                                                </div>
                                                <div class="box-footer">
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
            function productos() {
                var iddeposito = $("#iddeposito").val();
                var suc_destino = $("#suc_destino").val();
                $.ajax({
                    type: "POST", url: "producto_deposito.php", data: {iddeposito: iddeposito, suc_destino: suc_destino}
                }).done(function (datos) {
                    $("#detalles").html(datos);
                });
            }
            function quitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'detalle_control.php?vid_nr=' + dat[0] + '&vid_producto=' + dat[1] + '&vid_deposito_salida=' + dat[2] + '&vid_deposito_entrada=' + dat[3] + '&vcantidad=1&vestado="ACTIVO"&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el registro del detalle <i><strong>' + dat[2] + '</strong></i>?');
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>