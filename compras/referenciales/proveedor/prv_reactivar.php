<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Desactivar Proveedor</title>
        <?php
        include '../../../sesion_ver.php';
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
                                <div class="box-header">
                                    <i class="fa fa-check-circle"></i>
                                    <h3 class="box-title">Reactivar Proveedor</h3>
                                    <div class="box-tools">
                                        <a href="prv_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="prv_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_proveedores WHERE id_proveedor=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="4">
                                        <input type="hidden" name="vidproveedor" value="<?= $resultado[0]['id_proveedor']; ?>"/> 
                                        <div class="form-group">
                                            <label>Ruc</label>
                                            <input class="form-control" type="text" name="vruc" readonly="" value="<?= $resultado[0]['prv_ruc']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Razon Social</label>
                                            <input class="form-control" type="text" name="vrazon" readonly="" value="<?= $resultado[0]['prv_razonsocial']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input class="form-control" type="text" name="vdireccion" readonly="" value="<?= $resultado[0]['prv_direccion']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Telefono</label>
                                            <input class="form-control" type="text" name="vtelefono" readonly="" value="<?= $resultado[0]['prv_telefono']; ?>">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fa fa-check"></i> Reactivar
                                        </button>
                                    </div>
                                </form>
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