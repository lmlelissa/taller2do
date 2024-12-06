<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Agregar Compra</title>
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Compras</h3>
                                    <div class="box-tools">
                                        <a href="/sysmeli/compras/orden/orden_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="compras_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vcompra" value="0"/>
                                        <input type="hidden" name="vorden" value=""/>
                                        <input type="hidden" name="vusuario" value="<?= $_SESSION['id_usuario']; ?>"/>
                                        <input type="hidden" name="vsucursal" value="<?= $_SESSION['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vtotiva" value="0"/>
                                        <input type="hidden" name="vestado" value="PENDIENTE"/>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">Fecha</label>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?= date('Y-m-d'); ?>">
                                            </div>
                                            <label class="control-label col-lg-2 col-md-1 col-sm-1 col-xs-1" style="position:relative; right:10px;">Fecha recibido</label>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3" style="position:relative; right:30px;">
                                                <input class="form-control" type="date" name="vfechafactura" required=""  min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" style="width:222px;">
                                            </div>
                                            <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1" style="position:relative; left:80px;">Proveedor</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="position:relative;left:80px;">
                                                <select class="form-control select2" name="vproveedor" required="" style="width:140px;">
                                                    <?php $prvs = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY id_proveedor"); ?>
                                                    <?php
                                                    if (!empty($prvs)) {
                                                        foreach ($prvs as $prv) {
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
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">N°Factura</label>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                <input class="form-control" type="text" name="vfactura" required="" placeholder="001-001-12345"/>
                                            </div>
                                            <label class="control-label col-lg-2 col-md-1 col-sm-1 col-xs-1" style="position:relative; right:30px;">N°Timbrado</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <input class="form-control" type="text" name="vtimbrado" required="" placeholder="12345678" maxlength="8" style="position:relative; right:30px;"/>
                                            </div>
                                            <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">Vencimiento</label>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                <input class="form-control" type="date" name="vvencimiento" required="" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1 col-md-1  col-lg-1 col-xs-1">Condicion</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <select name="vcondicion" class="form-control select2" style="width: 140px;" required="" id="idcondicion" onchange="habilitar();">
                                                    <option value="CONTADO">CONTADO</option>
                                                    <option value="CREDITO">CREDITO</option>
                                                </select>
                                            </div>
                                            <label class="control-label col-sm-1 col-md-1  col-lg-1 col-xs-1" style="position:relative; right:30px;">Cuota</label>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <input name="vcuota" class="form-control" type="number" required="" placeholder="1" maxlength="2" id="cuota" disabled="disabled" min="1" style="position:relative; right:30px;"/>
                                            </div>
                                            <label class="control-label col-sm-1 col-md-1  col-lg-1 col-xs-1">Intervalo</label>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                <select name="vintervalo" class="form-control select2" style="width: 140px;" required="" id="intervalo" disabled="disabled">
                                                    <option value="30">MENSUAL</option>
                                                    <option value="15">QUINCENAL</option>
                                                </select>
                                            </div>
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
            function habilitar() {
                if (document.getElementById("idcondicion").value === "CREDITO") {
                    document.getElementById("cuota").disabled = false;
                    $('#intervalo').removeAttr('disabled');
                    $('#intervalo').removeAttr('disabled');
                }
            }
        </script>
    </BODY>
</HTML>

