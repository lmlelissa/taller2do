<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Informes Ventas</title>
        <?php
        session_start();
        require '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">   
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Informes del Módulo Ventas</h3>
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
                                                        <a href="#" onclick="obtener_ventas()" class="list-group-item">Ventas</a>
                                                        <a href="../../informes/ventas/stock/imprimir.php" target="_blank" class="list-group-item">Stock de Productos</a>
                                                        <a href="../../informes/ventas/cuentas/imprimir.php" target="_blank" class="list-group-item">Cuentas a Cobrar</a>
                                                        <a href="#" onclick="obtener_cobros()" class="list-group-item">Cobros</a>
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
            function obtener_ventas() {
                $.ajax({
                    type: "POST",
                    url: "/sysmeli/informes/ventas/ventas/reporte.php",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/sysmeli/dist/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
            function obtener_cobros() {
                $.ajax({
                    type: "POST",
                    url: "/sysmeli/informes/ventas/cobros/reporte.php",
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



