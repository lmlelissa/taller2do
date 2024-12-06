<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Formas de Cobros</title>
        <?php
        session_start();
        include '../../conexion.php';
        require '../../tools/css.php';
        $id = $_REQUEST['vid_cobro'];
        ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzDzmAAZJA<ctrl61>w9nKKunII8yZsBeErpKZ+WnnWNcqs+v4S6hZNNGwg35BDZ7lBmglE3aXBJ4C/xVnCqVU6H3Vig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <?php if (!empty($id)) { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="div_mensaje">

                                </div>
                            </div>
                            <!--CABECERA-->
                            <div class="col-lg-6">    
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-dollar"></i>
                                        <h3 class="box-title">Cobro N° <?= $id; ?></h3>
                                        <div class="box-tools">
                                            <a href="cobros_index.php" class="btn btn-danger pull-right btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                            </a> 
                                        </div>
                                    </div>
                                    <div class="box-body no-padding">
                                        <?php
                                        $cobroscab = consultas::get_datos("SELECT * FROM v_cobros WHERE id_cobro=" . $id);
                                        if (!empty($cobroscab)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Fecha</th> 
                                                            <th class="text-center">Cliente</th> 
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Pagado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cobroscab AS $cc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?= $cc['fecha1']; ?></td>
                                                                <td class="text-center"> <?= $cc['cliente']; ?></td>
                                                                <td class="text-center"> <?= number_format($cc['total'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($cc['monto_pagado'], 0, '.', '.'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                $falta_cobrar = round($cc['total'] - $cc['monto_pagado']);
                                                                if ($falta_cobrar > 0) {
                                                                    ?>
                                                                    <td class="text-center" style="color: red; font-size: 20px;" colspan="4"> <?= 'FALTA COBRAR Gs: ' . number_format($falta_cobrar, 0, '.', '.') ?></td>   
                                                                <?php }
                                                                ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--CABECERA-->

                            <!--FORMA-->
                            <div class="col-lg-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <i class="fa-solid fa-cash-register"></i>
                                        <h3 class="box-title">Formas de Cobro</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <div class="col-lg-12">
                                            <?php
                                            $id = $_REQUEST['vid_cobro'];
                                            $cobdetalle = consultas::get_datos("SELECT * FROM v_cobros_forma_detalle WHERE id_cobro=$id");
                                            if (!empty($cobdetalle)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table id="example2" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Forma</th>
                                                                <th class="text-center">Monto</th>
                                                                <?php if ($cc['estado'] == 'CONFIRMADO') { ?>
                                                                    <?php if ($cobdetalle[0]['id_fc'] == 1) { ?>
                                                                        <th class="text-center">Acciones</th>    
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($cobdetalle AS $cobdet) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?= $cobdet['fc_descrip']; ?></td>
                                                                    <td class="text-center"> <?= number_format($cobdet['monto'], 0, '.', '.'); ?></td>
                                                                    <td class="text-center"> 
                                                                        <?php if ($cc['estado'] == 'CONFIRMADO') { ?>
                                                                            <?php if ($cobdet['id_fc'] == 1) { ?>
                                                                                <a onclick="quitar_forma(<?= "'" . $cobdet['id_cobro'] . "_" . $cobdet['id_fc'] . "_" . $cobdet['monto'] . "_" . $cobdet['fc_descrip'] . "'"; ?>);"
                                                                                   class="btn btn-danger btn-sm" role="button" data-title="Quitar Efectivo"
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
                            </div>
                            <!--FORMA-->
                        </div>
                        <div class="row">
                            <!--AGREGAR FORMA-->
                            <div class="col-lg-6">
                                <?php if ($cc['estado'] == 'CONFIRMADO') { ?>
                                    <div class="box box-success">
                                        <div class="box-header">
                                            <i class="ion ion-clipboard"></i>
                                            <h3 class="box-title">Agregar Forma de Cobro</h3>
                                        </div>
                                        <div class="box-body no-padding">
                                            <div class="col-lg-12">
                                                <form action="cobros_forma_control.php" method="GET" accept-charset="UTF-8">
                                                    <input type="hidden" name="voperacion" value="1"/>
                                                    <input type="hidden" name="vid_cobro" id="vid_cobro" value="<?= $id; ?>"/>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label >Forma</label>
                                                            <?php $formas = consultas::get_datos("SELECT * FROM ref_forma_cobro WHERE estado='ACTIVO' AND id_fc NOT IN(SELECT id_fc FROM cobros_forma_detalle WHERE id_fc=1 AND id_cobro=" . $id . ")"); ?>
                                                            <select class="form-control select2" name="vid_fc" required="" onchange="detallesforma()" id="vid_fc">
                                                                <?php if (!empty($formas)) { ?>
                                                                    <option value="">SELECCIONE FORMA DE COBRO</option> 
                                                                    <?php foreach ($formas as $for) {
                                                                        ?>
                                                                        <option value="<?= $for['id_fc']; ?>"><?= $for['fc_descrip']; ?></option>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <option value="">No hay registros</option>             
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div id="detallesforma">

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
                            </div>
                            <!--AGREGAR FORMA-->
                        </div>
                        <div class="row">
                            <!--DETALLE TARJETA-->
                            <div class="col-lg-6">
                                <?php
                                $cobrostarjeta = consultas::get_datos("SELECT * FROM v_cobros_tarjetas WHERE id_cobro=$id");
                                if (!empty($cobrostarjeta)) {
                                    ?>
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <i class="fa fa-credit-card"></i>
                                            <h3 class="box-title">Cobros con Tarjeta</h3>
                                        </div>
                                        <div class="box-body no-padding">
                                            <div class="col-lg-12">
                                                <?php
                                                $cobtar = consultas::get_datos("SELECT * FROM v_cobros_tarjetas WHERE id_cobro=$id");
                                                if (!empty($cobtar)) {
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table id="example2" class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">N°</th>
                                                                    <th class="text-center">Marca</th>
                                                                    <th class="text-center">Tipo</th>
                                                                    <th class="text-center">Monto</th>
                                                                    <?php if ($cc['estado'] == 'CONFIRMADO') { ?>
                                                                        <th class="text-center">Acciones</th>    
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($cobtar AS $ctar) { ?>
                                                                    <tr>
                                                                        <td class="text-center"> <?= $ctar['nro_tarjeta']; ?></td>
                                                                        <td class="text-center"> <?= $ctar['mt_descri']; ?></td>
                                                                        <td class="text-center"> <?= $ctar['tipo']; ?></td>
                                                                        <td class="text-center"> <?= number_format($ctar['monto'], 0, '.', '.'); ?></td>
                                                                        <td class="text-center"> 
                                                                            <?php if ($cc['estado'] == 'CONFIRMADO') { ?>
                                                                                <a onclick="quitar_tarjeta(<?= "'" . $ctar['id_ct'] . "_" . $ctar['id_cobro'] . "_" . $ctar['nro_tarjeta'] . "'"; ?>);"
                                                                                   class="btn btn-danger btn-sm" role="button" data-title="Quitar Tarjeta"
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
                                                        <span class="glyphicon glyphicon-info-sign"></span> No tiene cobros en tarjeta...
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!--DETALLE TARJETA-->

                           

                            <!-- MODAL DE QUITAR -->
                            <div class="col-lg-6">
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
                            </div>
                            <!-- MODAL DE QUITAR -->
                        </div>
                    <?php } else { ?>
                        <label style="color: red;font-size: 15px;font-family: cursive;">Verifique Numero de Cobro</label>
                    <?php } ?>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script>
            function detallesforma() {
                var vid_fc = $("#vid_fc").val();
                var vid_cobro = $("#vid_cobro").val();
                $.ajax({
                    type: "POST", url: "detalles_formas.php", data: {vid_fc: vid_fc, vid_cobro: vid_cobro}
                }).done(function (datos) {
                    $("#detallesforma").html(datos);
                });
            }
            function quitar_forma(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'cobros_forma_control.php?vid_cobro=' + dat[0] + '&vid_fc=' + dat[1] + '&vmonto=' + dat[2] + '&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar forma de cobro <i><strong>' + dat[3] + '</strong></i>?');
            }
            function quitar_tarjeta(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'cobros_forma_control.php?vid_ct=' + dat[0] + '&vid_cobro=' + dat[1] + '&vnro_tarjeta=' + dat[2] + '&vid_fc=2&vid_mt=0&vnro_cupon=0&vtipo=0&vfecha=140824&vmonto=0&vestado=ACTIVO&vid_ee=0&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el cobro de N° tarjeta <i><strong>' + dat[2] + '</strong></i>?');
            }
            function quitar_cheque(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'cobros_forma_control.php?vid_cch=' + dat[0] + '&vid_cobro=' + dat[1] + '&vid_banco=' + dat[2] + '&vnro_cheque=0&va_orden_de=0&vfecha=140824&vtipo=0&vcheque_venc=140824&vmonto=0&vestado=ACTIVO&vid_fc=3&voperacion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el cobro de N° Cheque <i><strong>' + dat[3] + '</strong></i>?');
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>