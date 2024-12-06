<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registrar Nota</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="credito_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="debito_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $fechaActual = date('d-m-Y'); ?>
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_nota"  value="0">
                                        <input type="hidden" name="vnd_monto" value="0"/>
                                        <input type="hidden" name="vnd_monto_iva" value="0"/>
                                        <input type="hidden" name="vnd_estado" value="PENDIENTE"/>
                                        <div class="form-group">
                                            <label >Fecha</label>
                                            <input class="form-control" type="text" name="vnd_fecha" readonly="" value="<?= $fechaActual; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Apertura</label>
                                            <?php $apertura = consultas::get_datos("SELECT * FROM ventas_apertura_cierre WHERE estado='ABIERTA' AND id_caja IN (SELECT id_caja FROM ref_cajas WHERE caj_estado='ABIERTA' AND id_sucursal=" . $_SESSION['id_sucursal'] . ")"); ?>
                                            <input class="form-control" type="text" name="vid_apecie" readonly="" value="<?= $apertura[0]['id_apecie']; ?>">
                                        </div>
                                        <?php
                                        $tim = consultas::get_datos("SELECT * FROM ref_timbrados WHERE id_tipo_doc='NOTA DE DEBITO' AND estado='ACTIVO'");
                                        if (!empty($tim)) {
                                            ?>
                                            <div class = "form-group">
                                                <label >N°Timbrado</label>
                                                <?php $tim = consultas::get_datos("SELECT * FROM ref_timbrados WHERE id_tipo_doc='NOTA DE DEBITO' AND estado='ACTIVO' AND id_caja IN (SELECT id_caja FROM ref_cajas WHERE caj_estado='ABIERTA' AND id_sucursal=" . $_SESSION['id_sucursal'] . ")"); ?>
                                                <input class="form-control" type="text" name="vid_tim" value="<?= $tim[0]['id_tim']; ?>" readonly=""/> 
                                            </div>
                                            <div class="form-group">
                                                <label>Nro Documento</label>
                                                <?php $nrofact = consultas::get_datos("SELECT * FROM ref_timbrados WHERE estado='ACTIVO' AND id_tipo_doc='NOTA DE DEBITO' AND id_caja IN (SELECT id_caja FROM ref_cajas WHERE caj_estado='ABIERTA' AND id_sucursal=" . $_SESSION['id_sucursal'] . ")"); ?>
                                                <input class = "form-control" type = "text" name = "vnd_comprobante" readonly = "" value = "<?= '00' . $_SESSION['id_sucursal'] . '-00' . $nrofact[0]['id_caja'] . '-00' . ($nrofact[0]['numero_actual'] + 1); ?>">
                                            </div>
                                            <?php
                                        } else {
                                            echo '<h5 style="color:red;">Verifique Timbrado de la Nota</h5>';
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label >Motivo</label>
                                            <select class="form-control select2" name="vid_motivo" required="" >
                                                <?php $moti = consultas::get_datos("SELECT * FROM ref_motivo_nota WHERE id_motivo NOT IN(1,2)"); ?>
                                                <?php if (!empty($moti)) { ?>
                                                    <option value="">SELECCIONE MOTIVO</option>      
                                                    <?php foreach ($moti as $mot) {
                                                        ?>
                                                        <option value="<?= $mot['id_motivo']; ?>"> <?= $mot['mot_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">NO EXISTEN MOTIVOS</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Cliente</label>
                                            <select class="form-control select2" name="vid_cliente" required="" onchange="obtener_factura()" id="idcliente">
                                                <?php $clie = consultas::get_datos("SELECT * FROM v_ref_clientes ORDER BY id_cliente"); ?>
                                                <?php if (!empty($clie)) { ?>
                                                    <option value="">SELECCIONE CLIENTE</option>      
                                                    <?php foreach ($clie as $cli) {
                                                        ?>
                                                        <option value="<?= $cli['id_cliente']; ?>"> <?= $cli['cliente'] . '-' . $cli['per_ci']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">NO EXISTEN CLIENTES</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="detalle_factura" style="display:block">

                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-save"></i> Registrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script>
            function obtener_factura() {
                var idcliente = $("#idcliente").val();
                $.ajax({
                    type: "POST", url: "facturas.php", data: {idcliente: idcliente}
                }).done(function (datos) {
                    $("#detalle_factura").html(datos);
                });
            }
        </script>
    </BODY>
</HTML>

