<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Activar Cliente</title>
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
                                    <i class="fa fa-check"></i>
                                    <h3 class="box-title">Activar Cliente</h3>
                                    <div class="box-tools">
                                        <a href="index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="controlador.php" method="POST" accept-charset="UTF-8" role="form">
                                        <?php
                                        $codigo = $_REQUEST['vid'];
                                        $clientes = consultas::get_datos("SELECT * FROM v_ref_clientes WHERE id_cliente=$codigo");
                                        ?>
                                        <input type="hidden" name="voperacion"  value="4">
                                        <input type="hidden" name="vid_cliente" value="<?= $clientes[0]['id_cliente']; ?>"/> 
                                        <input type="hidden" name="vid_persona" value="<?= $clientes[0]['id_persona']; ?>"/> 
                                        <input type="hidden" name="vper_ci" value="<?= $clientes[0]['per_ci']; ?>"/> 
                                        <input type="hidden" name="vper_nombres" value="<?= $clientes[0]['cliente']; ?>"/> 
                                        <input type="hidden" name="vestado" value="ACTIVO"/> 
                                        <div class="form-group has-error">
                                            <label class="control-label" for="vdescripcion"><i class="fa fa-check"></i>Datos Actuales</label>
                                            <input type="text" class="form-control" id="vdescripcion" value="<?= ' (' . $clientes[0]['per_ci'] . ') - ' . $clientes[0]['cliente']; ?>" readonly="">
                                        </div>
                                        <div class="box-footer">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-check"></i> Activar
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
    </BODY>
</HTML>
