<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Detalle Nota</title>
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
                            <h4>Nota de Credito</h4>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cabecera</h3>
                                    <div class="box-tools">
                                        <a href="credito_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $nota = $_REQUEST['vid_nota'];
                                        $ncab = consultas::get_datos("SELECT * FROM ventas_ncredito WHERE id_nota=$nota");
                                        $nconsultadetalle = consultas::get_datos("SELECT * FROM v_ventas_ncredito_detalle WHERE id_nota=$nota");
                                        if (!empty($nconsultadetalle)) {
                                            if ($ncab[0]['nc_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="credito_confirmar.php?vidnota=<?= $nota ?>" 
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
                                            $notac = consultas::get_datos("SELECT * FROM v_ventas_ncredito WHERE id_nota=" . $nota);
                                            if (!empty($notac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>                       
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Cliente</th>
                                                                <th class="text-center">Factura</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notac AS $notacab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $notacab['id_nota']; ?></td>
                                                                    <td class="text-center"><?= $notacab['fecha1']; ?></td>
                                                                    <td class="text-center"><?= $notacab['cliente']; ?></td>
                                                                    <td class="text-center"><?= $notacab['nc_comprobante']; ?></td>
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
                                        $notacdetalle = consultas::get_datos("SELECT * FROM v_ventas_ncredito_detalle WHERE id_nota=$nota");
                                        if (!empty($notacdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Concepto</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Monto</th>
                                                            <th class="text-center">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($notacdetalle AS $nc) { ?>
                                                            <tr>
                                                                <?php
                                                                if (!empty($nc['pro_descri'])) {
                                                                    $concepto = $nc['pro_descri'];
                                                                } else {
                                                                    $concepto = $nc['servi_descri'];
                                                                }
                                                                ?>
                                                                <td class="text-center"> <?= $concepto; ?></td>
                                                                <td class="text-center"> <?= $nc['cantidad']; ?></td>
                                                                <td class="text-center"> <?= number_format($nc['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?= number_format($nc['subtotal'], 0, '.', '.'); ?></td>
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
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
    </BODY>
</HTML>