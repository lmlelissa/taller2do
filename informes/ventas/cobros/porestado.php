<?php
require '../../../conexion.php';
require '../../../tools/css.php';
?>
<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="2" id="op" type="hidden"/>
    <div class="col-md-8 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active" style="width: 280px">Cobros por Estado</a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-md-1 control-label">Estado: </label>
            <div class="col-md-4">
                <select class="form-control" id="vestado">
                    <option value="PENDIENTE">PENDIENTE</option>
                    <option value="CONFIRMADO">CONFIRMADO</option>
                    <option value="PAGADO">PAGADO</option>
                    <option value="ANULADO">ANULADO</option>
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
        window.open("/sysmeli/informes/ventas/cobros/imprimir.php?vestado=" + $('#vestado').val() + '&vop=' + $('#op').val(), '_blank');
    }
</script>




