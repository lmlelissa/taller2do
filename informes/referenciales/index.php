<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>AV - Informes Referenciales</title>
        <?php
        include '../../sesion_ver.php';
        require '../../conexion.php';
        require '../../tools/css.php';
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require '../../tools/header.php'; ?>
            <?php require '../../tools/aside.php'; ?>
            <div class="content-wrapper">
                <div class="content">   
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Informes Referenciales</h3>
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
                                                        <a href="/av_novedades/informes/referenciales/perfiles/print.php" target="_blank" class="list-group-item">Perfiles</a>
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
    </body>
</html>



