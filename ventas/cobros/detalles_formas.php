<?php
require '../../conexion.php';
session_start();
date_default_timezone_set('America/Asuncion');
$vid_fc = $_POST['vid_fc'];
$vid_cobro = $_POST['vid_cobro'];
if (!empty($vid_fc)) {
    $cobros = consultas::get_datos("SELECT * FROM cobros WHERE id_cobro=$vid_cobro");
    $falta_cobrar = round($cobros[0]['total'] - $cobros[0]['monto_pagado']);
    if ($vid_fc == 1) {
        ?>
        <div class="form-group">
            <label>Monto</label>
            <input class="form-control" type="text" name="vmonto" value="<?= $falta_cobrar ?>" min="1000">
        </div>
        <?php
    } else {
        if ($vid_fc == 2) {
            ?>
            <input class="form-control" type="hidden" value="0" name="vid_ct">
            <input class="form-control" type="hidden" value="ACTIVO" name="vestado"> 
            <div class="form-group">
                <label>Fecha</label>
                <input class="form-control" type="datetime-local" required="" name="vfecha">
            </div> 
            <div class="form-group">
                <label >Entidad Emisora</label>
                <?php $eem = consultas::get_datos("SELECT * FROM ref_entidad_emisora WHERE estado='ACTIVO'"); ?>
                <select class="form-control select2" name="vid_ee" required="">
                    <?php if (!empty($eem)) { ?>
                        <?php foreach ($eem as $ee) {
                            ?>
                            <option value="<?= $ee['id_ee']; ?>"><?= $ee['ee_nombre']; ?></option>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label >Marca Tarjeta</label>
                <?php $martar = consultas::get_datos("SELECT * FROM ref_marcas_tarjeta WHERE estado='ACTIVO'"); ?>
                <select class="form-control select2" name="vid_mt" required="">
                    <?php if (!empty($martar)) { ?>
                        <?php foreach ($martar as $mt) {
                            ?>
                            <option value="<?= $mt['id_mt']; ?>"><?= $mt['mt_descri']; ?></option>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label >Tipo Tarjeta</label>
                <select class="form-control select2" name="vtipo" required="">
                    <option value="CREDITO">CREDITO</option>
                    <option value="DEBITO">DEBITO</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nº Tarjeta</label>
                <input class="form-control" type="number" placeholder="012348784" name="vnro_tarjeta" required="">
            </div>
            <div class="form-group">
                <label>Nº Cupon</label>
                <input class="form-control" type="number" placeholder="012348784" name="vnro_cupon" required="">
            </div>
            <div class="form-group">
                <label>Monto</label>
                <input class="form-control" type="number" name="vmonto" value="<?= $falta_cobrar ?>" min="1000">
            </div>
            <?php
        } else {
            if ($vid_fc == 3) {
                ?>
                <input class="form-control" type="hidden" value="0" name="vid_cch">
                <input class="form-control" type="hidden" value="ACTIVO" name="vestado">
                <input class="form-control" type="hidden" value="SYSTEC" name="va_orden_de">
                <div class="form-group">
                    <label>Fecha</label>
                    <input class="form-control" type="datetime-local" required="" name="vfecha">
                </div>
                <div class="form-group">
                    <label >Banco</label>
                    <?php $bancos = consultas::get_datos("SELECT * FROM ref_bancos WHERE ban_estado='ACTIVO'"); ?>
                    <select class="form-control select2" name="vid_banco" required="">
                        <?php if (!empty($bancos)) { ?>
                            <?php foreach ($bancos as $ban) {
                                ?>
                                <option value="<?= $ban['id_banco']; ?>"><?= $ban['ban_descri']; ?></option>
                                <?php
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label >Tipo Cheque</label>
                    <select class="form-control select2" name="vtipo" required="">
                        <option value="AL DIA">AL DIA</option>
                        <option value="DIFERIDO">DIFERIDO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Vencimiento</label>
                    <input class="form-control" type="date" required="" name="vcheque_venc">
                </div>
                <div class="form-group">
                    <label>Nº Cheque</label>
                    <input class="form-control" type="number" placeholder="012348784" name="vnro_cheque" required="">
                </div>
                <div class="form-group">
                    <label>Monto</label>
                    <input class="form-control" type="number" name="vmonto" value="<?= $falta_cobrar ?>" min="1000">
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>

<script>
    const input = document.getElementById('fecha');
    input.valueAsDate = new Date();
</script>