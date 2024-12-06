<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Detalle Nota</title>
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
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Nota de Credito</h3>
                                    <div class="box-tools">
                                        <a href="credito_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $nota = $_REQUEST['vid_nota'];
                                        $ncab = consultas::get_datos("SELECT * FROM compras_credito WHERE id_nota=$nota");
                                        $nconsultadetalle = consultas::get_datos("SELECT * FROM v_compras_credito_detalle WHERE id_nota=$nota");
                                        if (!empty($nconsultadetalle)) {
                                            if ($ncab[0]['nc_estado'] == 'PENDIENTE') {
                                                ?>
                                                <a href="credito_confirmar.php?vidnota=<?php echo $nota ?>" 
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
                                            $notac = consultas::get_datos("SELECT * FROM v_compras_credito WHERE id_nota=" . $nota);
                                            if (!empty($notac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>                       
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Motivo</th> 
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Comprobante</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notac AS $notacab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $notacab['id_nota']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['fecdate']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['mot_descri']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['prv_razonsocial']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['com_nro_factura']; ?></td>
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
                                        $notacdetalle = consultas::get_datos("SELECT * FROM v_compras_credito_detalle WHERE id_nota=$nota");
                                        if (!empty($notacdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">P.Unit</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Exentas</th>
                                                            <th class="text-center">Iva 5%</th>
                                                            <th class="text-center">Iva 10%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($notacdetalle AS $nc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $nc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $nc['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $nc['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['precio'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['subtotal'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['exentas'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['iva5'], 0, '.', '.'); ?></td>
                                                                <td class="text-center"> <?php echo number_format($nc['iva10'], 0, '.', '.'); ?></td>
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