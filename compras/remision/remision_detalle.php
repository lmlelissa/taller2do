<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Remision Detalle</title>
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
                            <div id="div_mensaje"></div>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Remision</h3>
                                    <div class="box-tools">
                                        <a href="remision.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a> 
                                        <?php
                                        $nota = $_REQUEST['vid_nr'];
                                        $ncab = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_nr=$nota");
                                        $nconsultadetalle = consultas::get_datos("SELECT * FROM v_nota_remision_detalle WHERE id_nr=$nota");
                                        if (!empty($nconsultadetalle)) {
                                            if ($ncab[0]['nr_estado'] == 'TRASLADANDO') {
                                                ?>
                                                <a href="confirmar_remision.php?vid=<?php echo $nota ?>" 
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
                                            $notac = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_nr=" . $nota);
                                            if (!empty($notac)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>                       
                                                                <th class="text-center">Fecha</th> 
                                                                <th class="text-center">Motivo</th>
                                                                <th class="text-center">Destino</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($notac AS $notacab) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $notacab['id_nr']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['fecdate']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['motivo_translado']; ?></td>
                                                                    <td class="text-center"><?php echo $notacab['destino']; ?></td>
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
                                        $notacdetalle = consultas::get_datos("SELECT * FROM v_nota_remision_detalle WHERE id_nr=$nota");
                                        if (!empty($notacdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito Saliente</th>
                                                            <th class="text-center">Deposito Entrante</th>
                                                            <th class="text-center">Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($notacdetalle AS $nc) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $nc['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $nc['salida']; ?></td>
                                                                <td class="text-center"> <?php echo $nc['entrada']; ?></td>
                                                                <td class="text-center"> <?php echo $nc['cantidad']; ?></td>
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