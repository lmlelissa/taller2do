<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Modificar Persona</title>
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
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Modificar Persona</h3>
                                    <div class="box-tools">
                                        <a href="per_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="per_control.php" method="POST" role="form">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona =" . $_GET['vid']); ?>
                                        <input type="hidden" name="voperacion"  value="2">
                                        <input type="hidden" name="vidpersona" value="<?= $resultado[0]['id_persona']; ?>"/> 
                                        <div class="form-group">
                                            <label id="input1">CI</label>
                                            <input class="form-control" type="text" name="vci" required="" placeholder="Digite CI" id="input1"
                                                   autofocus="" value="<?= $resultado[0]['per_ci']; ?>" maxlength="7">
                                        </div>
                                        <div class="form-group">
                                            <label id="input2">Nacimiento</label>
                                            <input class="form-control" type="date" name="vfechan" required="" id="input2"
                                                   value="<?= $resultado[0]['fecha']; ?>" max="<?= date("Y-m-d"); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label id="input3">Nombre</label>
                                            <input class="form-control" type="text" name="vnombre" required="" placeholder="Ingrese Nombre" id="input3"
                                                   value="<?= $resultado[0]['per_nombre']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label id="input4">Apellido</label>
                                            <input class="form-control" type="text" name="vapellido" required="" placeholder="Ingrese Apellido" id="input4"
                                                   value="<?= $resultado[0]['per_apellido']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label id="input5">Ruc</label>
                                            <input class="form-control" type="text" name="vruc" required="" placeholder="Digite RUC" id="input5"
                                                   value="<?= $resultado[0]['per_ruc']; ?>" maxlength="11">
                                        </div>
                                        <div class="form-group">
                                            <label id="input6">Telefono</label>
                                            <input class="form-control" type="text" name="vtelefono" required="" placeholder="Ingrese Telefono" id="input6"
                                                   value="<?= $resultado[0]['per_telefono']; ?>" maxlength="10">
                                        </div>
                                        <div class="form-group">
                                            <label id="input7">Email</label>
                                            <input class="form-control" type="email" name="vemail" required="" placeholder="Ingrese correo" id="input7"
                                                   value="<?= $resultado[0]['per_email']; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <?php $ciudads = consultas::get_datos("SELECT * FROM ref_ciudad ORDER BY id_ciudad=" . $resultado[0]['id_ciudad'] . " DESC"); ?>
                                            <label id="input8">Ciudad</label>
                                            <select class="form-control select2" name="vidciudad" required="" id="input8">
                                                <?php
                                                if (!empty($ciudads)) {
                                                    foreach ($ciudads as $ciu) {
                                                        ?>
                                                        <option value="<?= $ciu['id_ciudad']; ?>"><?= $ciu['ciu_nombre']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="btn btn-warning" type="submit">
                                            <i class="fa fa-edit"></i> Modificar
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