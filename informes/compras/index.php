<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title> Informes Compras</title>
        <?php
        require '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">   
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Informes del Módulo Compras</h3>
                        </div>     
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="">                                                          
                                        <div class="box-body no-padding">                                   
                                            <div class="row">                                        
                                                <div class="col-md-4 col-md-offset-0">
                                                    <div class="list-group">
                                                        <a href="#" class="list-group-item active">Reportes</a>
                                                        <a href="#" onclick="obtener_pedidos()" class="list-group-item">Pedidos de Compras</a>
                                                        <a href="#" onclick="obtener_presupuestos()" class="list-group-item">Presupuestos de Compras</a>
                                                        <a href="#" onclick="obtener_ordenes()" class="list-group-item">Ordenes de Compras</a>
                                                    </div>  
                                                </div>
                                                <div id="cargando"></div>
                                            </div>
                                        </div>
                                    </div>                      
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
            </div>
            <?php require '../../tools/footer.php'; ?>
        </div>
        <?php require '../../tools/js.php'; ?>
        <script>
            function obtener_pedidos() {
                $.ajax({
                    type: "POST",
                    url: "/sysmeli/informes/compras/pedidos/reportes.php",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/sysmeli/dist/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
            
            function obtener_presupuestos() {
                $.ajax({
                    type: "POST",
                    url: "/sysmeli/informes/compras/presupuestos/reportes.php",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/sysmeli/dist/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
            
            function obtener_ordenes() {
                $.ajax({
                    type: "POST",
                    url: "/sysmeli/informes/compras/ordenes/reportes.php",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/sysmeli/dist/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
        </script>
    </body>
</html>



