<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Agregar Nota</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Nota de Debito</h3>
                                    <div class="box-tools">
                                        <a href="debito_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="debito_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_nota"  value="0">
                                        <input type="hidden" name="vid_usuario" value="<?= $_SESSION['id_usuario']; ?>"/>
                                        <input type="hidden" name="vid_sucursal" value="<?= $_SESSION['id_sucursal']; ?>"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" name="vnc_fecha_sistema" readonly="" value="<?= $fechaActual; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Proveedor</label>
                                            <select class="form-control select2" name="vid_proveedor" required="" onchange="obtener_factura()" id="idproveedor">
                                                <?php $moti = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY id_proveedor"); ?>
                                                <?php if (!empty($moti)) { ?>
                                                    <option value="">Seleccione un Proveedor</option>      
                                                    <?php foreach ($moti as $prv) {
                                                        ?>
                                                        <option value="<?= $prv['id_proveedor']; ?>">
                                                            <?= $prv['prv_razonsocial']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="detalle_factura" style="display:block">

                                        </div>
                                        <div class="form-group">
                                            <label >Emision</label>
                                            <input class="form-control" type="date" name="vnc_fecha_recibido" required="" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label >N°Timbrado</label>
                                            <input class="form-control" type="text" name="vnc_nro_timbrado" required="" placeholder="12345678" maxlength="8"/>
                                        </div>
                                        <div class="form-group">
                                            <label >Vencimiento</label>
                                            <input class="form-control" type="date" name="vnc_timbrado_venc" required="" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" />
                                        </div>
                                        <div class="form-group" style="display:block">

                                        </div>
                                        <div class="form-group">
                                            <label >Motivo</label>
                                            <select class="form-control select2" name="vid_motivo" required="">
                                                <?php $moti = consultas::get_datos("SELECT * FROM ref_motivo_nota WHERE id_motivo NOT IN(1,2) ORDER BY id_motivo"); ?>
                                                <?php if (!empty($moti)) { ?>  
                                                    <?php foreach ($moti as $mot) {
                                                        ?>
                                                        <option value="<?= $mot['id_motivo']; ?>">
                                                            <?= $mot['mot_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
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
                var prv_cod = $("#idproveedor").val();
                $.ajax({
                    type: "POST", url: "facturas.php", data: {prv_cod: prv_cod}
                }).done(function (datos) {
                    $("#detalle_factura").html(datos);
                });
            }
        </script>
    </BODY>
</HTML>

