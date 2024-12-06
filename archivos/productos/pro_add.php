<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Agregar Producto</title>
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
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Agregar Producto</h3>
                                    <div class="box-tools">
                                        <a href="pro_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="pro_control.php" method="POST" accept-charset="UTF-8">
                                    <div class="box-body">
                                        <input type="hidden" name="voperacion"  value="1">
                                        <input type="hidden" name="vidproducto" value="0"/> 
                                        <input type="hidden" name="vestado" value="ACTIVO"/> 
                                        <div class="form-group">
                                            <label >Cod.Barra</label>
                                            <input class="form-control" type="text" name="vcodbarra" required="" placeholder="Digite Codigo" autofocus="">
                                        </div>
                                        <div class="form-group">
                                            <label >Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" required="" placeholder="Ingrese Nombre">
                                        </div>
                                        <div class="form-group">
                                            <label >Precio de Compra</label>
                                            <input class="form-control" type="number" name="vprecioc" min="1000" required="" value="1000">
                                        </div>
                                        <div class="form-group">
                                            <label >Precio de Venta</label>
                                            <input class="form-control" type="number" name="vpreciov" min="1000" required="" value="1000">
                                        </div>
                                        <div class="form-group">
                                            <label >Tipo</label>
                                            <?php $tipro = consultas::get_datos("SELECT * FROM ref_tipo_producto ORDER BY id_tipo"); ?>
                                            <select class="form-control select2" name="vidtipo" required="">
                                                <?php if (!empty($tipro)) { ?>
                                                    <option value="">Seleccione un Tipo</option>
                                                    <?php foreach ($tipro as $tip) {
                                                        ?>
                                                        <option value="<?php echo $tip['id_tipo']; ?>"><?php echo $tip['tip_descri']; ?></option>
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
                                            <?php $marcas = consultas::get_datos("SELECT * FROM ref_marcas ORDER BY id_marca"); ?>
                                            <select class="form-control select2" name="vidmarca" required="">
                                                <?php
                                                if (!empty($marcas)) {
                                                    ?>
                                                    <option value="">Seleccione una Marca</option>             
                                                    <?php
                                                    foreach ($marcas as $mar) {
                                                        ?>
                                                        <option value="<?php echo $mar['id_marca']; ?>"><?php echo $mar['mar_descri']; ?></option>
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
                                            <?php $tama = consultas::get_datos("SELECT * FROM ref_serie ORDER BY id_serie"); ?>
                                            <select class="form-control select2" name="vid_serie" required="">
                                                <?php
                                                if (!empty($tama)) {
                                                    ?>
                                                    <option value="">Seleccione una Serie</option>             
                                                    <?php
                                                    foreach ($tama as $ta) {
                                                        ?>
                                                        <option value="<?= $ta['id_serie']; ?>"><?= $ta['serie_descri']; ?></option>
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
                                            <label>IVA</label>
                                            <select class="form-control select2" name="viva" required="">
                                                <option value="11">IVA 10</option>
                                                <option value="21">IVA 5</option>
                                            </select>
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
    </BODY>
</HTML>
