<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Compra con Orden</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Compras con Orden</h3>
                                    <div class="box-tools">
                                        <a href="/sysmeli/compras/orden/orden_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="compras_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class=row">
                                            <input type="hidden" name="voperacion"  value="2">
                                            <input type="hidden" name="vcompra" value="0"/>
                                            <input type="hidden" name="vorden" value="<?= $_GET['vidorden']; ?>"/>
                                            <input type="hidden" name="vusuario" value="<?= $_SESSION['id_usuario']; ?>"/>
                                            <input type="hidden" name="vsucursal" value="<?= $_SESSION['id_sucursal']; ?>"/>
                                            <input type="hidden" name="vtotiva" value="0"/>
                                            <input type="hidden" name="vestado" value="PENDIENTE"/>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">Fecha</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <?php $fechaActual = date('d-m-Y'); ?>
                                                    <input class="form-control" type="text" name="vfecha" readonly="" value="<?= $fechaActual; ?>">
                                                </div>
                                                <label class="control-label col-lg-2 col-md-1 col-sm-1 col-xs-1" style="position:relative; right:30px;">Fecha recibido</label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="date" name="vfechafactura" required="" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" style="position:relative; right:30px;">
                                                </div>
                                                <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">Usuario</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="text" readonly="" value="<?= $_SESSION['usu_nick']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">Orden</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="text" readonly="" value="<?= $_GET['vidorden']; ?>"/>
                                                </div>
                                                <?php $prvs = consultas::get_datos("SELECT * FROM v_compras_orden WHERE id_orden=" . $_GET['vidorden']) ?>
                                                <label class="control-label col-lg-2 col-md-1 col-sm-1 col-xs-1" style="position:relative; right:30px;">Proveedor</label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="text" readonly="" value="<?= $prvs[0]['prv_razonsocial']; ?>" style="position:relative; right:30px;"/>
                                                    <input class="form-control" type="hidden" readonly="" value="<?= $prvs[0]['id_proveedor']; ?>" name="vproveedor"/>
                                                </div>
                                                <label class="control-label col-sm-1 col-md-1  col-lg-1 col-xs-1">Monto</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="hidden" value="<?= $prvs[0]['ord_total']; ?>" name="vtotal"/>
                                                    <input class="form-control" type="number" readonly="" value="<?= $prvs[0]['ord_total']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">N°Factura</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="text" name="vfactura" required="" placeholder="001-001-12345" maxlength="13"/>
                                                </div>
                                                <label class="control-label col-lg-2 col-md-1 col-sm-1 col-xs-1" style="position:relative; right:30px;">N°Timbrado</label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="text" name="vtimbrado" required="" placeholder="12345678" maxlength="8" style="position:relative; right:30px;"/>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-1">Vencimiento</label>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <input class="form-control" type="date" name="vvencimiento" required="" min="<?= date('Y-m-d'); ?>"  value="<?= date('Y-m-d'); ?>"/>
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
                                                    <input name="vcuota" class="form-control" type="number" required="" placeholder="1" maxlength="2" id="cuota" disabled="disabled" min="1" style="position:relative; right:30px;" value="1"/>
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
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
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
                } else {
                    document.getElementById("cuota").disabled = true;
                    document.getElementById("intervalo").disabled = true;
                }
            }
        </script>
    </BODY>
</HTML>

