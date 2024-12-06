<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Editar Producto</title>
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
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Editar Producto</h3>
                                    <div class="box-tools">
                                        <a href="pro_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="pro_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <?php $productos = consultas::get_datos("SELECT * FROM v_ref_productos WHERE id_producto=" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vidproducto" value="<?= $productos[0]['id_producto']; ?>"/> 
                                        <input type="hidden" name="vestado" value="ACTIVO"/>                                             
                                        <div class="form-group">
                                            <label >Codigo de Barra</label>
                                            <input class="form-control" type="text" name="vcodbarra" value="<?= $productos[0]['codigo_barra']; ?>" required="">
                                        </div>
                                        <div class="form-group">
                                            <label >Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" required="" value="<?= $productos[0]['pro_descri']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>P.Compra</label>
                                            <input class="form-control" type="number" name="vprecioc" min="1000" required="" value="<?= $productos[0]['precio_compra']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>P.Venta</label>
                                            <input class="form-control" type="number" name="vpreciov" min="1000" required="" value="<?= $productos[0]['precio_venta']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Tipo</label>
                                            <?php $tipro = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipo=" . $productos[0]['id_tipo'] . " DESC"); ?>
                                            <select class="form-control select2" name="vidtipo" required="" >
                                                <?php if (!empty($tipro)) { ?>
                                                    <?php foreach ($tipro as $tip) {
                                                        ?>
                                                        <option value="<?= $tip['id_tipo']; ?>"><?= $tip['tip_descri']; ?></option>
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
                                            <label >Marca</label>
                                            <?php $marcas = consultas::get_datos("SELECT * FROM ref_marcas ORDER BY id_marca=" . $productos[0]['id_marca'] . " DESC"); ?>
                                            <select class="form-control select2" name="vidmarca" required="">
                                                <?php
                                                if (!empty($marcas)) {
                                                    ?>         
                                                    <?php
                                                    foreach ($marcas as $mar) {
                                                        ?>
                                                        <option value="<?= $mar['id_marca']; ?>"><?= $mar['mar_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una marca</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>serie</label>
                                            <?php $tama = consultas::get_datos("SELECT * FROM ref_serie ORDER BY id_serie=" . $productos[0]['id_serie'] . " DESC"); ?>
                                            <select class="form-control select2" name="vid_serie" required="">
                                                <?php
                                                if (!empty($tama)) {
                                                    ?>       
                                                    <?php
                                                    foreach ($tama as $tam) {
                                                        ?>
                                                        <option value="<?= $tam['id_serie']; ?>"><?= $tam['serie_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe seleccionar al menos una Serie</option>             
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Impuesto</label>
                                            <select class="form-control select2" name="viva" required="">
                                                <option value="11">IVA 10</option>
                                                <option value="21">IVA 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="btn btn-warning" type="submit"> 
                                            <span class="fa fa-edit"></span> Modificar
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
    </BODY>
</HTML>
