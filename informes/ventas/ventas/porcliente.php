<?php
require '../../../conexion.php';
require '../../../tools/css.php';
?>
<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="3" id="op" type="hidden"/>
    <div class="col-md-8 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active" style="width: 280px">Ventas por Cliente</a>              
        </div>   
        <div class="form-group col-md-12">
            <div class="col-md-6">
                <?php $clie = consultas::get_datos("SELECT * FROM v_ref_clientes WHERE id_cliente > 0 ORDER BY id_cliente"); ?>
                <select class="form-control select2" id="vid_cliente">
                    <?php if (!empty($clie)) { ?>
                        <?php foreach ($clie as $cli) {
                            ?>
                            <option value="<?= $cli['id_cliente']; ?>">
                                <?= $cli['cliente'] . ' (' . $cli['per_ci'] . ')'; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">NO EXISTEN REGISTROS</option>             
                    <?php }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <div class="col-md-1  pull-right">
                    <a onclick="enviar()" rel="tooltip" data-title="Imprimir" class="btn btn-warning" role="button">
                        <span class="fa fa-print"> </span>
                    </a>  
                </div>
            </div>
        </div> 

    </div> 
</form>
<?php require '../../../tools/js.php'; ?>
<script>
    function enviar() {
        window.open("/sysmeli/informes/ventas/ventas/imprimir.php?vid_cliente=" + $('#vid_cliente').val() + '&vop=' + $('#op').val(), '_blank');
    }
</script>




