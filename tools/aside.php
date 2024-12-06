<?php if (isset($_SESSION['id_usuario'])) { ?>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= $_SESSION['usu_foto']; ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p style="font-size: 12px;"><?= $_SESSION['nombres']; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
                </div>
            </div>
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MODULOS</li>
                <?php $modulos = consultas::get_datos("SELECT DISTINCT(mod_cod),(mod_nombre) FROM v_ref_permisos WHERE id_perfil =" . $_SESSION['id_perfil'] . " ORDER BY mod_cod"); ?>  
                <?php if (!empty($modulos)) { ?>
                    <?php foreach ($modulos as $modulo) { ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span style="font-size: 12px;"><?= $modulo['mod_nombre']; ?></span> 
                                <span class="pull-right-container">
                                    <?php $total = consultas::get_datos("SELECT count(*) as total FROM ref_paginas WHERE mod_cod=" . $modulo['mod_cod'] ." AND pag_cod IN (SELECT pag_cod FROM ref_permisos)"); ?>
                                    <span class="label label-primary pull-right"><?= $total[0]['total']; ?></span>
                                </span>
                            </a>
                            <?php $paginas = consultas::get_datos("SELECT pag_direc,pag_nombre,leer,insertar,editar,borrar FROM v_ref_permisos WHERE mod_cod=" . $modulo['mod_cod'] . " AND id_perfil =" . $_SESSION['id_perfil'] . " ORDER BY pag_cod"); ?>   
                            <ul class="treeview-menu">
                                <?php foreach ($paginas as $pagina) { ?>
                                    <li>
                                        <a href="<?= $pagina['pag_direc']; ?>" style="font-size: 11px;">
                                            <i class="fa fa-circle-o"></i> <?= " " . $pagina['pag_nombre']; ?>
                                        </a>
                                    </li>
                                <?php } ?>  
                            </ul>
                        </li>

                    <?php } ?>
                <?php } else { ?>
                    <b style="color: red; margin-left: 300px"> NO TIENE PERMISOS...</b>
                <?php } ?>
            </ul>
        </section>
    </aside>
<?php } ?>