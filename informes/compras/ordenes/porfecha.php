<?php
require '../../../conexion.php';
require '../../../tools/css.php';
?>
<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="1" id="op" type="hidden"/>
    <div class="col-md-8 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active" style="width: 500px">Ordenes de Compras por Fecha</a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-md-1 control-label">Desde: </label>
            <div class="col-md-4">
                <input type="date" required="" placeholder="Especifique fecha" id="desde" class="form-control" value="<?= date("Y-m-d") ?>" name="vdesde" max="<?= date('Y-m-d'); ?>">
            </div>
            <label class="col-md-1 control-label">Hasta: </label>
            <div class="col-md-4">
                <input type="date" required="" placeholder="Especifique fecha"  id="hasta" class="form-control" value="<?= date("Y-m-d") ?>" name="vhasta" max="<?= date('Y-m-d'); ?>">
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
        window.open("/sysmeli/informes/compras/ordenes/imprimir.php?vdesde=" + $('#desde').val() + '&vhasta=' + $('#hasta').val() + '&vop=' + $('#op').val(), '_blank');
    }
</script>




