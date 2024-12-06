<?php
if (!session_id()) {
    session_start();
}
?>
<header class="main-header">
    <a href="/sysmeli/menu.php" class="logo">
        <span class="logo-mini"><b>SYS</b></span>
        <span class="logo-lg"><b>ESQMEL</b>Tech</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 10px;">
                        <img src="<?= $_SESSION['usu_foto']; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $_SESSION['nombres']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?= $_SESSION['usu_foto']; ?>" class="img-circle" alt="User Image">
                            <p style="font-size: 12px;">
                                <?= $_SESSION['nombres']; ?> <?= ' - '.$_SESSION['perf_nombre']; ?>
                            </p>
                            <p style="font-size: 12px;">
                                <?= $_SESSION['sucursal']; ?>
                            </p>
                        </li>
                        <li class="user-body">
                            
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-default">Ayuda</a>
                            </div>
                            <div class="pull-right">
                                <a href="/sysmeli/index.php" class="btn btn-danger btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>