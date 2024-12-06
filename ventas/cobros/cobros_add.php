<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Agregar Cobros</title>
        <?php
        session_start();
        include '../../conexion.php';
        require '../../tools/css.php';
        date_default_timezone_set('America/Asuncion');
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
                                    <i class="ion ion-cash"></i>
                                    <h3 class="box-title">Agregar Cobros</h3>
                                    <div class="box-tools">
                                        <a href="cobros_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="cobros_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <?php $vultimo = consultas::get_datos("SELECT COALESCE(MAX(id_cobro),0)+1 AS ultimo FROM cobros"); ?>
                                        <input type="hidden" name="vid_cobro"  value="<?= $vultimo[0]['ultimo'] ?>">
                                        <input type="hidden" name="vestado" value="PENDIENTE"/>
                                        <input type="hidden" name="vexentas" value="0"/>
                                        <input type="hidden" name="viva5" value="0"/>
                                        <input type="hidden" name="viva10" value="0"/>
                                        <input type="hidden" name="vivatotal" value="0"/>
                                        <input type="hidden" name="vtotal" value="0"/>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <label>Fecha</label>
                                                <?php $fechaActual = date('d-m-Y h:s'); ?>
                                                <input class="form-control" type="text" name="vfecha" readonly="" value="<?= $fechaActual; ?>">
                                            </div> 
                                            <div class="col-lg-6">
                                                <label>Apertura</label>
                                                <?php
                                                $apertura = consultas::get_datos("SELECT * FROM ventas_apertura_cierre WHERE estado='ABIERTA' AND id_caja IN (SELECT id_caja FROM ref_cajas WHERE caj_estado='ABIERTA' AND id_sucursal=" . $_SESSION['id_sucursal'] . ")");
                                                $timestamp = $apertura[0]['apertura_fecha'];
                                                $timestamp = strtotime($timestamp);
                                                $fecha_formateada = date("d-m-Y", $timestamp);
                                                ?>
                                                <input class="form-control" type="hidden" name="vid_apecie" value="<?= $apertura[0]['id_apecie'];?>">
                                                <input class="form-control" type="text" readonly="" value="<?= 'Nº ' . $apertura[0]['id_apecie'] . ' de fecha ' . $fecha_formateada; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >Clientes</label>
                                            <?php $clie = consultas::get_datos("SELECT * FROM v_ref_clientes WHERE id_cliente > 0 ORDER BY id_cliente"); ?>
                                            <select class="form-control select2" name="vid_cliente" required="">
                                                <?php if (!empty($clie)) { ?>
                                                    <option value="">SELECCIONE CLIENTE</option> 
                                                    <?php foreach ($clie as $cli) {
                                                        ?>
                                                        <option value="<?= $cli['id_cliente']; ?>">
                                                            <?= $cli['cliente'] . ' (' . $cli['per_ci'] . ')'; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">NO EXISTEN REGISTROS</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Condicion</label>
                                            <select class="form-control select2" name="vcondicion" id="vcondicion" onChange="habilitar_recibo();"> 
                                                <option value="CONTADO">CONTADO</option>             
                                                <option value="CREDITO">CREDITO</option>             
                                            </select>
                                        </div>
                                        <div class="form-group" style="display: none;" id="vdiv_recibo">
                                            <label>Nº Recibo</label>
                                            <input class="form-control" type="text" name="vnro_recibo" placeholder="01">
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
        <script type="text/javascript">
            function habilitar_recibo() {
                let valor = document.getElementById('vcondicion').value;
                if (valor == 'CREDITO') {
                    var div = document.getElementById("vdiv_recibo");
                    div.style.display = "block";
                } else {
                    var div = document.getElementById("vdiv_recibo");
                    div.style.display = "none";
                }
            }
        </script>
        <?php require '../../tools/js.php'; ?>
        <script src="../../funciones/funciones.js"></script>
    </BODY>
</HTML>