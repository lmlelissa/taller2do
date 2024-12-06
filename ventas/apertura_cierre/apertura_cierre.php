<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Apertura y Cierre</title>
        <?php
        include '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <!--cabecera-->
                    <div class="row">
                        <?php $aperturas = consultas::get_datos("SELECT * FROM v_ventas_apertura WHERE id_usuario = " . $_SESSION['id_usuario'] . " and estado != 'CERRADO' "); ?>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <h3 class="page-header">Apertura Cierre de Cajas - <?= $_SESSION['nombres'] ?> 
                                <a data-toggle="modal" data-target="#registrar" onclick="registrar_apertura()" 
                                   class="btn btn-success btn-circle pull-right" 
                                   rel="tooltip" data-title="Registrar Apertura">
                                    <i class="fa fa-plus"></i>
                                </a> 
                            </h3>
                            <div id="div_mensaje"></div>
                        </div>
                    </div>
                    <!--cabecera-->
                    <!--datos-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Datos
                                </div>                     
                                <div class="panel-body">
                                    <?php
                                    if (!empty($aperturas)) {
                                        ?>    
                                        <div>
                                            <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">Fecha Apertura</th> 
                                                        <th class="text-center">Monto Apertura</th> 
                                                        <th class="text-center">Caja</th> 
                                                        <th class="text-center">Monto Efectivo</th>
                                                        <th class="text-center">Monto Cheque</th>
                                                        <th class="text-center">Monto Tarjeta</th>
                                                        <th class="text-center">Estado</th>
                                                        <th class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="buscar">
                                                    <?php foreach ($aperturas as $apertura) { ?> 
                                                        <tr>
                                                            <td class="text-center"><?= $apertura['id_apecie']; ?></td>
                                                            <td class="text-center"><?= date('d/m/Y', strtotime($apertura['apertura_fecha'])); ?></td>
                                                            <td class="text-center"><?= number_format($apertura['apertura_monto'], 0, ',', '.'); ?></td>
                                                            <td class="text-center"><?= $apertura['caj_descri']; ?></td>
                                                            <td class="text-center"><?= number_format($apertura['monto_efectivo'], 0, ',', '.'); ?></td>
                                                            <td class="text-center"><?= number_format($apertura['monto_cheque'], 0, ',', '.'); ?></td>
                                                            <td class="text-center"><?= number_format($apertura['monto_tarjeta'], 0, ',', '.'); ?></td>
                                                            <td class="text-center"><?= $apertura['estado']; ?></td>
                                                            <td class="text-center">
                                                                <?php if ($apertura['estado'] != "CERRADO") { ?>
                                                                    <a onclick="cerrar_apertura(<?= "'" . $apertura['id_apecie'] . "_" . $apertura['id_caja'] . "'"; ?>)"
                                                                       class="btn btn-xs btn-danger" rel='tooltip' data-title="Cerrar Caja" 
                                                                       data-toggle="modal" data-target="#delete"  target="_blank" >
                                                                        <span class="glyphicon glyphicon-log-in"></span>
                                                                    </a>
                                                                <?php } ?>
                                                                <a href="arqueo_caja.php?vcod=<?= $apertura['id_apecie'] ?>" target="_blank" 
                                                                   class="btn btn-xs btn-success" rel='tooltip' data-title="Imprimir Arqueo">
                                                                    <span class="glyphicon glyphicon-print"></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>                         
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span class="glyphicon glyphicon-info-sign"></span><strong> No posee ninguna apertura hecha a la fecha....!</strong>
                                        </div>
                                    <?php } ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--datos-->
                    <!--registrar-->
                    <div id="registrar" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content" id="apertura">

                            </div>
                        </div>
                    </div>
                    <!--registrar-->
                    <!--borrar-->
                    <div id="delete" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning" id="confirmacion"></div>
                                </div>
                                <div class="modal-footer">
                                    <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!--fin-->
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div> 
        <?php require '../../tools/js.php'; ?>
        <script>
            function registrar_apertura() {
                $.ajax({
                    type: "GET",
                    url: "/sysmeli/ventas/apertura_cierre/apertura_registrar.php",
                    beforeSend: function () {
                        $("#apertura").html();
                    },
                    success: function (msg) {
                        $("#apertura").html(msg);
                    }
                });
            }
            function cerrar_apertura(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'apertura_control.php?vcod=' + dat[0] +
                    '&vcaja=' + dat[1] +
                    '&apemonto=0' +
                    '&accion=2');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>Desea Cerrar la Caja <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>
        <script src="../../funciones/funciones.js"></script>
    </body>
</html>
