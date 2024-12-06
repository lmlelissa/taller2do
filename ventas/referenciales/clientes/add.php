<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registrar Clientes</title>
        <?php
        include '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../../tools/header.php'; ?>
            <?php require '../../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Cliente</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="controlador.php" method="POST" accept-charset="UTF-8" role="form">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vid_cliente" value="0"/> 
                                        <input type="hidden" name="vestado" value="ACTIVO"/>
                                        <div class="form-group has-warning">
                                            <?php $person = consultas::get_datos("SELECT * FROM ref_persona ORDER BY id_persona"); ?>
                                            <label class="control-label"><i class="fa fa-check"></i>Persona</label>
                                            <select class="form-control" name="vid_persona" id="idpersona" onchange="detalles();" required=""> 
                                                <?php if (!empty($person)) { ?>
                                                    <option value="">Seleccione un Registro</option>    
                                                    <?php foreach ($person as $perso) { ?>
                                                        <option value="<?php echo $perso['id_persona']; ?>"><?php echo '(' . $perso['per_ci'] . ') - ' . $perso['per_nombre'] . ' ' . $perso['per_apellido']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group has-success" id="detalles">

                                        </div>
                                        <div class="box-footer">
                                            <button class="btn btn-success" type="submit">Registrar
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require '../../../tools/footer.php'; ?>
        </div>
        <?php require '../../../tools/js.php'; ?>
        <script>
            function detalles() {
                var idpersona = $("#idpersona").val();
                $.ajax({
                    type: "POST", url: "detalles.php", data: {idpersona: idpersona}
                }).done(function (datos) {
                    $("#detalles").html(datos);
                });
            }
        </script>
    </BODY>
</HTML>
