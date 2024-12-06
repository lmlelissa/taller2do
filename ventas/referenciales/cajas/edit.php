<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Editar Caja</title>
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
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Editar Caja</h3>
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
                                        $cajas = consultas::get_datos("SELECT * FROM v_ref_cajas WHERE id_caja=$codigo");
                                        ?>
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vid_caja" value="<?= $cajas[0]['id_caja']; ?>"/> 
                                        <input type="hidden" name="vestado" value="<?= $cajas[0]['caj_estado']; ?>"/> 
                                        <div class="form-group has-success">
                                            <label class="control-label" for="vdescripcion"><i class="fa fa-check"></i>Descripcion</label>
                                            <input type="text" class="form-control" id="vdescripcion" placeholder="Ingrese Descripcion..." name="vdescripcion" required="" value="<?= $cajas[0]['caj_descri']; ?>">
                                        </div>
                                        <div class="form-group has-warning">
                                            <?php $tipro = consultas::get_datos("SELECT * FROM ref_sucursal ORDER BY id_sucursal=" . $cajas[0]['id_sucursal'] . " DESC"); ?>
                                            <label class="control-label" for="vsucursal"><i class="fa fa-bell-o"></i>Sucursal</label>
                                            <select class="form-control" name="vid_sucursal">
                                                <?php if (!empty($tipro)) { ?>
                                                    <?php foreach ($tipro as $tip) {
                                                        ?>
                                                        <option value="<?= $tip['id_sucursal']; ?>"><?= $tip['suc_nombre']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos un registro</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="box-footer" style="text-align: center;">
                                            <button class="btn btn-warning" type="submit">Editar
                                                <i class="fa fa-edit"></i>
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
