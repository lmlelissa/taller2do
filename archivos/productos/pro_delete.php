<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Borrar Producto</title>
        <?php
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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-remove"></i>
                                    <h3 class="box-title">Borrar Producto</h3>
                                    <div class="box-tools">
                                        <a href="pro_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="pro_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $productos = consultas::get_datos("SELECT * FROM v_ref_productos WHERE id_producto=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="3">
                                        <input type="hidden" name="vidproducto" value="<?= $productos[0]['id_producto']; ?>"/> 
                                        <input type="hidden" name="vidmarca" value="<?= $productos[0]['id_marca']; ?>"/> 
                                        <input type="hidden" name="vidtipo" value="<?= $productos[0]['id_tipo']; ?>"/> 
                                        <input type="hidden" name="vid_serie" value="<?= $productos[0]['id_serie']; ?>"/> 
                                        <input type="hidden" name="viva" value="<?= $productos[0]['pro_impuesto']; ?>"/> 
                                        <input type="hidden" name="vprecioc" value="<?= $productos[0]['precio_compra']; ?>"/> 
                                        <input type="hidden" name="vpreciov" value="<?= $productos[0]['precio_venta']; ?>"/> 
                                        <input type="hidden" name="vestado" value="ACTIVO"/> 
                                        <div class="form-group">
                                            <label >Cod.Barra</label>
                                            <input class="form-control" type="text" name="vcodbarra" value="<?= $productos[0]['codigo_barra']; ?>" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" value="<?= $productos[0]['pro_descri']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-remove"></i>Borrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           <?php require '../../tools/footer.php'; ?>
    </BODY>
     <?php require '../../tools/js.php'; ?>
    <script>
        /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        function div_datos() {
            var perfil = $("#vperfil").val();
            $.ajax({
                type: "POST", url: "div_datos.php", data: {perfil: perfil}
            }).done(function (datos) {
                $("#div_datos1").html(datos);
            });
        }
    </script>
</HTML>
