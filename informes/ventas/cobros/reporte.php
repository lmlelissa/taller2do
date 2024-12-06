<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        session_start();
        require '../../../conexion.php';
        require '../../../tools/css.php';
        ?>
    </head>
    <form accept-charset="utf8" class="form-horizontal">
        <div class="col-md-8 col-md-offset-0">
            <div class="list-group">
                <a href="#" class="list-group-item active" style="width: 200px;">Cobros</a>              
            </div>   
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-10">                                             
                        <div class="">                                                          
                            <div class="box-body no-padding">                                   
                                <div class="row">                                        
                                    <div class="col-md-4 col-md-offset-0">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item active" style="width: 200px;">Filtros</a>
                                            <a href="#" onclick="obtener_fecha();" class="list-group-item" style="width: 200px;">Por Rango de Fecha</a>
                                            <a href="#" onclick="obtener_estado();" class="list-group-item" style="width: 200px;">Por Estado</a>
                                        </div>                                                
                                    </div>
                                    <div id="cargando">

                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div> 
    </form>
    <script>
        function obtener_fecha() {
            $.ajax({
                type: "POST",
                url: "/sysmeli/informes/ventas/cobros/porfecha.php/",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/sysmeli/dist/img/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            });
        }
        function obtener_estado() {
            $.ajax({
                type: "POST",
                url: "/sysmeli/informes/ventas/cobros/porestado.php/",
                cache: false,
                beforeSend: function () {
                    $('#cargando').html('<img src="/sysmeli/dist/img/ajax-loader.gif"><strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#cargando').html(msg);
                }
            });
        }
    </script>
</body>
</html>



