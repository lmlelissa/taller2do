<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Registrar Empleado</title>
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
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Empleado</h3>
                                    <div class="box-tools">
                                        <a href="emp_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="emp_control.php" method="POST" role="form">
                                    <div class="box-body">
                                        <div class=row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vidempleado" value="0"/> 
                                            <div class="form-group">
                                                <label >Persona</label>
                                                <?php $perso = consultas::get_datos("SELECT * FROM v_ref_persona WHERE id_persona NOT IN(SELECT id_persona FROM ref_empleado)"); ?>
                                                <select class="form-control select2" name="vidpersona" required="">
                                                    <?php
                                                    if (!empty($perso)) {
                                                        foreach ($perso as $pers) {
                                                            ?>
                                                            <option value="<?= $pers['id_persona']; ?>"><?= $pers['per_nombre'] . ' ' . $pers['per_apellido']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">DEBE REGISTRAR UNA PERSONA</option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label >Cargo</label>
                                                <?php $cargoss = consultas::get_datos("SELECT * FROM ref_cargos WHERE id_cargo NOT IN(1)"); ?>
                                                <select class="form-control select2" name="vidcargo" required="">
                                                    <?php
                                                    if (!empty($cargoss)) {
                                                        foreach ($cargoss as $ca) {
                                                            ?>
                                                            <option value="<?= $ca['id_cargo']; ?>"><?= $ca['car_descri']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
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
