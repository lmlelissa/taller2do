<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Agregar Ajuste</title>
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
                                    <h3 class="box-title">Agregar Ajuste</h3>
                                    <div class="box-tools">
                                        <a href="/sysmeli/compras/ajustes/ajuste_index.php" class="btn btn-danger pull-right btn-sm"><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </div>
                                <form action="ajuste_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <div class=row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vid_ajuste" value="0"/>
                                            <input type="hidden" name="vid_usuario" value="<?php echo $_SESSION['id_usuario']; ?>"/>
                                            <input type="hidden" name="vaj_estado" value="PENDIENTE"/>
                                            <div class="form-group">
                                                <label>Fecha</label>
                                                <?php $fechaActual = date('d-m-Y'); ?>
                                                <input class="form-control" type="text" name="vaj_fecha" readonly="" value="<?php echo $fechaActual; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Motivo</label>
                                                <select class="form-control select2" name="vid_mj" required="">
                                                    <?php $motis = consultas::get_datos("SELECT * FROM ref_motivo_ajuste ORDER BY id_mj"); ?>
                                                    <?php
                                                    if (!empty($motis)) {
                                                        foreach ($motis as $moti) {
                                                            ?>
                                                            <option value="<?php echo $moti['id_mj']; ?>">
                                                                <?php echo $moti['mj_descri']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe seleccionar al menos un registro</option>             
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Deposito</label>
                                                <select class="form-control select2" name="vid_deposito" required="" onchange="productos();" id="iddeposito">
                                                    <?php $depos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']); ?>
                                                    <?php if (!empty($depos)) { ?>
                                                        <option value="">Seleccione un deposito...</option>
                                                        <?php foreach ($depos as $dep) {
                                                            ?>
                                                            <option value="<?php echo $dep['id_deposito']; ?>">
                                                                <?php echo $dep['dep_descri']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe seleccionar al menos un registro</option>             
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="detalles">

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
            function productos() {
                var iddeposito = $("#iddeposito").val();
                $.ajax({
                    type: "POST", url: "producto_deposito.php", data: {iddeposito: iddeposito}
                }).done(function (datos) {
                    $("#detalles").html(datos);
                });
            }
        </script>
    </BODY>
</HTML>

