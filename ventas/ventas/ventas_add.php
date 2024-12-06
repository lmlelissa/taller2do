<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Agregar Venta</title>
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
                                    <h3 class="box-title">Agregar Venta</h3>
                                    <div class="box-tools">
                                        <a href="ventas_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="ventas_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_venta"  value="0">
                                        <input type="hidden" name="vid_sucursal" value="<?= $_SESSION['id_sucursal']; ?>"/>
                                        <input type="hidden" name="vid_usuario" value="<?= $_SESSION['id_usuario']; ?>"/>
                                        <input type="hidden" name="vestado" value="PENDIENTE"/>
                                        <input type="hidden" name="vtotal" value="0"/>
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <?php $fechaActual = date('d-m-Y'); ?>
                                            <input class="form-control" type="text" name="vfecha" readonly="" value="<?= $fechaActual; ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Apertura</label>
                                                <?php $apertura = consultas::get_datos("SELECT * FROM ventas_apertura_cierre WHERE estado='ABIERTA' AND id_caja IN (SELECT id_caja FROM ref_cajas WHERE caj_estado='ABIERTA' AND id_sucursal=" . $_SESSION['id_sucursal'] . ")"); ?>
                                                <input class="form-control" type="text" name="vid_apecie" readonly="" value="<?= $apertura[0]['id_apecie']; ?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Nro Factura</label>
                                                <?php $nrofact = consultas::get_datos("SELECT * FROM ref_timbrados WHERE estado='ACTIVO' AND id_tipo_doc='FACTURA' AND id_caja IN (SELECT id_caja FROM ref_cajas WHERE caj_estado='ABIERTA' AND id_sucursal=" . $_SESSION['id_sucursal'] . ")"); ?>
                                                <input class="form-control" type="text" name="vnro_factura" readonly="" value="<?= '00' . $_SESSION['id_sucursal'] . '-00' . $nrofact[0]['id_caja'] . '-00' . ($nrofact[0]['numero_actual'] + 1); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >Datos del Pedido</label>
                                            <?php $pedidos = consultas::get_datos("SELECT * FROM v_ventas_pedidos WHERE id_pedido=" . $_REQUEST['vid_pedido']); ?>
                                            <input class="form-control" type="text" readonly="" value="<?= 'N°: ' . $pedidos[0]['id_pedido'] . ' - DE FECHA:' . $pedidos[0]['fecha_corta1'] . ' - CLIENTE: ' . $pedidos[0]['cliente']; ?>">
                                            <input type="hidden" name="vid_pedido" value="<?= $pedidos[0]['id_pedido']; ?>">
                                            <input type="hidden" name="vid_cliente" value="<?= $pedidos[0]['id_cliente']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Condicion</label>
                                            <select class="form-control select2" name="vcondicion" id="vcondicion" onChange="habilitar_condicion();"> 
                                                <option value="CONTADO">CONTADO</option>             
                                                <option value="CREDITO">CREDITO</option>             
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cuota</label>
                                            <input class="form-control" type="number" name="vcuota" value="1" id="vcuota" readonly="" min="0" max="100">
                                        </div>
                                        <div class="form-group">
                                            <label>Intervalo</label>
                                            <select class="form-control select2" name="vintervalo" id="vintervalo" readonly="">
                                                <option value="30">30 Dias</option>             
                                                <option value="15">15 Dias</option>             
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
        <script type="text/javascript">
            function comprobar(obj)
            {
                if (obj.checked) {
                    document.getElementById('del_ciu').style.display = "";
                    document.getElementById('del_direc').style.display = "";
                    document.getElementById('direccion').setAttribute("required", "");
                } else {
                    document.getElementById('del_ciu').style.display = "none";
                    document.getElementById('del_direc').style.display = "none";
                }
            }
            function habilitar_condicion() {
                let valor = document.getElementById('vcondicion').value;
                if (valor == 'CREDITO') {
                    $("#vcuota").removeAttr("readonly");
                    $("#vintervalo").removeAttr("readonly");
                } else {
                    $("#vcuota").attr("readonly", "readonly");
                    $("#vintervalo").attr("readonly", "readonly");
                }
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>